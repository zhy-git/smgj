<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/4
 * Time: 9:36
 */

namespace app\admin\controller;


use app\admin\model\Bet;
use app\admin\model\Odds;
use think\Cache;
use think\Request;
use think\Db;

class Car extends Admin
{
    /*龙虎
     * */
    public function index(){
        $odds = Db::name('odds')->where('cate',2)->where('type',1)->select();
        $bet = Db::name('bet')->where('cate',2)->where('type',1)->select();
        return view('index',[
            'odds'=>$odds,
            'bet'=>$bet
        ]);
    }
    /*定位
     * */
    public function dw(){
        $odds = Db::name('odds')->where('cate',2)->where('type',2)->select();
        $bet = Db::name('bet')->where('cate',2)->where('type',2)->select();
        return view('index',[
            'odds'=>$odds,
            'bet'=>$bet
        ]);
    }
    /*单码
     * */
    public function dm(){
        $odds = Db::name('odds')->where('cate',2)->where('type',3)->select();
        $bet = Db::name('bet')->where('cate',2)->where('type',3)->select();
        return view('index',[
            'odds'=>$odds,
            'bet'=>$bet
        ]);
    }
    /*花样
     * */
    public function hy(){
        $odds = Db::name('odds')->where('cate',2)->where('type',4)->select();
        $bet = Db::name('bet')->where('cate',2)->where('type',4)->select();
        return view('index',[
            'odds'=>$odds,
            'bet'=>$bet
        ]);
    }
    /*
     * 大小单双*/
    public function ds(){
        $odds = Db::name('odds')->where('cate',2)->where('type',5)->select();
        $bet = Db::name('bet')->where('cate',2)->where('type',5)->select();
        return view('index',[
            'odds'=>$odds,
            'bet'=>$bet
        ]);
    }

    public function edit(Request $request){
        $data = $request->post();
        $odds=[];
        $bet=[];
        if($data){
            foreach ($data as $k=>$v){
                if($str = strstr($k,'_')){
                    $str = substr($str,1);
                    $bet[$str]['id'] = $str;
                    if(strstr($k,'from')){
                        $bet[$str]['from'] = $v;
                    }elseif (strstr($k,'to')){
                        $bet[$str]['to'] = $v;
                    }
                }else{
                    $odds[$k]['id'] = $k;
                    $odds[$k]['rate'] = $v;
                }
            }
        }
        $odd = new Odds();
        $odd->saveAll($odds);
        $bb = new Bet();
        $bb->saveAll($bet);
        Cache::clear('odds');
        Cache::clear('bet');
        $this->success('保持成功');
    }

}