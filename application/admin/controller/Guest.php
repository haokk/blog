<?php
namespace app\admin\controller;


class Guest extends Base
{
    public function lst()
    {
    	$guestres = \think\Db::name('guest')->order('id asc')->paginate(10);
    	$this->assign('guestres',$guestres);
        return  $this->fetch('lst');
    }
  	public function del(){
  		$id = input('id');
  		if (db('guest')->delete($id)) {
  			return $this->success('删除留言成功','lst');
  		}else{
  			return $this->error('删除留言失败');
  		}
  	}
}
