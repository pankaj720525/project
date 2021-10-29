<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use App\Models\PaymentHistory;
use App\Models\Subscription;
use App\Models\CampaignsMaster;

class Helper {

	public static function backend_asset($url){
		return asset('public/backend/'.$url);
	}
	public static function frontend_asset($url){
		return asset('public/frontend/'.$url);
	}
	public static function assets($url){
		return asset('public/assets/'.$url);
	}
	public static function public_assets($url){
		return asset('public/'.$url);
	}
	public static function getEncrypted($id)
	{
	    $encrypted_string = openssl_encrypt($id, "AES-128-ECB", "4pU3$(`v&[l!`V`y");
	    return base64_encode($encrypted_string);
	}
	public static function getDecrypted($id){
		$string = openssl_decrypt(base64_decode($id), "AES-128-ECB", "4pU3$(`v&[l!`V`y");
	    return $string;
	}
	public static function custOrderBy($column_name = "", $orderby_val = "", $request_column = "", $column_title = "", $default_column = "", $default_val = "")
	{

		if($column_title == ""){
			$column_title = ucwords(str_replace('_', ' ', $column_name));
		}
		if(($request_column == $column_name) || $default_column != ""){
			if($default_val != ""){
				$orderby_val = $orderby_val;
			}
			if($orderby_val == 'asc'){
				$cust_column = '<a href="Javascript:;" class="orderby text-black" data-column="'.$column_name.'" data-orderby="'. $orderby_val .'">'. $column_title .' <span id="orderby-'.$column_name.'" class="font-bold cust-font-circular"> ↑ </span></a>';
			}else{
				$cust_column = '<a href="Javascript:;" class="orderby text-black" data-column="'.$column_name.'" data-orderby="'. $orderby_val .'">'. $column_title .' <span id="orderby-'.$column_name.'" class="font-bold cust-font-circular"> ↓ </span></a>';
			}
		}else{
			$cust_column = '<a href="Javascript:;" class="orderby text-black" data-column="'.$column_name.'" data-orderby="asc">'. $column_title .'</a>';
		}
	    return $cust_column;
	}

	public static function getActiveClass($routes = [])
	{
		$class = '';
		if(in_array(\Route::currentRouteName(), $routes)){
			$class = "active";
		}
		return $class;
	}

	public static function str_limit($string,$limit){
		return Str::limit($string, $limit);
	}

	public static function createPaymentHistory($data,$type="0")
	{
	    if($type == '1'){
	        $description = "Subscription plan upgrade successfully";
	    }else if($type=='2'){
	        $description = "Subscription plan downgrade successfully";
	    }else if($type=='3'){
	        $description = "Subscription plan renew successfully";
	    }else{
	        $description = "Subscription plan activate successfully";
	    }

	    $subscription = Subscription::select('search_limit','is_unlimited')
	    ->where('id',$data['subscription_id'])
	    ->first();

		$payment = new PaymentHistory();
	    $payment->user_id 			= $data['user_id'];
	    $payment->subscription_id 	= $data['subscription_id'];
	    $payment->description 		= $description;
	    $payment->transaction_id 	= $data['transaction_id'];
	    $payment->amount 			= $data['amount'];
	    $payment->start_date 		= $data['start_date'];
	    $payment->end_date 			= $data['end_date'];
	    $payment->search_limit 		= @$subscription->search_limit;
	    $payment->is_unlimited 		= @$subscription->is_unlimited;
	    $payment->is_upgrade 		= $type;
	    $payment->save();
	}

	public static function getSearchTypeImg($key){
		if($key == 1){
			$link = 'needs_blog_content.png';
		}elseif($key == 2){
			$link = 'missing_broken_ssl.png';
		}elseif($key == 3){
			$link = 'needs_seo.png';
		}elseif($key == 4){
			$link = 'needs_analytics.png';
		}elseif($key == 5){
			$link = 'needs_reviews.png';
		}elseif($key == 6){
			$link = 'slow_website.png';
		}elseif($key == 7){
			$link = 'missing_schema.png';
		}else{
			$link = 'basic_search.png';
		}
	   return $link;
	}

	public static function getYoutubeLink($url){
		$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
		$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

		if (preg_match($longUrlRegex, $url, $matches)) {
			$youtube_link = 'https://www.youtube.com/embed/'. $matches[count($matches) - 1];
		}else{
			$youtube_link = "";
		}

		return $youtube_link ;
	}

	public static function getToken(){
        $url = env('LEGIIT_DOMAIN').'/oauth/token';
        $requestParams = [
                    'grant_type' => 'password',
                    'client_id' => env('PASSPORT_CLIENT_ID'),
                    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                    'username' => env('LEGIIT_USERNAME'),
                    'password' => env('LEGIIT_PASSWORD'),
                    'scope' => '',
                ];

        $headers = array(
            "Content-type: application/json",
            "Accept: application/json",
            "Authorization: Basic ".base64_encode('legiit-user:pQ3!vU9.pV9&aP0~')
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParams));
        $result = curl_exec($ch);
        $result = json_decode($result,true);
        return $result;
    }

	public static function callLegiitServiceApi($service_type,$token){
        $url = env('LEGIIT_DOMAIN').'/api/lead/v1/service-list';
        $requestParams['search_type']=$service_type;
        $headers = array(
            "Content-type: application/json",
            "Accept: application/json",
            "Authorization: Bearer " . $token
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParams));
        $result = curl_exec($ch);
        $result = json_decode($result,true);
        return $result;
    }

    public static function generateSlug($string){
    	$string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
   		return strtolower(preg_replace('/[^A-Za-z0-9\_]/', '', $string)); // Removes special chars.
    }

    public static function imageExists($link='',$profile=''){
    	if(@getimagesize($link)){
    		return $link;
    	}else{
    		if($profile == ''){
    			return Helper::assets('img/No-image-found.jpg');
    		}else{
    			return Helper::assets('img/Profile.png');
    		}
    	}
    }

    public static function checkSearchLimit($user_id,$user_searches){
    	$transaction = PaymentHistory::select('id','is_unlimited')
    	->whereDate('end_date', '>=', \Carbon\Carbon::now())
    	->where('is_unlimited',1)
    	->where('user_id',$user_id)
    	->first();

    	if($transaction){
	       	if($transaction->is_unlimited == 1)
        	{
        		return true;
        	}
		}else{
			$search_limit = PaymentHistory::select('id','search_limit')
    		->whereDate('end_date', '>', \Carbon\Carbon::now())
    		->where('is_unlimited',0)
    		->where('user_id',$user_id)
    		->orderby('id','ASC')
    		->sum('search_limit');
			if($user_searches >= $search_limit){
				return false;
			}else{
				return true;
        	}
		}

		return false;
    }

    public static function getBillingPeriod($biling = ''){
    	$biling_period = ['day'=>'Day','month'=>'Month','year'=>'Year','lifetime'=>'Lifetime'];

    	if(!empty($biling)){
    		return $biling_period[$biling];
    	}else{
    		return $biling_period;
    	}
    }
}
