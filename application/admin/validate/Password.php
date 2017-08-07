<?php
namespace app\admin\validate;
use think\Validate;

class Password extends Validate
{
   protected $rule = [
   	'password' => 'require|min:5',
   ];

   protected $message  =   [
        
        'password.require' => '密码不能为空！',
        'password.min' => '密码不能小于5位！',
    ];

}
