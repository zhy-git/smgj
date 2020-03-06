<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/16
 * Time: 10:03
 */

namespace app\admin\controller;


use app\admin\model\Detail;
use app\admin\model\Members;
use think\Db;
use think\Request;

class Record extends Admin
{
    public function index(Request $request){
        $from= $request->param('from');
        $to= $request->param('to');
        $key= $request->param('key');
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
            $ww['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($key){
            $member = Members::where(['nickname'=>['like','%'.$key.'%']])->column('id');
            if($member){
                $w['uid'] =['in',$member];
            }else{
                $w['uid'] ='';
            }
        }
        $w['exp'] = [['=',31],['=',32],['=',33],'or'];
        $detail = Detail::where('type',2)
            ->field('uid,count(*) as num,sum(money) as money')
            ->where($w)
            ->group('uid')
            ->paginate(20);
       //总投注人数
        $ww['exp'] = [['=',31],['=',32],['=',33],'or'];
        $total = Detail::where($ww)->group('uid')->count();
        //总投注次数
        $total_count = Detail::where($ww)->count();
        $total_money = Detail::where($ww)->sum('money');
        $zj_money = Detail::where('exp',['=',41],['=',42],['=',43],'or')->sum('money');
        $kuiying = $total_money- $zj_money;
        $hui_money = Detail::where('exp',['=',51],['=',52],'or')->sum('money');
        return view('',[
            'detail'=>$detail,
            'page'=>$detail->render(),
            'total'=>$total,
            'total_count'=>$total_count,
            'total_money'=>$total_money,
            'kuiying'=>$kuiying,
            'hui_money'=>$hui_money,
        ]);
    }

    public function touzhu(Request $request){
        $from  = $request->param('from');
        $to    = $request->param('to');
        $id    = $request->param('id');
        $cate  = $request->param('cate');
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['s.create_at'] = [['>=',$from],['<=',$to]];
        }
        if($cate){
            $w['s.cate'] = $cate;
        }
        $list = Db::name('single')
            ->alias('s')
            ->field('s.*,c.name,b.title')
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->where('s.uid',$id)
            ->where($w)
            ->order('s.id desc')
            ->paginate(20);


        $cates = Db::name('cate')->select();

        return view('',[
            'cates'=>$cates,
            'list' =>$list,
            'page' =>$list->render(),
            'id'   =>$id,
            'cate' =>$cate,
        ]);
    }

    public function mingxi(Request $request){
        $from= $request->param('from');
        $to= $request->param('to');
        $exp= $request->param('exp');
        $id= $request->param('id');
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($exp){
            $w['exp'] = $exp;
        }
        $detail = Detail::where('uid',$id)->where($w)->paginate(20);
        return view('',[
            'detail'=>$detail,
            'page'=>$detail->render(),
            'id' =>$id,
        ]);
    }
}