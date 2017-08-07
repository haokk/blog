<?php
// 应用公共文件

//对二维数组进行去重
function arr_unique($arr2D){
	foreach ($arr2D as $v) {
		$v = join(',',$v);		//把数组元素组合为一个字符串
		$temp[] = $v;
	}
	$temp = array_unique($temp);	//移除数组中重复的值(对一维数组有效)
	foreach ($temp as $k => $v) {
		$temp[$k] = explode(',',$v);		//把字符串打散为数组
	}
	return $temp;
}