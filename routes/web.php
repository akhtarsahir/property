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



Route::group(['domain' => '{username}.justdeal.pk'], function () {

    $server = explode('.', Request::server('HTTP_HOST'));

    if (count($server) == 3 && 'www' != $server[0])
    {
        Route::get('/', ['as' => 'subdomain','uses' => 'AgentController@agent_detail']);
        //Route::get('/', ['as' => 'subdomain','uses' => 'SubdomainController@UserName']);
       // Route::get('property-agent-detail/{id}/{title}','AgentController@agent_detail');

    }

});


// Socail Sharing Routes
Route::get('twitter/{id}',['as' => 'Rating','uses' => 'SocailshareController@twitter']);
Route::get('facebook/{id}',['as' => 'Rating','uses' => 'SocailshareController@facebook']);
Route::get('gplus/{id}',['as' => 'Rating','uses' => 'SocailshareController@gplus']);
Route::get('pinterest/{id}',['as' => 'Rating','uses' => 'SocailshareController@pinterest']);

//     Contact us front site
Route::post('contact_us','ContactUsController@store');
//     Contact_us Inquire about this property 
Route::post('detail-property/{id}', ['as' => 'Property','uses' => 'ContactuspropertyinfoController@store'  ]);

//Property Agent Detail Routes
//Route::get('property-agent-detail/{id}/{title}','AgentController@agent_detail');
Route::get('agent_list','AgentController@agent_list');
Route::get('city_agent_list/{city}','AgentController@city_agent_list');





Route::group(array('prefix' => 'admin'), function ()
{
    Route::auth();
    Route::get('/', ['as' => 'login','uses' => 'LoginController@index']);
    Route::get('/logout', ['as' => 'logout','uses' => 'LoginController@logout']);
    Route::post('/login', ['as' => 'login','uses' => 'LoginController@login'  ]);

    Route::get('/404', function (){return view('admin.404');});


    Route::group(array('middleware' => 'myAuth'), function ()
    {

       // Route::get('/home', function (){ return view('admin.dashboard');  });
       // Route::get('/dashboard', function (){return view('admin.dashboard');});
	    Route::get('dashboard', ['as' => 'dashboard','uses' => 'DashboardController@index']);
	    Route::get('home', ['as' => 'dashboard','uses' => 'DashboardController@index']);


	    Route::resource('city', 'CityController');
        Route::get('/addcity', function (){return view('admin.addcity');});
        Route::get('/editcity/{id}', ['as' => 'ecitcity','uses' => 'CityController@destroy']);
        Route::post('/updatecity/{id}', ['as' => 'updatecity','uses' => 'CityController@update']);
// add city sub address
          Route::get('/addCitysubadress', 'CitySubAddressController@index');
          Route::post('addCitysubadress', 'CitySubAddressController@store');
          Route::get('/Citysubadress', 'CitySubAddressController@view');
          Route::get('/delete/{id}', 'CitySubAddressController@destroy');
          Route::get('/edit_citysubAddress/{id}', 'CitySubAddressController@show');
          Route::post('/updatesubcity/{id}', ['as' => 'updatesubcity','uses' => 'CitySubAddressController@update']);
          
           Route::post('/ajax/{id}', 'CitySubAddressController@ajax');
          
          Route::get('/googleapi',function(){ return view('admin.googleapi');});
          
        Route::resource('feature', 'FeatureCotroller');
        Route::post('/updatefeature/{id}', ['as' => 'feature','uses' => 'FeatureCotroller@update']);
        Route::get('/featuredestroy/{id}', ['as' => 'feature','uses' => 'FeatureCotroller@destroy']);


        Route::resource('services', 'ServicesController');
        Route::post('/updateservice/{id}', ['as' => 'services','uses' => 'ServicesController@update']);
        Route::get('/servicedestroy/{id}', ['as' => 'services','uses' => 'ServicesController@destroy']);

        Route::resource('add_package', 'PackageController');
        Route::post('/updateprm/{id}', ['as' => 'Package','uses' => 'PackageController@update']);
        Route::get('/pkgdestroy/{id}', ['as' => 'Package','uses' => 'PackageController@destroy']);

        Route::resource('permission', 'PermissionController');


        Route::get('/permdestroy/{id}', ['as' => 'Permission','uses' => 'PermissionController@destroy']);



        Route::resource('packagepermission', 'PackagePermissionController');


        /*
         * Property Route
         * Manage All property Routes
         * */
        Route::get('/property', ['as' => 'Property','uses' => 'PropertyController@property']);
        Route::get('/property_detail/{id}', ['as' => 'Property','uses' => 'PropertyController@property_detail']);
        Route::get('/p_delete/{id}', ['as' => 'Property','uses' => 'PropertyController@delete_property']);
        Route::get('/set_property/{id}', ['as' => 'Property','uses' => 'PropertyController@set_property']);
        Route::get('/unset_property/{id}', ['as' => 'Property','uses' => 'PropertyController@unset_property']);
        Route::get('/edit_property/{id}', ['as' => 'Property','uses' => 'PropertyController@show_edit_property']);
        Route::post('update_property', ['as' => 'Property','uses' => 'PropertyController@update_property']);
        Route::get('active_property', ['as' => 'Property','uses' => 'PropertyController@active_property']);
        Route::get('pending_property', ['as' => 'Property','uses' => 'PropertyController@pending_property']);
        Route::get('expire_property', ['as' => 'Property','uses' => 'PropertyController@expire_property']);
        Route::get('rejected_property', ['as' => 'Property','uses' => 'PropertyController@rejected_property']);
        Route::get('activate_property/{id}', ['as' => 'Property','uses' => 'PropertyController@activate_property']);
        Route::get('deactivate_property/{id}', ['as' => 'Property','uses' => 'PropertyController@deactivate_property']);
//      Order property feature 
        Route::get('add_OrderFeature/{id}', ['as' => 'Order','uses' => 'OrderController@add_feature']);
        Route::post('OrderStore', ['as' => 'Order','uses' => 'OrderController@Orderdata_store']);
        Route::get('thankyou_featureorder/{id}', ['as' => 'Order','uses' => 'OrderController@thankyou_featureorder']);
        Route::get('Orders_List', ['as' => 'Order','uses' => 'OrderController@ViewOrders_List']);
        Route::get('/order_delete/{id}', ['as' => 'Order','uses' => 'OrderController@delete_order']);
        Route::get('/activate_order/{id}', ['as' => 'Order','uses' => 'OrderController@activate_order']);
        Route::get('/deactivate_order/{id}', ['as' => 'Order','uses' => 'OrderController@deactivate_order']);
        Route::get('/edit_order/{id}', ['as' => 'Order','uses' => 'OrderController@edit_order']);
        Route::post('update_order', ['as' => 'Order','uses' => 'OrderController@update_order']);
//      Order Payment list Transfermation or cinfirmation ID property Feature 
        Route::get('add_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'PaymentorderController@add_paymentTID']);
        Route::post('add_paymentTIDStore', ['as' => 'PaymentTID','uses' => 'PaymentorderController@paymentOrderTID_store']);
        Route::post('clickhere_store', ['as' => 'PaymentTID','uses' => 'PaymentorderController@clickhere_store']);
        Route::get('Orders_paymentList', ['as' => 'PaymentTID','uses' => 'PaymentorderController@ViewOrders_paymentList']);
        Route::get('single_paymentList/{id}', ['as' => 'PaymentTID','uses' => 'PaymentorderController@single_paymentList']);
        Route::get('/paymentTID_delete/{id}', ['as' => 'PaymentTID','uses' => 'PaymentorderController@delete_paymentTID']);
        Route::get('/activate_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'PaymentorderController@activate_paymentTID']);
        Route::get('/deactivate_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'PaymentorderController@deactivate_paymentTID']);
        Route::get('/edit_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'PaymentorderController@edit_paymentTID']);
        Route::post('update_paymentTID', ['as' => 'PaymentTID','uses' => 'PaymentorderController@update_paymentTID']);
        
        
//      Payment Method For bank detail
        Route::get('add_paymentMethod', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@add_paymentMethod']);
        Route::post('paymentmethodstore', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@paymentmethod_store']);
        Route::get('paymentMethods', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@View_paymentmethod']);
        Route::get('edit_paymentMethod/{id}', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@edit_paymentmethod']);
        Route::post('update_paymentmethod', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@Update_paymentmethod']);
        Route::get('/paymentMethod_delete/{id}', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@delete_paymentmethod']);
//        set featured price 
        Route::get('set_featuredprice', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@set_featuredprice']);
        Route::post('price_update', ['as' => 'PaymentMethod','uses' => 'PaymentMethodController@price_update']);
        
        //Route::get('adduser', function () {return view('admin.adduser');});
	    Route::get('adduser',array('as' => 'addAgent', 'uses' =>'SignupController@addAgent'));
	    Route::get('addagent',array('as' => 'addagent', 'uses' =>'SignupController@AddAgents'));
	    Route::get('agents',array('as' => 'agents', 'uses' =>'SignupController@agents'));
        Route::post('RegisterAgent', 'SignupController@RegisterAgent');
        Route::post('UpdateAgent', 'SignupController@UpdateAgent');
        Route::get('delete-agent/{id}', 'SignupController@delete_agent')->name('delete_agent');
        Route::get('edit-agent/{id}', 'SignupController@edit_agent')->name('edit_agent');
        
        // agent featured order route 
         Route::get('view-all-agent',array('as' => 'Agency', 'uses' =>'AgencyController@view_agent_all'));
         Route::get('view-featured-agent',array('as' => 'Agency', 'uses' =>'AgencyController@ViewOrders_List'));
         Route::get('add-Orderfeature-Agent/{id}','AgencyController@add_Orderfeature_Agency')->name('add_Orderfeature_Agent');
         Route::post('agency_FeatureOrderStore', ['as' => 'Order','uses' => 'AgencyController@agency_FeatureOrderStore']);
         Route::get('thanku_agencyfeatured/{id}', ['as' => 'Order','uses' => 'AgencyController@thanku_agencyfeatured']);
         Route::get('addfeature-agent/{id}','AgencyController@addfeature_agent')->name('addfeature_agent');
         Route::get('rejectfeature-agent/{id}','AgencyController@rejectfeature_agent')->name('rejectfeature_agent');
         Route::get('/agencyedit_order/{id}', ['as' => 'Order','uses' => 'AgencyController@edit_order']);
         Route::post('agencyupdate_order', ['as' => 'Order','uses' => 'AgencyController@update_order']);
         Route::get('/agencyorder_delete/{id}', ['as' => 'Order','uses' => 'AgencyController@delete_order']);
  //agent feature Order Payment list Transfermation or cinfirmation ID property Feature 
        Route::get('add_agencypaymentTID/{id}', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@add_agencypaymentTID']);
        Route::post('add_agencypaymentTIDStore', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@paymentOrderTID_store']);
        Route::post('agencyclickhere_store', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@clickhere_store']);
        Route::get('agencyOrders_paymentList', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@ViewagencyOrders_paymentList']);
        Route::get('agencysingle_paymentList/{id}', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@single_paymentList']);
        Route::get('/agencypaymentTID_delete/{id}', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@delete_paymentTID']);
//        Route::get('/agencyactivate_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@activate_paymentTID']);
//        Route::get('/agencydeactivate_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@deactivate_paymentTID']);
        Route::get('/agencyedit_paymentTID/{id}', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@edit_paymentTID']);
        Route::post('agencyupdate_paymentTID', ['as' => 'PaymentTID','uses' => 'AgencyPaymentorderController@update_paymentTID']);
        
        
        Route::get('users', 'UserController@users');
        Route::get('view_user', 'UserController@view_user');
        Route::get('view_user_detail', 'UserController@view_user_detail');
        Route::post('edit_profile', 'UserController@Edit_Profile');
        Route::post('edit_user', 'UserController@update_profile');
        Route::get('block_users', 'UserController@block_users');
        Route::get('delete_user', 'UserController@delete_user');
        Route::post('company_user', 'UserController@update_company');
        //status approve and block admin user
        Route::get('mark_user/{action}/{id}', 'UserController@mark_status');

// company slider route
         Route::post('slidersave', 'CompanySliderController@save');
         Route::get('companyslider_delete/{id}', 'CompanySliderController@companyslider_delete');
         
        //Adds route
        Route::get('adds_form', 'AddsController@index');
        Route::post('adds_form', 'AddsController@store');
        Route::get('view_adds', 'AddsController@show');
        Route::get('edit_adds/{id}', 'AddsController@edit_adds');
        Route::post('edit_adds', 'AddsController@update_adds');
        //status approve and block admin user
        Route::get('adds_status/{action}/{id}', 'AddsController@adds_status');
        //delete Adds
        Route::get('delete_adds', 'AddsController@delete_adds');

        //       Admin Site blog Post route
        Route::get('add_blogPost', 'BlogController@index');
        Route::post('add_blogPost', 'BlogController@store');
        Route::get('view_blogPost', 'BlogController@show');
        Route::get('edit_blogPost', 'BlogController@edit');
        Route::post('edit_blogPost', 'BlogController@update');
        Route::get('destroy_blogPost', 'BlogController@destroy_blogPost');


        //       About us
        Route::get('edit_aboutus', 'AboutUsController@edit_aboutus');
        Route::post('edit_aboutus', 'AboutUsController@update');
        Route::get('edit_contact', 'AboutUsController@edit_contactus_text');
        Route::post('edit_contact', 'AboutUsController@update_contactus_text');
        Route::get('edit_privacy_policy', 'AboutUsController@edit_privacy_policy');
        Route::post('edit_privacy_policy', 'AboutUsController@update_privacy_policy');
        Route::get('edit_terms_condition', 'AboutUsController@edit_terms_condition');
        Route::post('edit_terms_condition', 'AboutUsController@update_terms_condition');

        //   Contact us View admin site
        Route::get('view_contactus','ContactUsController@index');
        Route::get('contactus_reply', 'ContactUsController@contactus_reply');
        Route::get('contactus_sendemail', 'ContactUsController@contactus_sendemail');
        Route::get('destroy', 'ContactUsController@destroy');
//     contact us status active inactive  admin site
        Route::get('contactus_status/{action}/{id}', 'ContactUsController@contactus_status');

//        Social media
        Route::get('edit_socialAccount', 'SocialAccountController@index');
        Route::post('update', 'SocialAccountController@update');
//        Site Logo
        Route::get('siteLogo', 'LogoController@index');
        Route::post('update_logo', 'LogoController@update');
//        banner Offer
        Route::get('bannerOffer', 'OfferController@index');
        Route::post('store', 'OfferController@store');
        Route::get('view_banneroffer', 'OfferController@view_banneroffer');
        Route::get('edit_offer/{id}', 'OfferController@edit_offer');
        Route::post('offer_update', 'OfferController@update');
        Route::get('delete_offer/{id}', 'OfferController@delete_offer');
        
//   Inquire About Property information View admin site
        Route::get('inquire_propertyinfo','ContactuspropertyinfoController@index');
        Route::get('propertyinfo','ContactuspropertyinfoController@single_user');
        Route::get('contactus_reply', 'ContactuspropertyinfoController@contactus_reply');
        Route::get('/destroy/{id}', ['as' => 'Property','uses' => 'ContactuspropertyinfoController@destroy']);

    });

});


Route::post('Search-Result' , ['as' => 'Search' , 'uses' => 'SearchController@SearchFormData']);
Route::post('searchajax'    , ['as' => 'Search' , 'uses' => 'SearchController@searchajax']);
//Route::post('autocomplete',  ['as' => 'property','uses' => 'PropertiesController@Ajaxproperty']);
Route::post('searchaddress', 'SearchController@searchaddress');




Route::post('Rating', ['as' => 'Rating','uses' => 'RatingController@store']);

Route::get('/logout', ['as' => 'logout','uses' => 'LoginController@fronlogout']);

Route::get('sale-properties', ['as' => 'property','uses' => 'PropertiesController@sale_property']);
Route::get('sale-properties/{subtype}', ['as' => 'property','uses' => 'PropertiesController@sale_property']);
Route::get('rent-properties', ['as' => 'property','uses' => 'PropertiesController@rent_property']);
Route::get('rent-properties/{subtype}', ['as' => 'property','uses' => 'PropertiesController@rent_property']);
Route::get('projects-properties', ['as' => 'property','uses' => 'PropertiesController@projects_property']);
Route::get('projects-properties/{subtype}', ['as' => 'property','uses' => 'PropertiesController@projects_property']);

Route::get('all-properties', ['as' => 'property','uses' => 'PropertiesController@active_property']);
// City property rout 
Route::get('all', ['as' => 'property','uses' => 'PropertiesController@allcity_property']);
Route::get('all/{city}', ['as' => 'property','uses' => 'PropertiesController@allcity_property']);
//city listing
Route::get('citylist','CityController@citylisting');
Route::get('citysubaddress/{name}','CityController@citysubaddress');
Route::get('/addresscityname/{addressname}','CityController@addresscityname');
Route::get('/subaddresscityname/{addressname}','AgentController@subaddresscityname');
// city waise sale and rent routes
Route::get('city-sale-properties/{city}', ['as' => 'property','uses' => 'PropertiesController@citysingle_sale_property']);
Route::get('city-sale-properties/{subtype}/{city}', ['as' => 'property','uses' => 'PropertiesController@city_sale_property']);
Route::get('city-rent-properties/{city}', ['as' => 'property','uses' => 'PropertiesController@citysingle_rent_property']);
Route::get('city-rent-properties/{subtype}/{city}', ['as' => 'property','uses' => 'PropertiesController@city_rent_property']);

Route::get('/add_property', ['as' => 'Property','uses' => 'PropertyController@index'])->name('add_property');
Route::post('/add_property', ['as' => 'Property','uses' => 'PropertyController@store'  ]);
Route::get('/property-detail/{id}/{title}', ['as' => 'Property','uses' => 'PropertyController@singleproperty'  ]);
Route::get('detail-property/{id}', ['as' => 'Property','uses' => 'PropertyController@singleproperty'  ]);



Route::get('/','IndexController@index');
Route::get('index','IndexController@index');
Route::get('index2','IndexController@index2');
Route::post('/rating', ['as' => 'rating','uses' => 'RatingController@store']);



//       About us
Route::get('edit_aboutus', 'AboutUsController@edit_aboutus');
Route::post('edit_aboutus', 'AboutUsController@update');
Route::get('edit_privacy_policy', 'AboutUsController@edit_privacy_policy');
Route::post('edit_privacy_policy', 'AboutUsController@update_privacy_policy');
Route::get('edit_terms_condition', 'AboutUsController@edit_terms_condition');
Route::post('edit_terms_condition', 'AboutUsController@update_terms_condition');



//comment front routes hain wahn rakhna
Route::get('blog','BlogController@blog');
Route::get('blog_detail','PagesController@blog_detail');
Route::post('comment_post','BlogController@comment_post');
Route::post('reply_post','BlogController@reply_post');




//property dateail tabs
Route::get('property_detail_tabs','PagesController@property_detail_tabs');
Route::get('/about_us','PagesController@about_us');
Route::get('add_new_property','PagesController@add_new_property');
Route::get('agency_list','PagesController@agency_list');
Route::get('blog_detail','PagesController@blog_detail');
Route::get('blog_masonry','PagesController@blog_masonry');
Route::get('company_profile','PagesController@company_profile');
Route::get('compare_properties','PagesController@compare_properties');
Route::get('contact_us','PagesController@contact_us');
Route::get('terms_and_conditions','PagesController@terms_and_conditions');
Route::get('privacy','PagesController@privacy');


Route::get('Signup',array('as' => 'Signup', 'uses' =>'SignupController@Signup'));
Route::post('SignupForm', array('as' => 'SignupForm', 'uses' =>'SignupController@SignupForm'));
Route::get('/emailVerification/{token?}', array('as' =>'emailVerification', 'uses' => 'SignupController@emailVerification'));
Route::get('Signout',array('as' => 'Signout', 'uses' =>'SignupController@Signout'));

Auth::routes();

Route::get('/home', 'HomeController@index');

 Route::get('/datasend/ajax', 'CitySubAddressController@ajaxdata')->name('get-city-address');

          Route::get('ajax',function(){ return view('ajax');});