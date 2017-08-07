<?php
namespace app\admin\controller;


class Admin extends Base
{
    public function lst()
    {
    	$adminres = \think\Db::name('admin')->order('id asc')->paginate(3);
    	$this->assign('adminres',$adminres);
        return  $this->fetch();
    }
     public function add()
     {

    	if (request()->isPost()) {
    		$data = [
    				'username' => input('username'),
    				'password' => md5(input('password')),
    		];

    		$validate = \think\Loader::validate('Admin');
    		if ( $validate->check($data)){
	    		$db = \think\Db::name('admin')->insert($data);
	    		if ($db) {
	    			return $this->success('添加管理员成功！','lst');
	    		}else{
	      			return $this->error('添加管理员失败！');
	    		}
	    	}else{
	    		return  $this->error($validate->getError());
	    	}
				return;
	    }
        return  $this->fetch();
  	}

   public function edit()
     {
       $id = input('id');
      if (request()->isPost()) {
        $userinfo = db('admin')->find($id);
        $password = $userinfo['password'];
        $data = [
            'username' => input('username'),
            'password' => input('password')?md5(input('password')):$password,
        ];
        // var_dump($data);die();

        $validate = \think\Loader::validate('Admin');
        if ( $validate->scene('edit')->check($data)){
            $db = \think\Db::name('admin')->where('id',$id)->update($data);
            if ($db) {
              return $this->success('修改管理员成功！','lst');
            }else{
                return $this->error('修改管理员失败！');
            }
        }else{
          return  $this->error($validate->getError());
        }
        return;
      }

     
      $admins = db('admin')->where('id',$id)->find();
      $this->assign('admins',$admins);
      return  $this->fetch();
    }


  	public function del(){
  		$id = input('id');
      if ($id == 1) {
        return $this->error('初始管理员不能删除');
      }
  		if (db('admin')->delete($id)) {
  			return $this->success('删除管理员成功','lst');
  		}else{
  			return $this->error('删除管理员失败');
  		}
  	}
}
