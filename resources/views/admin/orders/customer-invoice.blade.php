<?php 

    /*  var_dump($arr_data);
   die();   */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Print Sa</title>
   </head>
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:21px; color:#666; text-align:justify;color: #000000;">
      <div style="max-width:930px;width:100%;margin:0 auto;">
         <div style="padding:0px 15px;">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
               <tr>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td bgcolor="#FFFFFF" style="padding:15px; border:1px solid #e5e5e5;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                 <tr>
                                    <td style="text-align: center;">
                                       <a href="#"><img src="images/logo.png"  alt="logo" width="100px" height="" /></a>
                                    </td>
                                    <td style="text-align: right;">
                                       <div class="" style="padding: 2px 0;">منصة اطبع الذكیة - Smart Print Platform</div>
                                       <div class="" style="padding: 2px 0;">
                                          <span style="width: 50px;text-align: left;display: inline-block;">VATReg.</span> 
                                          <span style="width: 120px;text-align: center;display: inline-block;">310425656700003</span> 
                                          الرقم الضریبي
                                       </div>
                                       <div class="" style="padding: 2px 0;">
                                          <span style="width: 50px;text-align: left;display: inline-block;">CR</span> 
                                          <span style="width: 120px;text-align: center;display: inline-block;">1010591705</span> 
                                          السجل التجاري
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="2" height="5"></td>
                                 </tr>                           
                                 <tr>
                                    <td style="border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;padding: 5px 0;text-align: center;font-size: 15px;">
                                       Date 09-03-2021 09:45:33 PM تاریخ 
                                    </td>
                                    <td style="border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;padding: 5px 0;text-align: center;font-size: 15px;">
                                       Invoice# {{$arr_data['order_id'] }} الفاتورة ر
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="padding: 10px 0;">
                                       <div class="" style="padding: 2px 0;">
                                          <span style="text-align: left;width: 100px;display: inline-block;font-weight: 600;">Delievery Type</span>
                                          <span style="text-align: center;width: 180px;display: inline-block;">Delivery - توصیل</span>
                                          <span style="text-align: right;width: 70px;display: inline-block;font-weight: 600;">{{$arr_data["get_delivery_type"]['delivery_type'] }} </span>
                                       </div>
                                       <div class="" style="padding: 2px 0;">
                                          <span style="text-align: left;width: 100px;display: inline-block;font-weight: 600;">Address</span>
                                          <span style="text-align: center;width: 180px;display: inline-block;"> {{$arr_data["get_customer_details"]['address'] }} </span>
                                          <span style="text-align: right;width: 70px;display: inline-block;font-weight: 600;">العنوان</span>
                                       </div>
                                       <div class="" style="padding: 2px 0;">
                                          <span style="text-align: left;width: 100px;display: inline-block;font-weight: 600;">Service Provider</span>
                                          <span style="text-align: center;width: 180px;display: inline-block;"> Al Ragamiah Al Jadidah</span>
                                          <span style="text-align: right;width: 70px;display: inline-block;font-weight: 600;">مقدم الخدمة</span>
                                       </div>
                                    </td>
                                    <td style="text-align: right;padding: 10px 0;">
                                       <div class="" style="padding: 2px 0;">
                                          <span style="text-align: left;width: 70px;display: inline-block;font-weight: 600;">Client Name</span>
                                          <span style="text-align: center;width: 100px;display: inline-block;">{{$arr_data["get_customer_details"]['full_name'] }}</span>
                                          <span style="text-align: right;width: 70px;display: inline-block;font-weight: 600;">اسم العمیل</span>
                                       </div>
                                       <div class="" style="padding: 2px 0;">
                                          <span style="text-align: left;width: 70px;display: inline-block;font-weight: 600;">Mobile</span>
                                          <span style="text-align: center;width: 100px;display: inline-block;">{{$arr_data["get_customer_details"]['country_code_id'] }}  {{$arr_data["get_customer_details"]['mobile_number'] }}</span>
                                          <span style="text-align: right;width: 70px;display: inline-block;font-weight: 600;">رقم الجوال</span>
                                       </div>
                                       <div class="" style="padding: 2px 0;">
                                          <span style="text-align: left;width: 70px;display: inline-block;font-weight: 600;">Email</span>
                                          <span style="text-align: center;width: 100px;display: inline-block;">{{$arr_data["get_customer_details"]['email'] }}</span>
                                          <span style="text-align: right;width: 70px;display: inline-block;font-weight: 600;">البرید الإلكتروني</span>
                                       </div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                 <tr>
                                    <td colspan="2">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>                           
                                             <td style="text-align: center;border-top: 1px solid #000000;padding: 10px 0;font-weight: 600;">الإجمالي <br>Total</td>
                                             <td style="text-align: center;border-top: 1px solid #000000;padding: 10px 0;font-weight: 600;">الكمیة <br>Quant</td>
                                             <td style="text-align: center;border-top: 1px solid #000000;padding: 10px 0;font-weight: 600;">السعر <br>Price</td>
                                             <td style="text-align: center;border-top: 1px solid #000000;padding: 10px 0;font-weight: 600;">لملف <br>File</td>
                                          </tr>
                                          <?php foreach($arr_data['product_details'] as $key => $row ){
                                              //dd($row);
                                              $total_price = 0;
                                              ?>
                                          <tr>
                                             <td style="text-align: center;border-top: 1px solid #dddddd;padding: 8px 0;">SAR {{ number_format($row['total_price'],2)}}</td>
                                             <td style="text-align: center;border-top: 1px solid #dddddd;padding: 8px 0;">SAR {{ $row['quantity']}}</td>
                                             <td style="text-align: center;border-top: 1px solid #dddddd;padding: 8px 0;">SAR {{ $row['unit_price']}}</td>
                                             <td style="text-align: right;border-top: 1px solid #dddddd;padding: 8px 0;">
                                                 {{ $row['product_arabic']}} <br> 
                                                {{ $row['product_english']}}  
                                             </td>
                                          </tr>
                                          
                                          <?php 
                                             $total_price = $total_price+ $row['total_price'];
                                             $total_price = number_format($total_price,2);
                                          } ?>
                                          
                                          <tr>
                                             <td style="text-align: center;border-top: 1px solid #dddddd;padding: 8px 0;">SAR 24.38</td>
                                             <td style="text-align: center;border-top: 1px solid #dddddd;padding: 8px 0;">1</td>
                                             <td style="text-align: center;border-top: 1px solid #dddddd;padding: 8px 0;">SAR 24.38</td>
                                             <td style="text-align: right;border-top: 1px solid #dddddd;padding: 8px 0;">Delivery Service - خدمة التوصیل </td>
                                          </tr>
                                          <tr>
                                             <td style="border-top: 1px solid #000000;padding: 8px 0 4px;">SAR {{$total_price }}</td>
                                             <td colspan="3" style="border-top: 1px solid #000000;padding: 8px 0 4px;">الإجمالي - Total</td>
                                          </tr>
                                          <tr>
                                             <td style="padding: 4px 0;">SAR 0.00</td>
                                             <td colspan="3" style="padding: 4px 0;">الخصم - Discount</td>
                                          </tr>
                                          <tr>
                                             <td style="padding: 4px 0;">SAR {{$total_price }}</td>
                                             <td colspan="3" style="padding: 4px 0;">المجموع غیر شامل ضریبة القیمة المضافة - Total excl. VAT</td>
                                          </tr>
                                          <tr>
                                             <td style="padding: 4px 0;">SAR 18.80</td>
                                             <td colspan="3" style="padding: 4px 0;">ضریبة المضافة القیمة  - VAT</td>
                                          </tr>
                                          <tr>
                                             <td style="padding: 4px 0;">SAR 144.13</td>
                                             <td colspan="3" style="padding: 4px 0;">المجموع شامل ضریبة المضافة القیمة  - Total include VAT</td>
                                          </tr>
                                          <tr>
                                             <td colspan="4" style="text-align: right;border-top: 1px solid #000000;padding: 10px 0;">
                                                عزیزي العمیل شكرا لك لاختیار منصة اطبع لاتمام طلبك. نتمنى ان تحوز خدماتنا على رضاكم,,في حال وجود شكاوى على الخدمة المقدمة أواقتراحات یمكنكم التواصل معنا على ایمیل sa.print@support
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>                     
                  </td>
               </tr>               
               <tr>
                  <td>&nbsp;</td>
               </tr>
            </table>
         </div>      
      </div>       
   </body>
</html>

