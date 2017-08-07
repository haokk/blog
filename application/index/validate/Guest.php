<?php
namespace app\index\validate;
use think\Validate;

class Guest extends Validate
{
   protected $rule = [
   	'inpname' => 'require',
   	'content' => 'require',
   ];

   protected $message  =   [
        'inpname.require' => '发表者不能为空！',
        'content' => '发表内容不能为空！',
    ];

}
