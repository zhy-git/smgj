<?php

namespace app\api\command;
use think\Cache;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;


class Numbers extends Command
{
    protected function configure()
    {
        $this->setName('numbers')->setDescription('获取彩票开奖');
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
            $newNum = array();
            if (isset($number['rows'])) {
                if($k == 'msssc' || $k == 'mssc' || $k == 'gdsyxw' || $k == 'jsks' || $k == 'xync'){
                    foreach ($number['data'] as $kk => $vv) {
                        $data['stage'] = substr($vv['expect'],2);
                        $data['number'] = $vv['opencode'];
                        $data['dateline'] = $vv['opentime'];
                        $data['create_time'] = date('Y-m-d H:i:s');
                        $newNum[$data['stage']]['number'] = $data['number'];
                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
                        break;
                    }
                }else if($k == 'pcdd'){
                    foreach ($number['data'] as $kk => $vv) {
                        $data['stage'] = $vv['expect'];
                        $data['number'] = getEightNum(explode(',',str_replace("+",",",$vv['opencode'])));
                        $data['dateline'] = $vv['opentime'];
                        $data['create_time'] = date('Y-m-d H:i:s');
                        $newNum[$data['stage']]['number'] = $data['number'];
                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
                        break;
                    }
                }else if($k=='jndeb'){
                    foreach ($number['data'] as $kk => $vv) {
                        $data['stage'] = $vv['expect'];
                        $data['number']=getJndNum(explode(',',$vv['opencode']));
                        $data['dateline']=$vv['opentime'];
                        $data['create_time'] = date('Y-m-d H:i:s');
                        $newNum[$data['stage']]['number'] = $data['number'];
                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
                        break;
                    }
                }else if($k == 'xglhc'){
                    foreach ($number['data'] as $kk => $vv) {
                        $data['stage'] = $vv['expect'];
                        $data['number'] = str_replace("+",",",$vv['opencode']);
                        $data['dateline'] = $vv['opentime'];
                        $data['create_time'] = date('Y-m-d H:i:s');
                        $newNum[$data['stage']]['number'] = $data['number'];
                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
                        break;
                    }
                }else{
                    foreach ($number['data'] as $kk => $vv) {
                        $data['stage'] = $vv['expect'];
                        $data['number'] = $vv['opencode'];
                        $data['dateline'] = $vv['opentime'];
                        $data['create_time'] = date('Y-m-d H:i:s');
                        $newNum[$data['stage']]['number'] = $data['number'];
                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
                        break;
                    }
                }
                switch ($k) {
                    case 'car':
                        $is_have = Db::name('at_car')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_car')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('car_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'xyft':
                        $is_have = Db::name('at_xyft')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_xyft')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('xyft_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'cqssc':
                        $is_have = Db::name('at_cqssc')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_cqssc')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('cqssc_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'xyeb':
                        $is_have = Db::name('at_xyeb')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_xyeb')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('xyeb_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'jndeb':
                        $is_have = Db::name('at_jndeb')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_jndeb')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('jndeb_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'mssc':
                        $is_have = Db::name('at_mssc')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_mssc')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('mssc_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'msssc':
                        $is_have = Db::name('at_msssc')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_msssc')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('msssc_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'jsks':
                        $is_have = Db::name('at_jsks')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_jsks')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('jsks_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'pcdd':
                        $is_have = Db::name('at_pcdd')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_pcdd')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('pcdd_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'gdsyxw':
                        $is_have = Db::name('at_gdsyxw')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_gdsyxw')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('gdsyxw_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'xync':
                        $is_have = Db::name('at_xync')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_xync')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('xync_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'xglhc':
                        $is_have = Db::name('at_xglhc')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_xglhc')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('xglhc_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                    case 'car':
                        $is_have = Db::name('at_car')->where(array('stage' => $data['stage']))->find();
                        if (!$is_have) {
                            Db::startTrans();
                            try {
                                Db::name('at_car')->insert($data);
                                $updateData['number'] = $data['number'];
                                Db::name('car_stage')->where(array('stage' => $data['stage']))->update($updateData);
                                Db::commit();
                            } catch (\Exception $e) {
                                Db::rollback();
                            }
                        }
                        break;
                }
                //Cache::store('redis')->set('number_'.$k,$number);
                Cache::set('number_' . $k, $newNum);
            }
        }
    }
//    public function doCron1()
//    {
//
//        $api = Config::get('lottery_api');
//        foreach ($api as $k => $v) {
//            $url = $v;
//            $res = httpGet($url);
//
//            $number = json_decode($res, true);
//            dump($number);exit;
//
//            $newNum = array();
//            if (isset($number['rows'])) {
//                if($k == 'msssc' || $k == 'mssc' || $k == 'gdsyxw' || $k == 'jsks' || $k == 'xync'){
//                    foreach ($number['data'] as $kk => $vv) {
//                        $data['stage'] = substr($vv['expect'],2);
//                        $data['number'] = $vv['opencode'];
//                        $data['dateline'] = $vv['opentime'];
//                        $data['create_time'] = date('Y-m-d H:i:s');
//                        $newNum[$data['stage']]['number'] = $data['number'];
//                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
//                        break;
//                    }
//                }else if($k == 'pcdd'){
//                    foreach ($number['data'] as $kk => $vv) {
//                        $data['stage'] = $vv['expect'];
//                        $data['number'] = getEightNum(explode(',',str_replace("+",",",$vv['opencode'])));
//                        $data['dateline'] = $vv['opentime'];
//                        $data['create_time'] = date('Y-m-d H:i:s');
//                        $newNum[$data['stage']]['number'] = $data['number'];
//                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
//                        break;
//                    }
//                }else if($k == 'xglhc'){
//                    foreach ($number['data'] as $kk => $vv) {
//                        $data['stage'] = $vv['expect'];
//                        $data['number'] = str_replace("+",",",$vv['opencode']);
//                        $data['dateline'] = $vv['opentime'];
//                        $data['create_time'] = date('Y-m-d H:i:s');
//                        $newNum[$data['stage']]['number'] = $data['number'];
//                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
//                        break;
//                    }
//                }else{
//                    foreach ($number['data'] as $kk => $vv) {
//                        $data['stage'] = $vv['expect'];
//                        $data['number'] = $vv['opencode'];
//                        $data['dateline'] = $vv['opentime'];
//                        $data['create_time'] = date('Y-m-d H:i:s');
//                        $newNum[$data['stage']]['number'] = $data['number'];
//                        $newNum[$data['stage']]['dateline'] = $data['dateline'];
//                        break;
//                    }
//                }
//                switch ($k) {
//                    case 'car':
//                        $is_have = Db::name('at_car')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_car')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('car_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'cqssc':
//                        $is_have = Db::name('at_cqssc')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_cqssc')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('cqssc_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'xyft':
//                        $is_have = Db::name('at_xyft')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_xyft')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('xyft_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'mssc':
//                        $is_have = Db::name('at_mssc')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_mssc')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('mssc_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'msssc':
//                        $is_have = Db::name('at_msssc')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_msssc')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('msssc_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//				            print_r($e->getMessage());
//                            }
//                        }
//                        break;
//                    case 'jsks':
//                        $is_have = Db::name('at_jsks')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_jsks')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('jsks_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'pcdd':
//                        $is_have = Db::name('at_pcdd')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_pcdd')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('pcdd_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'gdsyxw':
//                        $is_have = Db::name('at_gdsyxw')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_gdsyxw')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('gdsyxw_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'xync':
//                        $is_have = Db::name('at_xync')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_xync')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('xync_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                    case 'xglhc':
//                        $is_have = Db::name('at_xglhc')->where(array('stage' => $data['stage']))->find();
//                        if (!$is_have) {
//                            Db::startTrans();
//                            try {
//                                Db::name('at_xglhc')->insert($data);
//                                $updateData['number'] = $data['number'];
//                                Db::name('xglhc_stage')->where(array('stage' => $data['stage']))->update($updateData);
//                                Db::commit();
//                            } catch (\Exception $e) {
//                                Db::rollback();
//                            }
//                        }
//                        break;
//                }
//                //Cache::store('redis')->set('number_'.$k,$number);
//                Cache::set('number_' . $k, $newNum);
//            }
//        }
//    }
}
