<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// User Register & Login Delivered on 11 Dec 2020

Route::post('/registration', 'API\LoginController@registration');
Route::post('/login', 'API\LoginController@loginUser');
Route::post('/verifyotp', 'API\LoginController@verifyotp');
Route::post('/resendotp', 'API\LoginController@resendotp');
Route::post('/forgetpassword', 'API\LoginController@forgetpassword');
Route::post('/changepassword', 'API\LoginController@changepassword');
Route::get('/role', 'API\LoginController@role');
Route::get('/getprofile', 'API\LoginController@getprofile')->middleware('\App\Http\Middleware\Authuser:true');
Route::post('/deleteprofile', 'API\LoginController@deleteprofile')->middleware('\App\Http\Middleware\Authuser');

Route::post('/updateprofileimage', 'API\LoginController@updateprofileimage')->middleware('\App\Http\Middleware\Authuser');

Route::post('/updateuserprofile', 'API\LoginController@updateuserprofile')->middleware('\App\Http\Middleware\Authuser');

Route::post('/update-language', 'API\LoginController@updateLanguage');
Route::post('/addaddress', 'API\LoginController@addaddress');
Route::get('/getaddress', 'API\LoginController@getaddress');
Route::post('/updateaddress', 'API\LoginController@updateaddress');
Route::post('/updatemobile', 'API\LoginController@updatemobile');
Route::post('/updatepassword', 'API\LoginController@updatepassword')->middleware('\App\Http\Middleware\Authuser:true');


Route::post('/adddocumentandaddress', 'API\LoginController@adddocumentandaddress')->middleware('\App\Http\Middleware\Authuser');
Route::get('/getdocumentandaddress', 'API\LoginController@getdocumentandaddress')->middleware('\App\Http\Middleware\Authuser');
Route::get('/geteducastdropdown', 'API\LoginController@eduCasteDropdowns')->middleware('\App\Http\Middleware\Authuser');
Route::post('/updatedocument', 'API\LoginController@updatedocument')->middleware('\App\Http\Middleware\Authuser:true');


// End User register & Login

/**
 * Start category 14 Dec 2020
 */

Route::get('/getcategory', 'API\CategoryController@getcategory');

Route::post('/getsubcategory', 'API\CategoryController@getsubcategory');


 /**
  * End category
  */
/**
 * Start Material
 */
Route::post('/getmaterial', 'API\MaterialController@getmaterial');

/**
 * End material
 */
/**
 * Start Get Template
 */

Route::post('/gettemplate', 'API\TemplateController@gettemplate');


/**
 * End Template
 */

/**
 * Start Add Product 17 Dec 2020
 */

Route::post('/addproduct', 'API\ProductController@addproduct')->middleware('\App\Http\Middleware\Authuser');
Route::get('/getproduct', 'API\ProductController@getproduct')->middleware('\App\Http\Middleware\Authuser');
Route::post('/deleteproduct', 'API\ProductController@deleteproduct')->middleware('\App\Http\Middleware\Authuser');

// 11 Feb 2021
Route::post('/enquiry', 'API\ProductController@enquiry')->middleware('\App\Http\Middleware\Authuser');

// 18 Dec 2020

Route::get('/getdraftproduct', 'API\ProductController@getdraftproduct')->middleware('\App\Http\Middleware\Authuser');
Route::post('/removedraftproduct', 'API\ProductController@removedraftproduct')->middleware('\App\Http\Middleware\Authuser');
Route::post('/updatedraftproduct', 'API\ProductController@updatedraftproduct')->middleware('\App\Http\Middleware\Authuser');

Route::get('/getuserhome', 'API\ProductController@getuserhome');
Route::post('/getallproduct', 'API\ProductController@getallproduct');

Route::post('/viewallpopularproduct/{id?}', 'API\ProductController@viewallpopularproduct');
Route::get('/viewallrecentlyproduct/{id?}', 'API\ProductController@viewallrecentlyproduct');
Route::post('/viewallrecentlyproduct/{id?}', 'API\ProductController@viewallrecentlyproduct');
Route::post('/viewproduct', 'API\ProductController@viewproduct');
Route::post('/viewsubcategoryproduct', 'API\ProductController@viewsubcategoryproduct');
Route::post('/viewcategoryproduct', 'API\ProductController@viewcategoryproduct');


// 21 Dec 2020
Route::get('/getbanner', 'API\ProductController@getbanner');

 /**
  * End Add Product
  */

// Get Shg Artisan Home Page
Route::post('/getshgartisanhome', 'API\ProductController@getshgartisanhome')->middleware('\App\Http\Middleware\Authuser');

Route::post('/viewartisanshgproduct', 'API\ProductController@viewartisanshgproduct');


Route::post('/viewsartisancategoryproduct', 'API\ProductController@viewsartisancategoryproduct');
// ->middleware('\App\Http\Middleware\Authuser'); ;

// Get Artisan Product And Shg Product with profile
Route::post('/viewartisanshgprofile', 'API\ProductController@viewartisanshgprofile');
Route::get('/getpopup', 'API\ProductController@getpopup');
// ->middleware('\App\Http\Middleware\Authuser');
Route::post('/getnotification', 'API\ProductController@getnotification')->middleware('\App\Http\Middleware\Authuser');
Route::post('/search', 'API\ProductController@search');
Route::post('/searchshg', 'API\ProductController@searchshg')->middleware('\App\Http\Middleware\Authuser');


// Country->state->city Delivered on 11 Dec 2020

Route::get('/get_countries', 'API\CountryController@allcountries');
Route::post('/get_state', 'API\CountryController@getStateByCid');
Route::post('/get_city', 'API\CountryController@getCityBySid');
Route::post('/get_cityy', 'API\CountryController@getCityBySidd');
Route::post('/get-block', 'API\CountryController@getBlockByDid');

// End Country->state->city


// Express Interest And Order Management

Route::post('/express_interest', 'API\ExpressinterestController@expressinterest')->middleware('\App\Http\Middleware\Authuser');
Route::post('/user_interest', 'API\ExpressinterestController@userinterest')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get_interest_byid', 'API\ExpressinterestController@getinterestbyid')->middleware('\App\Http\Middleware\Authuser');
Route::post('/seller_interest', 'API\ExpressinterestController@sellerinterest')->middleware('\App\Http\Middleware\Authuser');
Route::post('/convert_interest_order', 'API\ExpressinterestController@convertinterest')->middleware('\App\Http\Middleware\Authuser');
Route::post('/update_product', 'API\ExpressinterestController@updateproduct')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get_order_byid', 'API\ExpressinterestController@getorderbyid')->middleware('\App\Http\Middleware\Authuser');
Route::post('/order_list', 'API\ExpressinterestController@orderlist')->middleware('\App\Http\Middleware\Authuser');
Route::post('/interest_list', 'API\ExpressinterestController@interestlist')->middleware('\App\Http\Middleware\Authuser');
Route::post('/addrating', 'API\ExpressinterestController@addRating')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get_sells', 'API\ExpressinterestController@getsells')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get_reviews', 'API\ExpressinterestController@getreviews')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-seller-reviews', 'API\ExpressinterestController@getSellerReviews');
Route::post('/get_seller_product', 'API\ExpressinterestController@getsellerproduct')->middleware('\App\Http\Middleware\Authuser');
Route::post('/add-new-sale', 'API\ExpressinterestController@addNewSale')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-clf-ind-order-list', 'API\ExpressinterestController@getClfIndOrderList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-clf-ind-order-details', 'API\ExpressinterestController@getClfIndOrderDetails')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-ind-ividual-user-list', 'API\ExpressinterestController@getIndividualUserList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/add-ind-rating', 'API\ExpressinterestController@addIndRating')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-collection-center-list', 'API\ExpressinterestController@getCollectionCenterList')->middleware('\App\Http\Middleware\Authuser');

//SHG INDIVIDUAL API'=
Route::post('/interest-list', 'API\ExpressinterestController@getIndividualInterestList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/add-interest-list', 'API\ExpressinterestController@addIndividualInterest')->middleware('\App\Http\Middleware\Authuser');
Route::post('/individual-home', 'API\ExpressinterestController@individualHome')->middleware('\App\Http\Middleware\Authuser');
Route::post('/ind-add-product', 'API\ExpressinterestController@getIndProduct')->middleware('\App\Http\Middleware\Authuser');
Route::post('/ind-add-order', 'API\ExpressinterestController@addIndSale')->middleware('\App\Http\Middleware\Authuser');
Route::post('/ind-order-list', 'API\ExpressinterestController@IndOrderList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/ind-get-clf-list', 'API\ExpressinterestController@indGetCLF')->middleware('\App\Http\Middleware\Authuser');
Route::post('/ind-get-review', 'API\ExpressinterestController@indGetReviews')->middleware('\App\Http\Middleware\Authuser');
Route::post('/add-favorite', 'API\ExpressinterestController@addFav')->middleware('\App\Http\Middleware\Authuser');
Route::post('/ind-get-details', 'API\ExpressinterestController@indGetDetails')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-ind-order-details', 'API\ExpressinterestController@getIndOrderDetails')->middleware('\App\Http\Middleware\Authuser');

//collection center
Route::post('/get-order', 'API\ExpressinterestController@getCollectionCenterOrder')->middleware('\App\Http\Middleware\Authuser');
Route::post('/update-order-status', 'API\ExpressinterestController@updateOrderStatus')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-certificate-type-list', 'API\ExpressinterestController@getCertificateTypeList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-grievance-type-list', 'API\ExpressinterestController@getGrievanceTypeList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/add-grievance-ticket', 'API\ExpressinterestController@addGrievanceTicket')->middleware('\App\Http\Middleware\Authuser');
Route::post('/add-grievance-message', 'API\ExpressinterestController@addGrievanceMessage')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-ticket-list', 'API\ExpressinterestController@getGrievanceTicketList')->middleware('\App\Http\Middleware\Authuser');
Route::post('/get-ticket-chat-list', 'API\ExpressinterestController@getTicketChatList')->middleware('\App\Http\Middleware\Authuser');
Route::get('/get-survey-list', 'API\ExpressinterestController@getSurveyList')->middleware('\App\Http\Middleware\Authuser');
Route::get('/add-price', 'API\ExpressinterestController@addPiceTestingScript');
Route::post('/sadhan-list', 'API\ExpressinterestController@getSadhanList');
Route::post('/sarvottam-list', 'API\ExpressinterestController@getSarvottamsList');
Route::post('/suvidha-list', 'API\ExpressinterestController@getSuvidhaList');
Route::post('/faq-topic-list', 'API\ExpressinterestController@getFaqTopicList');
Route::post('/faq-topic-question', 'API\ExpressinterestController@getFaqTopicQuestion');
Route::get('/get-chat-messages', 'API\ExpressinterestController@getChatMessages');

