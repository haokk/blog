<?php 
namespace zhongguo\henan;
header("content-type:text/html; charset=utf-8");
	function ceshi(){
		echo "河南";
	}


namespace zhongguo\shandong;
	function ceshi(){
		echo "山东";
	}



namespace meiguo\niuyue;
	function ceshi(){
		echo "纽约";
	}
	function ceshi2(){
		echo "纽约2";
	}
	class People{
		static $name='美国人';
	}


namespace zhongguo\shanxi;
	function ceshi(){
		echo "山西";
	}
	class People{
		static $name='山西人';
	}



	// ceshi();	 非限定名称
	// \zhongguo\shandong\ceshi();

 //空间的引入
// echo People::$name;

// use meiguo\niuyue;
// echo People::$name;
// \meiguo\niuyue\ceshi2();
// echo niuyue\People::$name;

// use meiguo\niuyue\People as pe;
// echo Pe::$name;


//公共空间的引入
include("./common.php");
\zhongguo\henan2\ceshi();