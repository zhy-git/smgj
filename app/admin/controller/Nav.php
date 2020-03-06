<?php
namespace app\admin\controller;
use app\admin\model\AdminNav;
use think\Request;

/**
 * 后台菜单管理
 */
class Nav extends Admin{
	/**
	 * 菜单列表
	 */
	public function index(){
		$AdminNav = new AdminNav();
		$data=$AdminNav->getTreeDatas('tree','sort,id');
		$assign=array(
			'data'=>$data
			);
		$this->assign($assign);
		return view();
	}

	/**
	 * 添加菜单
	 */
	public function add(Request $request){
		$data = $request->post();
		unset($data['id']);
		$AdminNav = new AdminNav();
		$result=$AdminNav->addData($data);
		if ($result) {
			$this->success_new('添加成功',url('Admin/Nav/index'));
		}else{
			$this->error_new('添加失败');
		}
	}

	/**
	 * 修改菜单
	 */
	public function edit(Request $request){
		$data = $request->post();
		$map=array(
			'id'=>$data['id']
			);
		$AdminNav = new AdminNav();
		$result=$AdminNav->editData($map,$data);
		if ($result) {
			$this->success_new('修改成功',url('Admin/Nav/index'));
		}else{
			$this->error_new('修改失败');
		}
	}

	/**
	 * 删除菜单
	 */
	public function delete(Request $request){
		$id = $request->param('id');
		$map=array(
			'id'=>$id
			);
		$AdminNav = new AdminNav();
		$result=$AdminNav->deleteDataa($map);
		if($result){
			$this->success_new('删除成功',url('Admin/Nav/index'));
		}else{
			$this->error_new('请先删除子菜单');
		}
	}

	/**
	 * 菜单排序
	 */
	public function order(Request $request){
		$data = $request->post();

		$AdminNav = new AdminNav();
		$result=$AdminNav->orderData($data);
		if ($result) {
			$this->success_new('排序成功',url('Admin/Nav/index'));
		}else{
			$this->error_new('排序失败');
		}
	}



}
