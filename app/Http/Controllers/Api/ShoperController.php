<?php


/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/8/18
 * Time: 15:13
 */
namespace App\Http\Controllers\Api;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Api\ShopModel;
use App\Http\Common\ReturnApi;
use Illuminate\Http\Request;

class ShoperController extends Controller
{
    //返回值通用函数

    //根据店铺id得到店铺信息
    public function get(Request $request,$id)
    {
        //$shop = DB::table('shop_info')->select('shop_name','shop_state')->where('shop_id',$id)->get();
        //echo '<pre>';
        //print_r($shop);
        //foreach ($shop as $k => $v){
        //    echo $v;
        //}
        $shopInfo = ShopModel::where('shop_id',$id)
            ->select('shop_id','shop_name')
            ->first();
        $data = array(
            "shop_name" =>  $shopInfo['shop_name'],
        );
        if($shopInfo){
            $resData = ReturnApi::getResult($id=2,$data);
            return response()->json($resData);
        }
        $resData =  ReturnApi::getResult();
        return response()->json($resData);
    }
    //更新店铺信息
    public function update(Request $request,$id){
        $db_arrays = array(
            "shop_name" => "测1122试",
        );
        $shopUpdate = ShopModel::where("shop_id",$id)->update($db_arrays);
        $resData = ReturnApi::updateResult();
        if($shopUpdate) {
            $resData = ReturnApi::updateResult($id=2);
            return response()->json($resData);
        }
        return response()->json($resData);

    }
    //删除
    public function delete(Request $request,$id){
        $shopUpdate = ShopModel::where("shop_id",$id)->delete();
        $resData = ReturnApi::deleteResult();
        if($shopUpdate) {
            $resData = ReturnApi::deleteResult($id=2);
            return response()->json($resData);
        }
        return response()->json($resData);

    }
    //根据名字得到店铺
    public function exist($name){
        $db_arrays = array(
            "shop_name" => "刘少的",
        );
        $shopexist = ShopModel::where("shop_name",$name)->select("shop_id")->first();
        $resData = ReturnApi::existResult();
        if($shopexist) {
            return 1;
        }
        return 0;

    }
    //添加
    public function add(Request $request){
        $db_arrays = array(
            "shop_name" => "刘少的",
        );
        if($this->exist($db_arrays["shop_name"])){
            $resData = ReturnApi::existResult();
            return response()->json($resData);
        }
        $shopadd = ShopModel::create($db_arrays);
        $resData = ReturnApi::addResult();
        if($shopadd) {
            $resData = ReturnApi::addResult($id=2);
            return response()->json($resData);
        }
        return response()->json($resData);

    }



}