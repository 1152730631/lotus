<?php 
header("content-type:text/html;charset=utf-8");
	//(1) 定义一个单身狗类
	class dog{
		//成员属性(对象属性)
		private $name = "小强";
		private $age = 20;

		public function showinfo(){
			return "{$this->$name}的年龄是{$this->$age}岁";
		}
		// //成员方法(对象方法)
		// public function showinfo($name,$age){
		// 	return "{$name}的年龄是{$age}岁";
		// }
	}
	
	//(2)创建类的对象
	$obj = new dog;
	
	echo $obj->showinfo();





?>