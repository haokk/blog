<?php
namespace app\admin\controller;


class Password extends Base
{
   public function edit()
     {
       $id = input('id');
      if (request()->isPost()) {
        $userinfo = db('admin')->find($id);
        $password = $userinfo['password'];
        $data = [
            'password' => input('password')?md5(input('password')):$password,
        ];
       
        $validate = \think\Loader::validate('Password');
        if ( $validate->scene('edit')->check($data)){
            $db = \think\Db::name('admin')->where('id',$id)->update($data);
            if ($db) {
              return $this->success('修改密码成功！','index/index');
            }else{
                return $this->error('修改密码失败！');
            }
        }else{
          return  $this->error($validate->getError());
        }
        return;
      }

      $admins = db('admin')->where('id',$id)->find();
      $this->assign('admins',$admins);
      return  $this->fetch('admin/edit');
    }


}
