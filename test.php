<?php 
namespace henan;
function ceshi(){
	echo 1111;
}

// \shangdong\ceshi();

namespace shangdong;
function ceshi(){
	echo 2222;
}
// \henan\ceshi();

// ceshi();	//非限定名称
// henan\ceshi();	//限定名称
 \henan\ceshi();	//完全限定名称