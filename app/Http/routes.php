<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//=====接口首页======
Route::get('/', function () {return view('welcome');});

Route::post('test', function () {return "test";});

/**
 * 页面信息模块
 */


/**
 * 用户模块
 */
Route::post('user/ck/isReg', ['as'=> 'user.ckIsReg', 'uses' => 'User\UserController@ckIsReg']);                         //=====是否注册======
Route::post('user/ck/imgCode', ['as'=> 'user.ckImgCode', 'uses' => 'User\UserController@ckImgCode']);                   //=====验证图片验证码======
Route::post('user/login', ['as'=> 'user.login', 'uses' => 'User\UserController@userLogin']);                            //=====用户登录======
Route::post('user/register', ['as'=> 'user.register', 'uses' => 'User\UserController@userRegister']);                   //=====用户注册======
Route::get('user/info', ['as'=> 'user.info', 'middleware' => ['isLogin'], 'uses' => 'User\UserController@getUserInfo']);//=====用户信息======
Route::delete('user/logout', ['as'=> 'user.logout', 'uses' => 'User\UserController@userLogout']);                       //=====用户退出======

/**
 * 商家模块
 */
Route::get('shop/info', ['as'=> 'shop.info', 'middleware' => ['isLogin','isShop'], 'uses' => 'Shop\ShopInfoController@getShopInfo']);//获取商家信息
Route::post('shop/save', ['as'=> 'shop.save', 'middleware' => ['isLogin','isShop'], 'uses' => 'Shop\ShopInfoController@saveShopInfo']);//保存商家信息
//Route::put('shop/edit', ['as'=> 'shop.info', 'middleware' => ['isLogin','isShop'], 'uses' => 'Shop\ShopInfoController@editShopInfo']);

/**
 * 搜索模块
 */
//Route::get('/search', ['middleware' => ['access'],'uses'  =>  'Search\SearchController@index']);
Route::get('/search', 'Search\SearchController@index');


/**
 * api模块
 */
Route::post('/sendmail', 'Api\SendMailController@send');
//店铺操作
Route::get('/shoper/{id}', 'Api\ShoperController@get');
Route::post('/shoper/update/{id}', 'Api\ShoperController@update');
Route::post('/shoper/add', 'Api\ShoperController@add');
Route::post('/shoper/delete/{id}', 'Api\ShoperController@delete');
//测试
Route::get('/testphp', 'Api\TestphpController@index');
Route::get('/testphp/{str}', 'Api\TestphpController@regular');
//算法
Route::get('/arithmetic/{id}', 'Api\ArithmeticController@index');
//redis

Route::get('/vote_get/{str}', 'Api\VoteController@get');


/**
 * 买家模块
 */
Route::get('buyer/info', ['as'=> 'buyer.info', 'middleware' => ['isLogin','isBuyer'], 'uses' => 'Buyer\BuyerController@getBuyerInfo']);//获取买家信息
Route::post('buyer/save', ['as'=> 'buyer.save', 'middleware' => ['isLogin','isBuyer'], 'uses' => 'Buyer\BuyerController@saveBuyerInfo']);//保存买家信息
//Route::put('buyer/edit', ['as'=> 'buyer.edit', 'middleware' => ['isLogin','isBuyer'], 'uses' => 'Buyer\BuyerController@editBuyerInfo']);//编辑买家信息

/**
 * 商品模块
 */
Route::get('goods/info/{goodsId}', ['as'=> 'goods.info', 'middleware' => ['isLogin','isShop'], 'uses' => 'Goods\GoodsController@getGoodsInfoById']);//通过商品id获取商品信息
Route::post('goods/add', ['as'=> 'goods.add', 'middleware' => ['isLogin','isShop'], 'uses' => 'Goods\GoodsController@addGoods']);//通过商品id获取商品信息
Route::post('goods/edit', ['as'=> 'goods.edit', 'middleware' => ['isLogin','isShop'], 'uses' => 'Goods\GoodsController@editGoods']);//通过商品id获取商品信息

/**
 * 物流模块
 */


/**
 * 消息模块
 */
Route::post('message/get/msgcode', ['as'=> 'message.get.msgcode', 'uses' => 'Message\MessageController@getMsgCode']);//获取短信验证码


/**
 * 品牌模块
 */
Route::get('brand/list/{state}', ['as'=> 'brand.list', 'middleware' => ['isLogin','isShop'], 'uses' => 'Brand\BrandController@getBrandList']);  //获取品牌列表
Route::post('brand/add', ['as'=> 'brand.add', 'middleware' => ['isLogin','isShop'], 'uses' => 'Brand\BrandController@addBrand']);                 //品牌增加
Route::post('brand/edit', ['as'=> 'brand.edit', 'middleware' => ['isLogin','isShop'], 'uses' => 'Brand\BrandController@editBrand']);              //品牌编辑

/**
 * 文件模块
 */
Route::get('files/image/imgcode', ['as'=> 'files.image.code', 'uses' => 'Files\FilesController@getImgCode']);//获取图片验证码
Route::post('files/image/upload', ['as'=> 'files.image.upload', 'middleware' => ['isLogin'], 'uses' => 'Files\FilesController@uploadImage']);//图片上传
Route::post('files/image/qr/code', ['as'=> 'qr.code', 'middleware' => ['isLogin'], 'uses' => 'Files\FilesController@getQrCodeUrl']);//生成二维码
