<?php
namespace App\Helpers;

use App\User;
use App\ProductMaster;
use App\Category;
use App\CertificateType;

use DB;
use Illuminate\Support\Facades\Mail;
class Helper
{

	public static function getTotalActiveProduct($sellerId){
		try{
				$count =ProductMaster::where('is_active',1)->where('user_id',$sellerId)->count();
				return $count;
		}catch(Exception $e){
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}
	
    public static function getCatBySubCat($parentId){
		try{
				$cat =Category::where('is_active',1)->where('parent_id',$parentId)->first();
				return $cat;
		}catch(Exception $e){
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}
	public static function getCertificateTypeById($typeId, $language)
	{
		# code...
		try{
			$name = 'name_en  as name';
			if ($language == 'hi') {
				$name = 'name_hi  as name';
			}
			$type =CertificateType::select('id',$name)->where('id',$typeId)->first();
			return $type;
		}catch(Exception $e){
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}
	
	public static function userRegForChat($userId,$deviceToken,$name,$signupType)
	{
		
	
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/signup",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "fullName=$name&deviceToken=$deviceToken&userId=$userId&signupType=$signupType",
				  CURLOPT_HTTPHEADER => array(
					"Content-Type: application/x-www-form-urlencoded"
				  ),
				));
				
				$response = curl_exec($curl);
				
				curl_close($curl);
				//echo $response;
	}
	public static function userUpdateForChat($userId,$image,$name)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/updateProfile",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "fullName=$name&userId=$userId&image=$image",
		CURLOPT_HTTPHEADER => array(
		"Content-Type: application/x-www-form-urlencoded"
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		//echo $response;
	}
	public static function userSignInForChat($userId,$deviceToken,$signupType)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/signin",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "deviceToken=$deviceToken&userId=$userId&signupType=$signupType",
		CURLOPT_HTTPHEADER => array(
		"Content-Type: application/x-www-form-urlencoded"
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		//echo $response;
	}
	public static function startChatConversation($aliasId,$userId,$byUserId,$orderId,$libraryId,$byUserWishListId,$userWishListId)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/startChatConversation",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "aliasId=$aliasId&toUserId=$userId&fromUserId=$byUserId&orderId=$orderId&libraryId=$libraryId&byUserWishListId=$byUserWishListId&userWishListId=$userWishListId",
		CURLOPT_HTTPHEADER => array(
		"Content-Type: application/x-www-form-urlencoded"
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		//echo $response;
	}
	public static function endChatConversation($userId,$byUserId,$orderId)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/endChatConversation",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "toUserId=$userId&fromUserId=$byUserId&orderId=$orderId",
		CURLOPT_HTTPHEADER => array(
		"Content-Type: application/x-www-form-urlencoded"
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		//echo $response;
	}
	////////////////////////////////
}