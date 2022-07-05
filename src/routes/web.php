<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use App\User;
use Illuminate\Support\Facades\Input;

Auth::routes();
// Route::get('/en', function () {
//     session()->put('weblangauge', 'en');
//     return back();
// });
// Route::get('/kn', function () {
//     session()->put('weblangauge', 'kn');
//     return back();
// });
use App\Http\Middleware\Verifyadmin;
Route::get('/admin/login', 'Auth\LoginController@admin_login')->name('adminLogin'); 

Route::middleware([Verifyadmin::class])->group(function () {
    Route::get('/admin', 'HomeController@index')->name('home');

    // Route for Role
    Route::get('admin/role', 'RoleController@index');
    Route::get('admin/addrole', 'RoleController@create');
    Route::post('admin/addrole', 'RoleController@store');
    Route::get('admin/editrole/{id}', 'RoleController@edit');
    Route::post('admin/updaterole/{id}', 'RoleController@update');
    // End Route for Role

    // Route for Admin Users
    Route::get('admin/adminuser', 'AdminController@index');
    Route::get('admin/addadminuser', 'AdminController@create');
    Route::post('admin/addadminuser', 'AdminController@store');
    Route::get('admin/editAdmin/{id}', 'AdminController@edit');
    Route::post('admin/editAdmin/{id}', 'AdminController@update');
    Route::get('admin/blockunblockAdmin/{id}/{status}', 'AdminController@destroy');

    // Routs For General For SHG Individual Users
    Route::get('admin/ind-users', 'IndUserController@index');
    Route::get('admin/block-ind-user/{id}/{status}', 'IndUserController@blockUser');

    //Route for Category
    Route::get('admin/category', 'CategoryController@index');
    Route::get('admin/addcategory', 'CategoryController@create');
    Route::post('admin/addcategory', 'CategoryController@store');
    Route::get('admin/editCategory/{id}', 'CategoryController@edit');
    Route::post('admin/editCategory/{id}', 'CategoryController@update');
    Route::get('admin/viewcategory/{id}', 'CategoryController@view');
    Route::get('admin/enabledisablecategory/{id}/{status}', 'CategoryController@enabledisablecategory');

    //Route for Material
    Route::get('admin/material', 'MaterialController@index');
    Route::get('admin/addmaterial', 'MaterialController@create');
    Route::post('admin/addmaterial', 'MaterialController@store');
    Route::get('admin/editMaterial/{id}', 'MaterialController@edit');
    Route::post('admin/editMaterial/{id}', 'MaterialController@update');

    //Route for templates
    Route::get('admin/templates', 'ProductTemplateController@index');
    Route::get('admin/addTemplate', 'ProductTemplateController@create');
    Route::post('admin/addTemplate', 'ProductTemplateController@store');
    Route::get('admin/editTemplate/{id}', 'ProductTemplateController@edit');
    Route::post('admin/editTemplate/{id}', 'ProductTemplateController@update');

    //Route for Document
    Route::get('admin/document', 'DocumentController@index');
    Route::get('admin/viewDocument/{id}', 'DocumentController@show');

    //Route for Document Reject and Accept
    Route::get('admin/acceptAdhar/{id}/{status}', 'DocumentController@acceptAdhar');
    Route::get('admin/acceptPan/{id}/{status}', 'DocumentController@acceptPan');
    Route::get('admin/acceptBrn/{id}/{status}', 'DocumentController@acceptBrn');

    //Routs for General Users
    Route::get('admin/users', 'UserController@index');
    Route::get('admin/blockUser/{id}/{status}', 'UserController@blockUser');

    // Routs for Home page banner
    Route::get('admin/banner', 'BannerController@index');
    Route::get('admin/addbanner', 'BannerController@create');
    Route::post('admin/addbanner', 'BannerController@store');
    Route::get('admin/editbanner/{id}', 'BannerController@edit');
    Route::post('admin/editbanner/{id}', 'BannerController@update');
    Route::get('admin/deletebanner/{id}/{status}', 'BannerController@destroy');
    Route::get('admin/del/{id}', 'BannerController@del');

    // Routs for Individual Category Management
    Route::get('admin/indcategory', 'IndividualCategoryController@index');
    Route::get('admin/indcategory/addcategory', 'IndividualCategoryController@create');
    Route::post('admin/indcategory/addcategory', 'IndividualCategoryController@store');
    Route::get('admin/indcategory/editcategory/{id}', 'IndividualCategoryController@edit');
    Route::post('admin/indcategory/editcategory/{id}', 'IndividualCategoryController@update');
    Route::get('admin/indcategory/deletecategory/{id}/{status}', 'IndividualCategoryController@destroy');
    Route::get('admin/indcategory/del/{id}', 'IndividualCategoryController@del');

    // Routes for Individual Products Management
    Route::get('admin/individual/products', 'IndividualProductController@index');
    Route::get('admin/individual/addproduct', 'IndividualProductController@create');
    Route::post('admin/individual/addproduct', 'IndividualProductController@store');
    Route::get('admin/individual/editproduct/{id}', 'IndividualProductController@edit');
    Route::post('admin/individual/editproduct/{id}', 'IndividualProductController@update');
    Route::get('admin/individual/deleteproduct/{id}/{status}', 'IndividualProductController@destroy');
    Route::get('admin/individual/del/{id}', 'IndividualProductController@del');
    Route::post('admin/individual/ajaxshow', 'IndividualProductController@ajaxshow');



    // Routs for Individual Collection Management
    Route::get('admin/collection-center', 'CollectionController@index');
    Route::get('admin/collection-center/addcollection', 'CollectionController@create');
    Route::post('admin/collection-center/addcollection', 'CollectionController@store');
    Route::get('admin/collection-center/editcollection/{id}', 'CollectionController@edit');
    Route::post('admin/collection-center/editcollection/{id}', 'CollectionController@update');
    Route::get('admin/collection-center/deletecollection/{id}/{status}', 'CollectionController@destroy');
    Route::get('admin/collection-center/del/{id}', 'CollectionController@del');
    Route::post('admin/collection-center/cityAjax', 'CollectionController@cityAjax');
    Route::post('admin/collection-center/blockAjax', 'CollectionController@blockAjax');
    // Routes for Individual collection user
    Route::get('admin/collection-center/adduser/{collection_id}', 'CollectionController@adduser');
    Route::post('admin/collection-center/adduser', 'CollectionController@storeUser');
    Route::get('admin/collection-center/viewuser/{collection_id}', 'CollectionController@viewUser');
    Route::get('admin/collection-center/edituser/{collection_id}', 'CollectionController@editUser');
    Route::post('admin/collection-center/edituser/{collection_id}', 'CollectionController@updateUser');
    Route::get('admin/collection-center/deleteuser/{id}/{status}', 'CollectionController@destroyUser');





    // Routes for SHG/Atrisan
    Route::get('admin/shgartisans', 'ShgAtrisanController@index');
    Route::get('admin/viewshgatrisan/{id}', 'ShgAtrisanController@show');
    Route::get('admin/blockshgatrisan/{id}/{status}', 'ShgAtrisanController@destroy');

    // Routes for Products Management
    Route::get('admin/products', 'ProductController@index');
    Route::get('admin/viewproduct/{id}', 'ProductController@show');
    Route::get('admin/popular/{id}/{status}', 'ProductController@popular');
    Route::get('admin/addtopopular/{id}', 'ProductController@addtopopular');
    Route::get('admin/editproduct/{id}', 'ProductController@edit');
    Route::post('admin/editproduct/{id}', 'ProductController@update');
    Route::get('admin/removepopular/{id}', 'ProductController@removepopular');
    //Route::get('admin/deleteproduct/{id}', 'ProductController@destroy');
    Route::get('admin/products/{id}/{status}', 'ProductController@destroy');

    //Routes For Popular Products Management
    Route::get('admin/popularproducts', 'PopularProductController@index');
    Route::get('admin/addpopular', 'PopularProductController@create');
    Route::post('admin/addpopular', 'PopularProductController@store');
    Route::get('admin/removefrompopular/{id}', 'PopularProductController@removepopular');

    //Routes For Popup management
    Route::get('admin/popupmanager', 'PopupController@index');
    Route::get('admin/addpopup', 'PopupController@create');
    Route::post('admin/addpopup', 'PopupController@store');
    Route::get('admin/editpopup/{id}', 'PopupController@edit');
    Route::post('admin/editpopup/{id}', 'PopupController@update');
    Route::get('admin/popupmanager/deletepopup/{id}', 'PopupController@destroy');
    Route::get('admin/deletepopupfinal/{id}', 'PopupController@deletepopupfinal');

    //Routes For Notification Manager
    Route::get('admin/notification', 'NotificationController@index');
    Route::get('admin/addnotification', 'NotificationController@create');
    Route::post('admin/addnotification', 'NotificationController@store');


    //Routes For Bulk SMS
    Route::get('admin/sendbulkmessage', 'NotificationController@bulkindex');
    Route::get('admin/addbulk', 'NotificationController@addbulk');
    Route::post('admin/addbulk', 'NotificationController@storebulk');

    Route::get('admin/sendbulkemail', 'NotificationController@bulkemailindex');
    Route::get('admin/addEmailbulk', 'NotificationController@addemailbulk');
    Route::post('admin/addEmailbulk', 'NotificationController@storeemailbulk');


    // routes for permission management
    Route::get('admin/permission', 'PermissionController@index');
    Route::get('admin/addpermission', 'PermissionController@create');
    Route::post('admin/addpermission', 'PermissionController@store');
    Route::get('admin/editpermission/{id}', 'PermissionController@edit');
    Route::post('admin/editpermission/{id}', 'PermissionController@update');

    Route::get('admin/removepermission/{id}/{status}', 'PermissionController@destroy');

    // routes for role permission management

    Route::get('admin/rolepermission/{id}', 'RolepermissionController@index');
    Route::get('admin/addrolepermission', 'RolepermissionController@create');
    Route::post('admin/addrolepermission/{id}', 'RolepermissionController@store');
    Route::get('admin/editrolepermission/{id}', 'RolepermissionController@edit');
    Route::post('admin/editrolepermission/{id}', 'RolepermissionController@update');

    Route::get('admin/removerolepermission/{id}/{status}', 'RolepermissionController@destroy');

    // Interset Management
    Route::get('admin/interest', 'InterestController@index');
    Route::get('admin/interest/view/{id}', 'InterestController@view');

    // Order Management
    Route::get('admin/orders', 'OrderController@index');
    Route::get('admin/orders/view/{id}', 'OrderController@view');

  // Individual Order Management
  Route::get('admin/ind-orders', 'IndOrderController@index');
  Route::get('admin/ind-orders/view/{id}', 'IndOrderController@view');
  
	//Route for Product Certificate
    Route::get('admin/certificate', 'ProductCertificationController@index');
    Route::get('admin/viewCertificate/{id}', 'ProductCertificationController@show');

    //Route for Product Certificate Reject and Accept
    Route::get('admin/acceptCertificate/{id}/{status}/{status_col}', 'ProductCertificationController@acceptCertificate');
    // Grievance routes
    Route::get('admin/grievance', 'GrievanceController@index');
    Route::get('admin/viewGrievance/{id}', 'GrievanceController@show');
    //Route for Grievance Ticket Close
    Route::get('admin/closeTicket/{id}/{status}', 'GrievanceController@closeTicket');
    Route::post('admin/grievanceReply', 'GrievanceController@grievanceReply');
    // Survey List & View routes
    Route::get('admin/survey', 'SurveyController@index');
    Route::get('admin/viewSurvey/{id}', 'SurveyController@show');
    Route::get('admin/addsurvey', 'SurveyController@create');
    Route::post('admin/addsurvey', 'SurveyController@store');
    Route::get('admin/editSurvey/{id}', 'SurveyController@edit');
    Route::post('admin/editSurvey/{id}', 'SurveyController@update');

    //individaul interest type
    // Routs for Individual Category Management
    Route::get('admin/interest-type', 'IndividualInterestController@index');
    Route::get('admin/interest/addinteresttype', 'IndividualInterestController@create');
    Route::post('admin/interest/addinteresttype', 'IndividualInterestController@store');
    Route::get('admin/interest/editinteresttype/{id}', 'IndividualInterestController@edit');
    Route::post('admin/interest/editinteresttype/{id}', 'IndividualInterestController@update');
    Route::get('admin/interest/deleteinteresttype/{id}/{status}', 'IndividualInterestController@destroy');
    Route::get('admin/interest/del/{id}', 'IndividualInterestController@del');


     // sarvottams
     Route::get('admin/sarvottams', 'SarvottamController@index');
     Route::get('admin/addsarvottam', 'SarvottamController@create');
     Route::post('admin/addsarvottam', 'SarvottamController@store');
     Route::get('admin/editsarvottam/{id}', 'SarvottamController@edit');
     Route::post('admin/editsarvottam/{id}', 'SarvottamController@update');
     Route::get('admin/deletesarvottam/{id}/{status}', 'SarvottamController@destroy');
     Route::get('admin/sarvottamdel/{id}', 'SarvottamController@del');

      // sadhans
      Route::get('admin/sadhan', 'SadhanController@index');
      Route::get('admin/addsadhan', 'SadhanController@create');
      Route::post('admin/addsadhan', 'SadhanController@store');
      Route::get('admin/editsadhan/{id}', 'SadhanController@edit');
      Route::post('admin/editsadhan/{id}', 'SadhanController@update');
      Route::get('admin/deletesadhan/{id}/{status}', 'SadhanController@destroy');
      Route::get('admin/sadhandel/{id}', 'SadhanController@del');

      //sadhans cat
     
      Route::get('admin/sadhan-cat', 'CatSadhanController@index');
      Route::get('admin/addsadhancat', 'CatSadhanController@create');
      Route::post('admin/addsadhancat', 'CatSadhanController@store');
      Route::get('admin/editsadhancat/{id}', 'CatSadhanController@edit');
      Route::post('admin/editsadhancat/{id}', 'CatSadhanController@update');
      Route::get('admin/deletesadhancat/{id}/{status}', 'CatSadhanController@destroy');

       // suvidhas
     Route::get('admin/suvidha', 'SuvidhaController@index');
     Route::get('admin/addsuvidha', 'SuvidhaController@create');
     Route::post('admin/addsuvidha', 'SuvidhaController@store');
     Route::get('admin/editsuvidha/{id}', 'SuvidhaController@edit');
     Route::post('admin/editsuvidha/{id}', 'SuvidhaController@update');
     Route::get('admin/deletesuvidha/{id}/{status}', 'SuvidhaController@destroy');
     Route::get('admin/suvidhadel/{id}', 'SuvidhaController@del');

      // faq
      Route::get('admin/faq', 'FaqController@index');
      Route::get('admin/addfaq', 'FaqController@create');
      Route::post('admin/addfaq', 'FaqController@store');
      Route::get('admin/editfaq/{id}', 'FaqController@edit');
      Route::post('admin/editfaq/{id}', 'FaqController@update');
      Route::get('admin/deletefaq/{id}/{status}', 'FaqController@destroy');
      Route::get('admin/faqquestion/{id}', 'FaqController@questionList');
      Route::get('admin/addfaqquestion/{id}', 'FaqController@createq');
      Route::post('admin/addfaqquestion', 'FaqController@storeq');
      Route::get('admin/editfaqquestion/{id}', 'FaqController@editq');
      Route::post('admin/editfaqquestion/{id}', 'FaqController@updateq');
      Route::get('admin/updatefaqquestion/{id}/{status}', 'FaqController@destroyq');
      // chat Message
      Route::get('admin/chat-message','ChatMessageController@index');
      Route::get('admin/add-chat-message','ChatMessageController@create');
      Route::post('admin/add-chat-message','ChatMessageController@store');
      Route::get('admin/delete_msg/{id}/{status}', 'ChatMessageController@destroy');
});

//Route::get('/','Forntend\HomeController@login');
Route::get('/login', function() {
    return redirect('/');
});


//ajax controller
Route::post('/getmsg', 'AjaxController@index');
Route::post('/get_subcats', 'AjaxController@get_subcats');
Route::post('/get_material', 'AjaxController@get_material');
Route::post('/get_products', 'AjaxController@get_products');
Route::post('/get_allcategories', 'AjaxController@get_allcategories');
Route::post('/searchhome', 'AjaxController@searchhome');
Route::post('/getallproduct', 'AjaxController@getallproduct');
Route::post('/changeroletype', 'AjaxController@changeroletype');
Route::post('/checkpincode', 'AjaxController@checkpincode');
Route::post('/resendotp', 'AjaxController@resendotp');
Route::post('/getstate', 'AjaxController@getstate');
Route::post('/exportMasterReport', 'AjaxController@exportMasterReport');
Route::post('/get-blocks', 'AjaxController@getBlockByCityId');


///////// Frontend Routes Start From Here /////

Route::group(['namespace'=>'Forntend'],function(){

    Route::get('/login','HomeController@login')->name('login');
    Route::post('/get_template', 'ProductController@get_template');

    Route::post('/blockAjax','HomeController@blockAjax')->name('blockAjax');
    Route::post('/blockAjaxx','HomeController@blockAjaxx')->name('blockAjaxx');


    //Routes For Frontend
    Route::get('/', 'HomeController@index')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/logout', 'HomeController@logout');

    Route::get('/moreproducts', 'HomeController@moreproducts')->middleware('\App\Http\Middleware\Checksession');

    Route::get('/frontlogin', 'HomeController@login');
    Route::post('/frontlogin', 'HomeController@doLogin');
    Route::get('/forgetpassword', 'HomeController@forgetpassword');
    Route::post('/forgetpassword', 'HomeController@forgetpass');
    Route::get('/verifyotp/{type}', 'HomeController@verifyotp');
    Route::post('/verifyotp', 'HomeController@checkotp');
    Route::get('/changepassword/{mobile}/{otp}', 'HomeController@changepassword');
    Route::post('/changepassword', 'HomeController@updatepassword');

    //Routes for Web User profile
    Route::get('/profile', 'UserController@viewprofile')->middleware('\App\Http\Middleware\Checksession','checkindinterest');;
    Route::get('/changeprofileimage', 'UserController@changeprofileimage');
    Route::post('/changeprofileimage', 'UserController@updateprofileimage');
    Route::post('/deleteprofile', 'UserController@deleteprofile');

    Route::get('/changepassword', 'UserController@changepassword');
    Route::post('/changepassword', 'UserController@updatechnagepassword');

    Route::get('/deleteproduct/{id}', 'ProductController@deleteproduct');

    Route::post('/expressintrest', 'HomeController@expressintrest');





    Route::post('/editprofile', 'UserController@editprofile')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/add_document', 'UserController@add_document');
    Route::post('/add_document', 'UserController@add_document_update');
    Route::get('/uploaddocument/{type}', 'UserController@updatedoc');
    Route::post('/uploaddocument/{type}', 'UserController@updatedoc_update');
    //Route::post('/get_template', 'UserController@get_template');
    Route::get('/changemobileno', 'UserController@changemobileno')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/changemobileno', 'UserController@updatemobileno')->middleware('\App\Http\Middleware\Checksession');

    Route::get('/changeaddress', 'UserController@changeaddress')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/changeaddress', 'UserController@updateaddress')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/search', 'HomeController@search')->middleware('\App\Http\Middleware\Checksession');


    //Add Product Routes
    Route::get('/addproduct', 'ProductController@addproduct')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/addproduct_step_2', 'ProductController@addproduct_step_2')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/addprpduct_final', 'ProductController@addprpduct_final')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/addproduct', 'ProductController@addproduct_to_db')->middleware('\App\Http\Middleware\Checksession');



    //Edit product and Draft produt route

    Route::get('/editproduct/{id}', 'ProductController@editproduct')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/editproduct_step_2/{id}', 'ProductController@editproduct_step_2')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/editprpduct_final/{id}', 'ProductController@editprpduct_final')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/editproduct/{id}', 'ProductController@editproduct_to_db')->middleware('\App\Http\Middleware\Checksession');


    //Profile
    Route::get('/profile/home', 'UserController@getshgartisanhome')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    //Route::get('/draft', 'UserController@draft')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/frontregister', 'HomeController@register')->middleware('\App\Http\Middleware\Checksession');
    // Route::get('/categories', 'Forntend\HomeController@categories')->middleware('\App\Http\Middleware\Checksession');
    // Route::get('/category/{id}', 'Forntend\HomeController@singleCategory')->middleware('\App\Http\Middleware\Checksession');
    // Route::get('/category/{id}/{subcatid}', 'Forntend\HomeController@subCategory')->middleware('\App\Http\Middleware\Checksession');

    Route::get('/categories', 'HomeController@categories');
    Route::get('/category/{id}', 'HomeController@singleCategory');
    Route::get('/category/{id}/{subcatid}', 'HomeController@subCategory');
    Route::get('/product/{id}', 'HomeController@viewproduct')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/shgstrisan/{id}', 'HomeController@getshgartisanhome')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/help', 'HomeController@help');
    Route::get('/privacy-policy', 'HomeController@privacypolicy');
    Route::get('/terms', 'HomeController@terms');
    Route::get('/contact-us', 'HomeController@contactUs');
    Route::get('/disclaimer', 'HomeController@disclaimer');
    
    Route::get('/chat', 'HomeController@chat');
    
    Route::get('/popularseller', 'HomeController@popularSeller');
    Route::get('/popularproducts', 'HomeController@popularproduct');
    Route::get('/recentproducts', 'HomeController@recentproduct');
    Route::get('/demo-one', 'HomeController@demoOne');
    Route::get('/demo-two', 'HomeController@demoTwo');
    Route::get('/demo-three', 'HomeController@demoThree');
    Route::get('/demo-four', 'HomeController@demoFour');
    Route::get('/demo-five', 'HomeController@demoFive');
    Route::get('/demo-six', 'HomeController@demoSix');
    Route::get('/demo-seven', 'HomeController@demoSeven');
    Route::get('/view-rating/{id}', 'HomeController@viewRating');
    // Buyer route
    Route::get('/express-interest/{seller_id}', 'BuyerInterestController@expressInterest')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/express-products/{seller_id}', 'BuyerInterestController@expressProducts')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/add-product-sess/{seller_id}', 'BuyerInterestController@addProductSession')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/add-express-interest/{seller_id}', 'BuyerInterestController@storeExpressIntrest')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/buyer-interest-list', 'BuyerInterestController@getExpressInterestList')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/buyer-interest-detail/{intrest_id}', 'BuyerInterestController@getExpressInterestDetail')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/buyer-order-list', 'BuyerOrderController@getOrderList')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/buyer-order-detail/{order_id}', 'BuyerOrderController@getOrderDetail')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/add-rating-seller/{seller_id}', 'BuyerOrderController@ratingToSeller')->middleware('\App\Http\Middleware\Checksession');

     //Seller route
     Route::get('/seller-interest-list', 'SellerInterestController@getExpressInterestList')->middleware('\App\Http\Middleware\Checksession');
     Route::get('/seller-interest-detail/{intrest_id}', 'SellerInterestController@getExpressInterestDetail')->middleware('\App\Http\Middleware\Checksession');
     Route::get('/seller-order-list', 'SellerOrderController@getOrderList')->middleware('\App\Http\Middleware\Checksession');
     Route::get('/seller-order-detail/{order_id}', 'SellerOrderController@getOrderDetail')->middleware('\App\Http\Middleware\Checksession');
     Route::get('/add-sale', 'SellerOrderController@addOrder')->middleware('\App\Http\Middleware\Checksession');
     Route::post('/add-sale', 'SellerOrderController@addOrder')->middleware('\App\Http\Middleware\Checksession');
     //Route::post('/get-buyer-name', 'SellerOrderController@getBuyerName')->middleware('\App\Http\Middleware\Checksession');
     Route::post('/get-products', 'SellerOrderController@getProducts')->middleware('\App\Http\Middleware\Checksession');
     Route::get('/seller-products/{seller_id}', 'SellerOrderController@sellerProducts')->middleware('\App\Http\Middleware\Checksession');
     Route::post('/add-sale-product-sess/{seller_id}', 'SellerOrderController@addProductSession')->middleware('\App\Http\Middleware\Checksession');
     Route::post('/delete-sess-products', 'SellerOrderController@deleteSessionProduct')->middleware('\App\Http\Middleware\Checksession');
     Route::post('/add-mod-sess', 'SellerOrderController@addModSession')->middleware('\App\Http\Middleware\Checksession');
     
    //grivance
    Route::get('/grievance', 'GrievanceController@index')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/raise-ticket', 'GrievanceController@raiseTicket')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/raise-ticket', 'GrievanceController@raiseTicket')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/grievance-chat/{id}', 'GrievanceController@grievanceChat')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/grievanceReply', 'GrievanceController@grievanceReply')->middleware('\App\Http\Middleware\Checksession');
    // SHG Individual
    Route::get('/ind-home', 'IndividualController@index')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/ind-order-list', 'IndividualController@IndOrderList')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/ind-order-detail/{order_id}', 'IndividualController@getIndOrderDetails')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/my-interest', 'IndividualController@getInterestList')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/add-interest', 'IndividualController@addInterestList')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/add-interest', 'IndividualController@addInterest')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/ind-add-sale', 'IndividualController@addOrder')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::post('/ind-add-sale', 'IndividualController@addOrder')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/ind-products', 'IndividualController@indProducts')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::post('/add-ind-product-sess', 'IndividualController@addIndProductSess')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::post('/delete-sess-ind-products', 'IndividualController@deleteSessionProduct')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::post('/get-clf', 'IndividualController@getClf')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/ind-profile/{id}', 'IndividualController@getIndProfile')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/take-survey', 'SurveyController@index')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/view-ind-rating/{id}', 'IndividualController@viewRating')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/ind-chat', 'IndividualController@indChat')->middleware('\App\Http\Middleware\Checksession','checkindinterest');
    Route::get('/additional-info', 'IndividualController@additionalInfo');
    Route::post('/save-additional-info', 'IndividualController@saveAdditionalInfo');
    //faq for individual user
    Route::get('/faq', 'IndividualController@faq');
    Route::get('/faq-question/{id}', 'IndividualController@faqQuestion');
    Route::get('/faq-desc/{id}', 'IndividualController@faqDesc');
    
//common for favorite
   Route::post('/update-fav', 'HomeController@updateFav')->middleware('\App\Http\Middleware\Checksession');
   

    //clf buy amanger
    Route::get('/buy-manager', 'ClfBuyController@index')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/buy-order-detail/{id}', 'ClfBuyController@getOrderDetail')->middleware('\App\Http\Middleware\Checksession');
    Route::post('/add-rating-buy-order/{id}', 'ClfBuyController@addRatingByClf')->middleware('\App\Http\Middleware\Checksession');
    Route::get('/shg-individuals', 'ClfBuyController@shgIndList')->middleware('\App\Http\Middleware\Checksession');
    
});


