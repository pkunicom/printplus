<?php

	function get_google_api_key()
	{
		$key = 'AIzaSyB9s91K1zHQ4zz0v9oCVPnNingRJt2SGGc';
		return $key;
	}

	function base64ToImage($base64_string, $output_file) 
	{
	    $file = fopen($output_file, "wb");

	    $data = explode(',', $base64_string);

	    fwrite($file, base64_decode($data[1]));
	    //dd($base64_string, $output_file,base64_decode($data[1]));
	    fclose($file);

	    return $output_file;
	}

	function imageToBase64($imgSrc)
	{
	    $type   = pathinfo($imgSrc, PATHINFO_EXTENSION);
	    $data   = file_get_contents($imgSrc);
	    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	    
	    return $base64;
	}


	function get_image_upload_note($for='',$height=10,$width=10, $size=2)
	{
	    $txt = '';
	    if(isset($for) && $for!=false && $for=='admin_profile')
	    {
	       $txt = '<span>Allowed only jpg | jpeg | png  '."<br>".'Please upload image Height and Width greater than or equal to '.$height.' X '.$width.' with maximum size '.$size.'MB for best result.</span>';
	   }
	   elseif(isset($for) && $for!=false && $for=='advertisement')
	   {
	       $txt = 'Allowed only jpg | jpeg | png | bmp image.'.'<br/>'.'You can drag image to re-postion or use slider to zoom-in or zoom-out image.'.'<br/>'.'For best result upload image Height and Width greater than or equal to '.$height.' X '.$width.' for best result.';
	   }

	   return $txt;
	}

	function get_details_by_ip()
	{
		$getInfoByIp = [];
		
		$getInfoByIp['latitude'] = '40.7128';
		$getInfoByIp['longitude'] = '74.0060';
		$getInfoByIp['city'] = 'New York'; 
		$getInfoByIp['state'] = 'New York';
		$getInfoByIp['country'] = 'manhattan';

		return $getInfoByIp;
	}

	function get_location_data()
	{
		$locationData = [];

		if(isLocation())
		{
			$locationData = Session::get('locationData');
			// dd($locationData);
		}
		else
		{
			$locationData = get_details_by_ip();
		}

		return $locationData;
	}

	function isLocation()
	{
		$status = false;
		$locationData = Session::get('locationData');
		
		if(isset($locationData) && $locationData !=null && is_array($locationData) && sizeof($locationData)>0)
		{
			$status = true;
		}
		else
		{
			$status = false;
		}
		return $status;
	}
	

	function get_resized_image($image_file = FALSE,$dir=FALSE,$height=250,$width=250,$fallback_text="No Image Available")
    {
    ini_set('memory_limit', '600M' );//THIS MEMORY LIMIT FOR RESOLOTION 10000 * 10000 Approx

    $CACHE_DIR             = 'resize_cache/';
    $CACHE_DIR_BASE_PATH   = base_path().'/uploads/'.$CACHE_DIR;
    $CACHE_DIR_PUBLIC_PATH = url('/').'/uploads/'.$CACHE_DIR;
    //dd($CACHE_DIR_BASE_PATH, $CACHE_DIR_PUBLIC_PATH);
    $real_dir = $dir;
    $extension  = get_extension($image_file);

    if($image_file == FALSE || $dir == FALSE)
    {
        return get_default_logo_image($height, $width);
        /*return "https://assets.imgix.net/~text?txtsize=33&txt=".$fallback_text."&w=".$width."&h=".$height.'&txtalign=center,middle&bg=7d7d7d&txtclr=fff&border-radius=5';*/
    }

    /* Check if File Exists */
    if(!image_exists($real_dir.$image_file))
    {
        return get_default_logo_image($height, $width);

        /*return "https://assets.imgix.net/~text?txtsize=33&txt=".$fallback_text."&w=".$width."&h=".$height.'&txtalign=center,middle&bg=7d7d7d&txtclr=fff&border-radius=5';*/
    }

    /* Check if Given file is image*/
    if(!is_valid_image($real_dir.$image_file))
    {   
        return get_default_logo_image($height, $width);
        /*return "https://assets.imgix.net/~text?txtsize=33&txt=No+Image&w=".$width."&h=".$height.'&txtalign=center,middle&bg=7d7d7d&txtclr=fff&border-radius=5';*/
    }

    /* Generate Expected Resized Image Name */
    $expected_resize_image_name = generate_resized_image_name($image_file,$width,$height,$extension);

    /*dd($CACHE_DIR_BASE_PATH,$expected_resize_image_name);*/
    if(!image_exists($CACHE_DIR_BASE_PATH.$expected_resize_image_name))
    {
        /* Create Cache Dir */
        $parent_dir =  dirname($real_dir.$expected_resize_image_name);
        @mkdir($CACHE_DIR_BASE_PATH,0777);
        $real_path   = $real_dir.$image_file;   
        $status = Image::make( $real_path )->fit( $width, $height , function ($constraint){
            $constraint->upsize();
        })->save( $CACHE_DIR_BASE_PATH.$expected_resize_image_name );
    }
    return $CACHE_DIR_PUBLIC_PATH.$expected_resize_image_name;
}


function get_default_logo_image($height=10,$width=10,$txtsize=10, $txt='Image Not Found')
{
	$expected_resize_image_name = url('/uploads/default/default-800x400.jpg');

	return $expected_resize_image_name;
}

function get_extension($image_file)
{
    $arr_part = array();
    $arr_part = explode('.', $image_file);
    return end($arr_part);
}

function is_valid_image($image_real_path)
{
   return @getimagesize($image_real_path);
}

function image_exists($image_real_path)
{
    if (!is_readable($image_real_path)) 
    {
        return FALSE;
    } 
    return TRUE;
}

function generate_resized_image_name($file_name,$width,$height,$extension)
{
    return substr($file_name, 0, strrpos($file_name, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
}

function slugify($text)
{
	$slug = preg_replace('/([?]|\p{P}|\s)+/u', '-', $text);
	if (empty($slug)) {
		return 'n-a';
	}
   	return $slug;
}

function formatted_date($date, $with_time=true)
{
	$str_formatted = date('d/m/Y', strtotime($date));

	if($with_time){
		$str_formatted .= ' '.date('h:m A', strtotime($date));
	}

	return $str_formatted;
}

function get_user_default_image($gender='') 
{
	if($gender=='female'){
		$img = url('/uploads/default/unknown-woman.jpg');
	}else{
		$img = url('/uploads/default/unknown-man.jpg');
	}
	return $img;
}

?>