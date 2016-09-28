<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/8/18
 * Time: 15:13
 */
namespace App\Http\Controllers\Search;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Common\Sphinxclient;
use App\Http\Common\DataApi;

class SearchController extends Controller
{
    //sphinx搜索
    public function index(){
        $k='选货节M01 -2016新品百搭韩版皮衣马夹系带无袖休闲外套马甲';
        //urlencode($k);
        echo $k;
        die;
        //搜索系统调用
        $sphinx = new Sphinxclient();
        $sphinx->SetServer( Config::get('app.sphinx_Data.SPHINX_HOST'), Config::get('app.sphinx_Data.SPHINX_PORT') );
        $sphinx->SetArrayResult ( true );
        $sphinx->SetLimits(0,  Config::get('app.sphinx_Data.SPHINX_MAX_NUMS'),  Config::get('app.sphinx_Data.SPHINX_MAX_NUMS'));
        $index = Config::get('app.sphinx_Data.SPHINX_NAME2') ;
        $mode = 2;
        $sphinx->SetMatchMode($mode);

        $sphinx->AddQuery($k, $index);
        $result = $sphinx->RunQueries ();
        echo '<pre>'  ;
        print_r($result);
        die;

       //分词系统的调用
        $scws = new DataApi();
        $postData = 'data='.$k.'&respond=json&charset=utf8&ignore=yes&duality=no&traditional=no&multi=0';
        $words_arrays = array();
        $words_array  = $scws->postFormData( Config::get('app.sphinx_Data.SCWS_API'),$postData);
        $words_array = json_decode($words_array, true);
        //数据搜索
        if($words_array['status']=='ok'){
            foreach($words_array['words'] as $k => $v){
                $sphinx->AddQuery($v['word'], $index);
            }
        }
        $result = $sphinx->RunQueries ();
        //处理结果
        $display_arr = array();
        $match_nums = count($result);
        foreach($result as $k => $v){
            if($v['total']>0){
                foreach( $v['matches'] as $key=>$value) {
                    $display_arr[$k][] = $value['id'];
                }
            }
        }
        //小于4或4个关键字全部匹配
        if($match_nums<=4){
            if (!empty($display_arr)){
                $arr2 = $display_arr['0'];
                foreach ($display_arr as $value3){
                    $arr2 = array_intersect($arr2,$value3);
                }
            }else{
                $arr2 = array();
            }
        }else{
            $match_array = array();
            $arr2 = array();
            if (!empty($display_arr)){
                foreach ($display_arr as $value3){
                    foreach($value3 as $value4){
                        array_push($match_array,$value4);
                    }
                }
                //得到出现大于等于4次的good_id
                foreach(array_count_values($match_array) as $m => $n){
                    if($n>3){
                        array_push($arr2,$m);
                    };
                }
            }else{
                $arr2 = array();
            }
        }
        if (empty($arr2)){
            array_push($arr2,0);
        }
        echo '<pre>'  ;
        print_r($arr2);
        die;
        //查询商品
        //$where['sg_goods_id'] = array('in',$arr2);
        echo '<pre>'  ;
        print_r($result);

    }
}