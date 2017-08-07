<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
   protected $rule = [
   	'title' => 'require|unique:article',
   	'keywords' => 'require',
   ];

   protected $message  =   [
        'title.require' => '标题不能为空！',
        'title.unique' => '标题不能重复！',
        'keywords' => '关键字不能为空！',
    ];

}
