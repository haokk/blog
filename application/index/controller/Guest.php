<?php
namespace app\index\controller;

class Guest extends Base
{
    public function index()
    {
    	$guestres = \think\Db::name('guest')->order('id desc')->paginate(6);
        $this->assign('guestres',$guestres);
        return  $this->fetch('guest');
    }

    public function add()
    {

	if (request()->isPost()) {
		$data = [
				'inpname' => input('inpname'),
				'content' => input('content'),
				'time' => time(),
		];

		$validate = \think\Loader::validate('Guest');
		if ( $validate->check($data)){
    		$db = \think\Db::name('guest')->insert($data);
    		if ($db) {
    			return $this->success('发表留言成功！');
    		}else{
      			return $this->error('发表留言失败！');
    		}
    	}else{
    		return  $this->error($validate->getError());
    	}
			return;
    }
    return  $this->fetch();
  	}

}
