<?php
namespace app\admin\controller;

use app\admin\model\Odds;
use app\admin\model\Water;
use think\Cache;
use think\Config;
use think\Request;
use think\Db;

class Lottery extends Admin
{
    /**
     * 彩种管理
     */
    public function index(){
        $data = Db::name('cate')->select();
        return view('index',[
            'data'=>$data,
        ]);

    }
    /**
     * 玩法界面
     */
    public function eight_index(Request $request){
        $cate     = $request->param('cate');
        $w['cate'] = $cate;
//        $data = Db::name('hall')
//            ->where($w)
//            ->select();
       // foreach ($data as $k=>$v){
            $data =  Db::name('bet')
                ->where($w)
                ->where('is_use',1)
                ->order('type')
                ->select();
        //}
        $cate_name = Db::name('cate')->where(array('id'=>$cate))->value('name');

        return view('eight_index',[
            'data'=>$data,
            'cate_name'=>$cate_name,
        ]);
    }
    /**
     * 赔率设置
     */
    public function eight_pei(Request $request){
        $cate     = $request->param('cate');
        $type    = $request->param('type');
        $w['cate'] = $cate;
        $w['type'] =$type;
        $data = Db::name('odds')
            ->where($w)
            ->order('sort')
            ->select();
        $cate_name = Db::name('cate')->where(array('id'=>$cate))->value('name');
        $type_name = Db::name('bet')->where(array('cate'=>$cate))->value('title');
        return view('eight_pei',[
            'data'=>$data,
            'cate_name'=>$cate_name,
            'type_name'=>$type_name,
            'cate'=>$cate,
        ]);
    }
    /**
     * 编辑赔率
     */
    public function edit_pei(Request $request){
        $data = $request->post();
        $odds=[];
        if($data){
            foreach ($data['id'] as $k=>$v){
                $odds[$k]['id']   = $v;
                $odds[$k]['rate'] = $data['rate'][$k];
                $odds[$k]['rate_two'] = $data['rate_two'][$k];
                $odds[$k]['rate_three'] = $data['rate_three'][$k];
//                $odds[$k]['bet_max'] = $data['bet_max'][$k];
            }
        }
        $odd = new Odds();
        $re = $odd->saveAll($odds);
        if($re!==false){
            $this->success_new('修改成功');
        }else{
            $this->success_new('修改失败');
        }

    }

    /**
     * 大厅界面
     */
    public function hall(Request $request){
        $cate     = $request->param('cate');
        if($cate) {
            $w['h.cate'] = $cate;
        }
        $data = Db::name('hall')
            ->alias('h')
            ->field('h.*,c.name as cate_name')
            ->join('dl_cate c','h.cate=c.id')
            ->where($w)
            ->select();
        return view('hall',[
            'data'=>$data,
        ]);


    }
    /**
     * 编辑彩种资料
     */
    public function show(Request $request){
            $cate     = $request->param('id');
            $data     = Db::name('cate')->where(array('id'=>$cate))->find();
            return view('edit',[
                'data'=>$data,
            ]);

    }

    /**
     * 编辑彩种资料
     */
    public function edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('cate')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功');
            }else{
                $this->error_new('修改失败');
            }
        }else{
            $cate     = $request->param('id');
            $data     = Db::name('cate')->where(array('id'=>$cate))->find();
            return view('edit',[
                'data'=>$data,
            ]);
        }
    }
 
    /**
     * 游戏规则
     */
    public function play_rule(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('play_rule')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功');
            }else{
                $this->error_new('修改失败');
            }
        }else{
            $cate     = $request->param('cate');
            $data     = Db::name('play_rule')->where(array('cate'=>$cate))->find();
            $cate_name = Db::name('cate')->where(array('id'=>$cate))->value('name');
            return view('play_rule',[
                'data'=>$data,
                'cate_name'=>$cate_name,

            ]);
        }
    }
    /**
     * 编辑大厅
     */
    public function hall_edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('hall')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功');
            }else{
                $this->error_new('修改失败');
            }
        }else{
            $cate     = $request->param('id');
            $data     = Db::name('hall')->where(array('id'=>$cate))->find();
            return view('hall_edit',[
                'data'=>$data,
            ]);
        }
    }

    /**
     * 编辑大厅
     */
    public function hall_show(Request $request){
        $cate     = $request->param('id');
        $data     = Db::name('hall')->where(array('id'=>$cate))->find();
        return view('hall_edit',[
            'data'=>$data,
        ]);
    }

    /**
     * 编辑回水、流水
     */
    public function water_edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            foreach ($data as $k=>$v) {
                if ($str = strstr($k, '_')) {
                    $str = substr($str, 1);
                    $bet[$str]['id'] = $str;
                    if (strstr($k, 'from')) {
                        $bet[$str]['from'] = $v;
                    } elseif (strstr($k, 'to')) {
                        $bet[$str]['to'] = $v;
                    } elseif (strstr($k, 'back')) {
                        $bet[$str]['back_water'] = $v;
                    } elseif (strstr($k, 'flow')) {
                        $bet[$str]['flow_water'] = $v;
                    }
                }
            }

            $Water = new Water();
            $result=$Water->saveall($bet);
            if ($result) {
                $this->success_new('修改成功');
            }else{
                $this->error_new('修改失败');
            }
        }else{
            $cate     = $request->param('cate');
            $hall     = $request->param('hall');
            $w['cate'] = $cate;
            $w['hall'] = $hall;
            $data      = Db::name('water')->where($w)->select();
            $cate_name = Db::name('cate')->where(array('id'=>$cate))->value('name');
            $hall_name = Db::name('hall')->where(array('cate'=>$cate,'hall'=>$hall))->value('name');
            return view('water_edit',[
                'data'=>$data,
                'cate_name'=>$cate_name,
                'hall_name'=>$hall_name,
            ]);
        }
    }

    /**
     * 显示回水、流水
     */
    public function water_show(Request $request){
            $cate     = $request->param('cate');
            $hall     = $request->param('hall');
            $w['cate'] = $cate;
            $w['hall'] = $hall;
            $data      = Db::name('water')->where($w)->select();
            $cate_name = Db::name('cate')->where(array('id'=>$cate))->value('name');
            $hall_name = Db::name('hall')->where(array('cate'=>$cate,'hall'=>$hall))->value('name');
            return view('water_edit',[
                'data'=>$data,
                'cate_name'=>$cate_name,
                'hall_name'=>$hall_name,
            ]);
    }


    /**
     * 历史记录
     */
    public function history(Request $request){
        $cate      = $request->param('cate');
        $from      = $request->param('from');
        $to        = $request->param('to');
        $w = [];
        if($from && $to){
            $w['create_time'] = [['>=',$from],['<=',$to]];
        }
        switch ($cate){
            case 1:
                $table_name = "at_eight";
                break;
            case 2:
                $table_name = "at_canada";
                break;
            case 3:
                $table_name = "at_car";
                break;
            case 4:
                $table_name = "at_airship";
                break;
            case 5:
                $table_name = "at_ssc";
                break;
            case 6:
                $table_name = "at_tjssc";
                break;
            case 7:
                $table_name = "at_gd10";
                break;
            case 8:
                $table_name = "at_cq10";
                break;
            case 9:
                $table_name = "at_fast";
                break;
            case 10:
                $table_name = "at_gd11";
                break;
            case 11:
                $table_name = "at_hk";
                break;

        }
        $list = Db::name($table_name)->where($w)->order('id desc')->paginate(20);
        if($cate==1 || $cate==2){
            $data = $list->all();
            foreach ($data as $k=>$v){
                $number_arr_s = explode(',',$v['number']);
                $number_arr   = getEightNum($number_arr_s);
                $v['number']  = implode(',',$number_arr);
                $list[$k]     = $v;
            }
        }
        $cate_name = Db::name('cate')->where(array('id'=>$cate))->value('name');
        return view('',[
            'list'=>$list,
            'page'=>$list->render(),
            'cate'=>$cate,
            'cate_name'=>$cate_name
        ]);
    }


    /**
     * 手动开奖界面
     */
    public function open(){
        $cates = Db::name('cate')
            ->field('id,name')
            ->select();
        return view('',[
            'cates'=>$cates,
        ]);
    }

    /**
     * 添加手动开奖界面 未开奖数据
     */
    public function open_result(Request $request){
        $cate = $request->param('cate');
        $stage = $request->param('stage');
        $from   = $request->param('from');
        $to     = $request->param('to');
        $w = [];
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['end_time'] = [['>=',$from],['<=',$to]];
        }
        if($stage){
            $w['stage']=$stage;
        }
        if($cate){
            $name = $this->choose_table($cate);
        }else{
            $cate = 1;
            $name = 'car';
        }
        if(empty($w['end_time'])){
            $w['end_time']=['<=',(time()-60*20)];
        }
        $cates = Db::name('cate')
            ->field('id,name')
            ->select();
        $list = Db::name($name.'_stage')->where('number','')->where($w)->order('stage desc')->limit(200)->select();
        return view('',[
            'cates'=>$cates,
            'list'=>$list,
            'cate'=>$cate,
        ]);
    }
    /**
     * 后台手动撤单
     */
    public function withdrawal(Request $request){
        $cate = $request->param('cate');
        $stage = $request->param('stage');
        $id = $request->param('id');
        if(empty($cate) || empty($stage) || empty($id)){
            return json(array('code'=>10003,'msg'=>'系统故障，缺少参数'));
        }
        $table_name=$this->choose_table($cate);
        $this_number = Db::name($table_name.'_stage')->where('stage',$stage)->where('id',$id)->find();
        $typeName = Db::name('bet')->cache('bet_list',60)->select();
        foreach ($typeName as $k=>$v){
            $typeNameArr[$v['cate']][$v['type']] = $v['title'];
        }
        if($this_number){
            $single_list = Db::name('single')->where('cate',$cate)->where('stage',$stage)->select();
            $count = Db::name('single')->where('cate',$cate)->where('stage',$stage)->count();
            if($single_list){
                Db::startTrans();
                    try{
                        foreach ($single_list as $k => $v) {        
                            if($k==($count-1)){
                                Db::name($table_name.'_stage')->where('stage',$stage)->where('id',$id)->setField('number','流局');
                            }                 
                            Db::name('single')->where('id',$v['id'])->setField('is_del',1);
                            $updateData['money'] = array('exp', 'money+'.$v['money']);
                            $updateData['unpaid_money'] = array('exp', 'unpaid_money-'.$v['money']);
                            Db::name('member')->where('id',$v['uid'])->update($updateData);
                            $balance = Db::name('member')->where('id',$v['uid'])->value('money');
                            $explain = '撤单'.$v['stage'].'期 '.$typeNameArr[1][$v['type']].'：'.$v['notes'].'注 '.$v['multiple'].'倍';
                            addDetail($v['uid'],2,$v['money'],$balance,3,1,$explain,1,$v['id']);                     
                        } 
                        // 提交事务
                        Db::commit();
                        return json(array('code'=>0,'msg'=>'撤单成功'));
                    }catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                        return json(array('code'=>10000,'msg'=>'系统故障'));
                    }
            }else{
                Db::name($table_name.'_stage')->where('stage',$stage)->where('id',$id)->setField('number','流局');
                return json(array('code'=>0,'msg'=>'本期无人投注'));
            }
            
        }else{
            return json(array('code'=>0,'msg'=>'此已开奖'));
        } 
    }
    //香港六合彩添加期数
    public function lhc_stage_add(Request $request){
        if($request->isPost()){
            try{
                $posts=$request->post();
                if(empty($posts['end_time']) || empty($posts['stage'])){
                    return json(['code'=>0,'msg'=>'缺少参数']);
                }
                $insertData['stage']=$posts['stage'];
                $insertData['start_time']=$posts['start_time']?strtotime($posts['start_time']):time();
                $insertData['end_time']=strtotime($posts['end_time']);
                $insertData['end_bet_time'] = strtotime($posts['end_time'])-300;
                $re = Db::name('xglhc_stage')->insert($insertData);
                if($re){
                    return json(['code'=>1,'msg'=>'添加成功']);
                }else{
                    return json(['code'=>0,'msg'=>'添加失败']);
                }
            }catch(\Exception $e){
                return json(['code'=>0,'msg'=>$e->getMessage()]);
            }
        }
        $from = strtotime(date('Y-m-d 21:40:00',strtotime('-10 day')));
        $to = strtotime(date('Y-m-d 21:40:00',strtotime('+3 day')));
        $where['end_time'] =  [['>=',$from],['<=',$to]];
        $data = Db::name('xglhc_stage')->where($where)->order('stage desc')->select();
        return view('',[
            'list'=>$data,
        ]); 
    }
    public function lhc_stage_del(Request $request){
        $id = $request->param('id');
        $result = Db::name('xglhc_stage')
            ->where(array('id'=>$id))
            ->delete();
        if ($result) {
            $this->success_new('删除成功',url('Admin/Lottery/lhc_stage_add'));
        }else{
            $this->error_new('删除失败');
        }
    }
    public function lhc_stage_open(Request $request){
        if($request->isPost()){
            $stage = $request->param('stage');
            $number = $request->param('number');
            $end_time = $request->param('end_time');
            $table_name = 'xglhc';
            if(empty($number)){
                return json(array('code'=>10000,'msg'=>'请填写开奖结果'));
            }
            $w['stage'] = $stage;
            $this_number = Db::name($table_name.'_stage')->where($w)->find();
            if($this_number){
                if($this_number['number']){
                    return json(array('code'=>0,'msg'=>'已开奖，无需操作'));
                }else{
                    Db::startTrans();
                    try{
                        $data['stage']=$stage;
                        $data['number'] = $number;
                        $data['dateline'] = date('Y-m-d H:i:s',$end_time);
                        $data['create_time'] = date('Y-m-d H:i:s',time());
                        $result = Db::name('at_'.$table_name)->insert($data);
                        $re = Db::name($table_name.'_stage')->where('stage',$stage)->setField('number',$number);
                        $newNum[$data['stage']]['number'] = $data['number'];
                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
                        Cache::set('number_' . $table_name, $newNum);
                        Db::commit();
                        return json(array('code'=>0,'msg'=>'开奖成功！可能会有5分钟延迟'));
                    }catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                        return json(array('code'=>10000,'msg'=>'系统故障'));
                    }
                }
            }else{
                return json(array('code'=>10005,'msg'=>'系统错误！'));
            }
        }else{
            return json(array('code'=>10003,'msg'=>'无此权限！'));
        }
    }
   
    /**
     * 添加开奖结果
     */
    public function add_open(Request $request){
        if($request->isPost()){
            $cate = $request->param('cate');
            $stage = $request->param('stage');
            $number = $request->param('number');
            $end_time = $request->param('end_time');
            if($cate){
                $table_name=$this->choose_table($cate);
            }
            if(empty($number)){
                return json(array('code'=>10000,'msg'=>'请填写开奖结果'));
            }
            $w['stage'] = $stage;
            $this_number = Db::name($table_name.'_stage')->where($w)->find();
            // return json($this_number);
            if($this_number){
                if($this_number['number']){
                    return json(array('code'=>0,'msg'=>'已开奖，无需操作'));
                }else{
                    Db::startTrans();
                    try{
                        $data['stage']=$stage;
                        $data['number'] = $number;
                        $data['dateline'] = date('Y-m-d H:i:s',$end_time);
                        $data['create_time'] = date('Y-m-d H:i:s',time());
                        $result = Db::name('at_'.$table_name)->insert($data);
                        $re = Db::name($table_name.'_stage')->where('stage',$stage)->setField('number',$number);
                        Db::commit();
                        return json(array('code'=>0,'msg'=>'开奖成功！可能会有5分钟延迟'));
                    }catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                        return json(array('code'=>10000,'msg'=>'系统故障'));
                    }
                }
            }else{
                return json(array('code'=>10005,'msg'=>'系统错误！'));
            }
        }else{
            return json(array('code'=>10003,'msg'=>'无此权限！'));
        }
    }










//    public function add_open(Request $request){
//        if($request->isPost()){
//            $cate = $request->param('cate');
//            $stage = $request->param('stage');
//            $number = $request->param('number');
//            if($cate){
//                $table_name=$this->choose_table($cate);
//            }else{
//                $this->error('请选择彩种');
//            }
//            if(empty($stage)){
//                $this->error('请填写期数');
//            }else{
//                $w['stage']=$stage;
//            }
//            if(empty($number)){
//                $this->error('请填写开奖结果');
//            }
//
//            $this_number = Db::name($table_name.'stage')->where($w)->find();
//            if($this_number){
//                if($this_number['number']){
//                    $this->error('已开奖，无需操作');
//                }else{
//                    $insert['stage'] = $w['stage'];
//                    $insert['number'] = $number;
//                    $insert['number'] = $this_number['end_bet_time'];
//
//                    $result = Db::name('at_'.$table_name)->insert();
//                     $m = Db::name($table_name.'stage')->save(['number'=>$number],['stage'=>$stage]);
//                    if ($result && $m) {
//                        $this->success('修改成功');
//                    }else{
//                        $this->error('修改失败');
//                    }
//                }
//            }else{
//                $this->error('请填写正确期数');
//            }
//        }else{
//            $this->error('无此权限！');
//        }
//    }
    /**
     * 开奖数据
     */
    public function result_table(Request $request){
        $cate = $request->param('cate');
        $stage = $request->param('stage');
        $from   = $request->param('from');
        $to     = $request->param('to');
        $w = [];
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['dateline'] = [['>=',$from],['<=',$to]];
        }
        if($stage){
            $w['stage']=$stage;
        }
        if($cate){
            $name = $this->choose_table($cate);
        }else{
            $name = 'cqssc';
        }
        $list = Db::name('at_'.$name)->where($w)->order('stage desc')->paginate(20,false,['query'=>request()->param()]);
        //开奖类型
        $cates = Db::name('cate')   
            ->field('id,name')   
            ->select();
        return view('',[
            'cates'=>$cates,
            'list' =>$list,
            'page' =>$list->render(),
        ]);
    }
    /**
     * 开奖检测
     */
    public function open_test(){
        return view();
    }

    public function choose_table($cate){
        switch ($cate) {
                case '1':
                    $name='car';
                    break;
                case '2':
                    $name = 'cqssc';
                    break;
                case '3':
                    $name = 'xyft';
                    break;
                case '4':
                    $name = 'gdsyxw';
                    break;
                case '5':
                    $name = 'jsks';
                    break;
                case '6':
                    $name = 'pcdd';
                    break;
                case '7':
                    $name = 'msssc';
                    break;
                case '8':
                    $name = 'mssc';
                    break;
                case '9':
                    $name = 'xglhc';
                    break;
                case '10':
                    $name = 'xync';
                    break;
                default:
                    $name = 'cqssc';
                    break;
            }
        return $name;
    }

}
