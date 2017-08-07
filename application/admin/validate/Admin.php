<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
   protected $rule = [
   	'username' => 'require|max:23|unique:admin',
   	'password' => 'require|min:5',
   ];

   protected $message  =   [
        'username.require' => '用户名不能为空！',
        'username.unique' => '用户名不能重复！',
        'username.max' => '用户名不能大于23位！',
        'password.require' => '密码不能为空！',
        'password.min' => '密码不能小于5位！',
    ];


   protected $scene = [
        'edit'  =>  ['username'],
    ];
}
