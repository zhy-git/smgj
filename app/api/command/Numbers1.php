<?php

namespace app\api\command;
use think\Cache;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;


class Numbers1 extends Command
{
    protected function configure()
    {
        $this->setName('numbers1')->setDescription('获取彩票开奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron()
    {


        $api = Config::get('lottery_api');
        foreach ($api as $k => $v) {
            $url = $v;
            $res = httpGet($url);
            $number = json_decode($res, true);
            if (!isset($number['status'])) {
                foreach ($number as $kk => $vv) {
                    $data['stage'] = $kk;
                    $data['number'] = $vv['number'];
                    $data['dateline'] = $vv['dateline'];
                    $data['create_time'] = date('Y-m-d H:i:s');
                }
                switch ($k) {
                    case 'tjssc':
                        $is_have = Db::name('at_tjssc')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            $m = Db::name('at_tjssc')->insert($data);
                        }
                        break;
                    case 'gd10':
                        $is_have = Db::name('at_gd10')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            $m = Db::name('at_gd10')->insert($data);
                        }
                        break;
                    case 'cq10':
                        $is_have = Db::name('at_cq10')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            $m = Db::name('at_cq10')->insert($data);
                        }
                        break;
                    case 'fast':
                        $is_have = Db::name('at_fast')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            $m = Db::name('at_fast')->insert($data);
                        }
                        break;
                    case 'gd11':
                        $is_have = Db::name('at_gd11')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            $m = Db::name('at_gd11')->insert($data);
                        }
                        break;
                    case 'hk':
                        $is_have = Db::name('at_hk')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            $m = Db::name('at_hk')->insert($data);
                        }
                        break;
                }
                Cache::store('redis')->set('number_'.$k,$number);
               // Cache::set('number_' . $k, $number);
            }
        }
    }
}