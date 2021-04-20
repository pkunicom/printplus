<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\SiteSettingModel;
use App\Models\SystemCountryModel;
use App\Models\SystemCityModel;
use App\Models\EvaluationModel;
use App\Models\AgentModel;
use App\Models\CustomerAddressModel;
use App\Models\ProductWeightTimeCostModel;
use App\Models\DeliveryOptionModel;
use JWTAuth;
use Hash;
use Validator;


class AramexController extends Controller
{
    public function __construct()
    {
        $this->MailService        = new MailService();
        $this->SiteSettingModel   = new SiteSettingModel();
        $this->SystemCountryModel = new SystemCountryModel();
        $this->SystemCityModel    = new SystemCityModel();
        $this->AgentModel         = new AgentModel();
        $this->DeliveryOptionModel         = new DeliveryOptionModel();
        $this->CustomerAddressModel         = new CustomerAddressModel();
        $this->ProductWeightTimeCostModel         = new ProductWeightTimeCostModel();

    }

    // Aramex api to calculate Rate : AUTHOR (Harsh chauhan) 
   // PHP Code
    public function calculate_rate(Request $request)
    {
        $arr_combination_id = $lead_time = [];$total_weight = $total_quantity = 1;
        $combination_id = json_decode($request->input('combination_id',null));
        $product_id     = $request->input('product_id',null);
        // $quantity       = $request->input('quantity',null);
        // $agent_id       = $request->input('agent_id',null);
        // $country_id     = $request->input('country_id',null);
        // $address        = $request->input('address',null);
        // $city_id        = $request->input('city_id',null);
        $address_id        = $request->input('address_id',null);

        $obj_data     = $this->SiteSettingModel->select('printplus_margin_for_saudi_arabia','printplus_margin_for_others')->first();
        
        $obj_address     = $this->CustomerAddressModel->where('id',$address_id)->first();
      if(!empty($obj_address)){
        $obj_country  = $this->SystemCountryModel->with('get_aramex_details')->where('id',$obj_address->country_id)->first();

        $obj_city     = $this->SystemCityModel->with('get_aramex_details')->where('id',$obj_address->city_id)->first();
       
        $obj_delivery     = $this->DeliveryOptionModel->where('system_city_id',$obj_address->city_id)->first();

        foreach($combination_id as $key => $value){
            $arr_combination_id[] = $value->id;
            $obj_combination = $this->ProductWeightTimeCostModel->where('id',$value->id)->first();
            $total_weight =  $total_weight + ((isset($obj_combination->weight)?$obj_combination->weight:0)*$value->quantity);
            $total_quantity = $total_quantity + $value->quantity;
            $lead_time[]  = $obj_combination->lead_time;
            
        }

        $destination_city    = isset($obj_city->get_aramex_details->aramexName)     ? $obj_city->get_aramex_details->aramexName : 'Abha';
        $destination_country = isset($obj_city->get_aramex_details->country_code)     ? $obj_city->get_aramex_details->country_code : 'SA';


        $params = array(
        'ClientInfo'            => array(
                                    // 'AccountCountryCode' => 'JO',
                                    // 'AccountEntity'          => 'AMM',
                                    // 'AccountNumber'          => '00000',
                                    // 'AccountPin'         => '000000',
                                    // 'UserName'               => 'user@company.com',
                                    // 'Password'               => '000000000',
                                    // 'Version'                => 'v1.0'
                                    'AccountCountryCode'    => 'SA',
                                    'AccountEntity'         => 'RUH',
                                    'AccountNumber'         => '60500178',
                                    'AccountPin'            => '165165',
                                    'UserName'              => 'asma@print.sa',
                                    'Password'              => 'Pr1nt$@11$22$',
                                    'Version'               => 'v1'
                                ),
                                
        'Transaction'           => array(
                                    'Reference1'            => '001' 
                                ),
                                
        'OriginAddress'         => array(
                                    // 'City'                  => 'Amman',
                                    // 'CountryCode'           => 'JO'
                                    'City'                  => 'Abha',
                                    'CountryCode'           => 'SA'

                                ),
                                
        'DestinationAddress'    => array(
                                    // 'City'                  => 'Dubai',
                                    // 'CountryCode'           => 'AE'
                                    'City'                  => $obj_city->get_aramex_details->aramexName,
                                    'CountryCode'           => $obj_country->get_aramex_details->country_code

                                ),
        'ShipmentDetails'       => array(
                                    'PaymentType'            => 'P',
                                    'ProductGroup'           => 'EXP',
                                    'ProductType'            => 'PPX',
                                    // 'ActualWeight'           => array('Value' => 5, 'Unit' => 'KG'),
                                    // 'ChargeableWeight'       => array('Value' => 5, 'Unit' => 'KG'),
                                    // 'NumberOfPieces'         => 500
                                    'ActualWeight'           => array('Value' => (int) $total_weight , 'Unit' => 'KG'),
                                    'ChargeableWeight'       => array('Value' => (int) $total_weight , 'Unit' => 'KG'),
                                    'NumberOfPieces'         => (int) $total_quantity
                                )
        );
        
        $soapClient = new \SoapClient(asset('assets/aramex/').'/aramex-rates-calculator-wsdl.wsdl' , array('trace' => 1));
        $results = $soapClient->CalculateRate($params); 
        // dd($results);
        if($results->HasErrors==false){
            // dd($results);
            $arr_resp_data['currency_code']  =  $results->TotalAmount->CurrencyCode;
            $arr_resp_data['value']          =  $results->TotalAmount->Value;  
            $lead_time_max = 0;
            if($obj_delivery && $obj_delivery->standard_delivery=='yes' ){
                $arr_resp_data['standard_delivery']          =  'yes'; 
                $lead_time_max = max($lead_time);
                $arr_resp_data['standard_delivery_days']          =  $obj_delivery->standard_delivery_days + $lead_time_max; 
            }else{
                $arr_resp_data['standard_delivery']          =  'no'; 
                $lead_time_max = max($lead_time);
                $arr_resp_data['standard_delivery_days']          =  $lead_time_max; 
            
            }
            // dd($lead_time_max);

            $arr_resp['status'] = 'SUCCESS';
            $arr_resp['msg']    = 'Amount displayed successfully!';
            $arr_resp['data']   = $arr_resp_data;

            return $arr_resp;
        }else{
            $arr_resp['status'] = 'ERROR';
            $arr_resp['msg']    = 'Something went wrong!';

            return $arr_resp;
        }
    }
    else{
            $arr_resp['status'] = 'SUCCESS';
            $arr_resp['msg']    = 'Data Not Found!';

            return $arr_resp;
        }        
      

    }

}

