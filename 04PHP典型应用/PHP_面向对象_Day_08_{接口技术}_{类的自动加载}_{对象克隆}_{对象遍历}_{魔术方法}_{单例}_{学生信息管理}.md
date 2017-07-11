## PHP_面向对象_Day_08_{接口技术}_{类的自动加载}_{对象克隆}_{对象遍历}_{魔术方法}_{单例}_{学生信息管理}

![PHP面向对象_Day_08](media/14926483986009/PHP%E9%9D%A2%E5%90%91%E5%AF%B9%E8%B1%A1_Day_08.png)

[TOC]

## 接口技术
* 接口就是特殊的抽象类
* 接口:可以理解为方法的命名规范
* PHP是单继承,如果同时要继承多个父类的功能用接口实现
* 接口使用`interface`来定义

>> 接口的定义要点

* 接口就是一个规范,方法的命名标准
* 使用interface关键字定义一个接口
* 一般`implements`来实现接口
* 一般同类的东西,可以继承,不同类别的只能实现
* 类可以继承类,接口可以继承接口,但是,类只能实现接口
* 接口中的内容只能是,类常量和抽象方法
* ==接口中的方法默认都是抽象方法,不需要加abstract关键字==
* 接口中的抽象方法,必须是public权限
* 接口中的抽象方法可以是成员方法,也可以是静态方法
* 抽象类中抽象方法必须是成员方法
* 接口中所有的抽象方法都需要重写
* 接口中的常量不能重写,其他类中的常量,在子类中是可以重写

> 例 接口的使用

```php
//定义一个接口
interface Inter1{
	//类常量
	//抽象方法
}

//定义一个接口
interface Inter2{
	//类常量
	//抽象方法
}

//创建抽象子类 并实现接口
abstract class Student implements Inter1,Inter2{
	//类的内容
}
//创建蓝翔学生类,并继承学生类
final class BlueStudent extends Student{
	
}
//创建对象
$obj = new BlueStrdent();

```

> 接口的定义语法


```php

interface Inter1{
	const TITLE = "蓝翔技工学院";
	//抽象方法
	public function showInfo($name,$age);
}

interface Inter2{
	const TITLE2 = "PINK";
	//抽象方法
	public static function readMe();
}

//创建一个类,并实现多个接口
class Student implements Inter1,Inter2{
	
	//重写接口中的方法:
	public function showInfo($name,$age){
		echo "接口Inter1中的常量".self::TITLE."\n";
		echo "接口Inter2中的常量".self::TITLE2."\n";
		echo "{$name}的年龄是{$age}岁\n";
		echo self::readMe();
	}
	public static function readMe(){
		return "这是重写的".__METHOD__."静态方法\n";
	}
}

$obj = new Student();
$obj->showInfo("旺财","24");

```

> 例 接口案例

```php

//定义小灵通的接口
interface XiaoLingTong{
	//打电话
	public function tel();
}
//定义一个MP3的接口
interface Mp3{
	public function music();
}
//定义Mp4的接口
interface Mp4 extends Mp3{
	public function video();
}
//定义一个手机类实现以上所有接口
final class Mobile implements XiaoLingTong,Mp4{
	public function tel(){
		echo "正在打电话";
	}
	public function music(){
		echo "正在听音乐";
	}
	public function video(){
		echo "正在看视频";
	}
	public function game(){
		echo "正在打游戏";
	}
}

$obj = new Mobile();
$obj->video();

```

## 类的自动加载
>> 为什么需要类的自动加载

* 一个类单独定义一个独立的文件,一个项目有很多类文件(100类文件)然后将类文件加载到当前页面,使用包括语法`include``require``include_once``require_once`页面开通写100行`require_once`包含类的文件语句
* 以上描述,有弊端
* ① 所有类都会驻留内存,造成了内存浪费
* ② 后期维护时 成本很高,效率很低
* ③ 如果类文件位于不同的目录,包含的文件路径还要修改

* 解决方法:按需加载,用的哪个文件自动加载

>> 常规的自动加载类函数_autoload()

* 类的自动加载,是通过`__autoload()`函数来实现
* `__autoload()`是系统函数,该函数没有函数体,需要我们自己定义它的功能
* `__autoload()`函数只有一个必须的参数 `$className` 类名参数
* `__autoload()`函数体的内容是,去实现加载指定类文件的代码;
* `__autoload()` 函数何时调用,该函数是自动调用的
    * 当你 `new` 一个类时,该类没有找到,`__autoload()`就会自动调用,并传达类名参数
    * 当你用静态化方式使用类是,该类没有找到,`__autoload()`就回自动调用,并传类名参数过来
     * 如`$obj = new Student()` 或者`Student::showInfo()`

>> 类文件的命名规则

* 使用驼峰式命名如:Db connMySQL studentModel NewsContriller 
* 类文件的命名规范,类文件的主名,就是类名,并且以`class.php`结尾
    * 如:Db.class.php , StudentModel.class.php
    
>> 举例说明

```php

//类自动加载
function __autoload($className){
	//构建类文件的路径
	$fileName =  "/Library/WebServer/Documents/Demo1/libs/$className.class.php";
	require_once($fileName);	
}

$stuObj = new Student();
$stuObj->showInfo();

```

## 自定义自动加载类文件函数(spl_autoload_register)
>> 描述

* 如果类文件位于不同目录,则`__autoload()`加载时,就比较麻烦
* `spl_autoload_register()`自动加载类文件函数,类文件可以位于不同的目录
* `spl_autoload_register()`也是自动加载类文件
    * 当使用`new`关键字,创建类对象时,如果该类不存在,则会自动调用
    * 当用静态方式访问类中成员时,如果该类不存在,也会自动调用
* 将一系列自定义的类的装载函数,放在一个队列中,按照顺序执行
* 提示在项目中,主要使用`spl_autoload_register()`装载类格式

>> 语法格式


```php

sql_autoload_register(function funcName);
sql_autoload_register(string funcName);

``` 

* `sql_autoload_register`函数的参数可以是一个**匿名函数**,也可以是一个**字符串的函数名**
* 理解为函数传递地址 每一种函数 都是一种类文件的装载规则,按照队列的顺序执行

>> 类的自动加载演示


```php

//按照注册的队列属性,自动向下执行,找到为止
spl_autoload_register("func1");
spl_autoload_register("func2");

function func1($className){
	//构建类文件路径
	$filename = "/Library/WebServer/Documents/Demo1/libs/lA/$className.class.php";
	//如果类文件存在,则包含类文件
	if(file_exists($filename)){
		require_once($filename);
	}
	
}

function func2($className){
	//构建类文件路径
	$filename = "/Library/WebServer/Documents/Demo1/libs/$className.class.php";
	//如果类文件存在,则包含类文件
	if(file_exists($filename)){
		require_once($filename);
	}
}
 
$stuObj = new Teacher();
$stuObj->showInfo();

```

>> 匿名函数参数自动加载演示 


```php

//使用匿名函数参数
//按照注册的队列属性,自动向下执行,找到为止
spl_autoload_register(function($className) {
	$arr[] = "/Library/WebServer/Documents/Demo1/libs/lA/$className.class.php";
	$arr[] = "/Library/WebServer/Documents/Demo1/libs/$className.class.php";
	
	foreach($arr as $filename){
		if(file_exists($filename))require_once($filename);
	}
});

$stuObj = new Student();
$stuObj->showInfo();

```

## 对象克隆
* 当你想使用类的对象时,有什么办法可以穿件两个不同的对象     
    * 使用new关键字可以创建不同的对象`$obj=new student`
    * 使用clone关键字可以创建不同的对象`$obj=clone $obj1`

>>clone关键字的使用


```php

$obj1 = new Student();
$obj2 = clone $obj1; //克隆新对象:将产生两个不同的对象
var_dump($obj1,$obj2);			
//object(Student)#2 (0) {}object(Student)#3 (0) {}

```

###__clone魔术方法

* 魔术方法一般都是自动调用的,魔术方法都存在类中
* 当对象克隆完成时,自动调用的方法,就是`__clone`
* 其他的魔术方法`__construct()`,`__destruct`,`__clone()`
`__get()`,`__set()`,`__unset`;
* 作用:对象克隆完成后,可以用来修改属性的值,或者添加属性


```php

final class Student{
		public function showInfo(){
			echo __CLASS__;
			echo __METHOD__;
		}
		
		public function __clone(){
		//对克隆的对象添加新属性
			$this->name = "李狗蛋";
			echo __METHOD__."已经调用,{$this->name}对象克隆完成";	
		}
	}

```


```php
//对学生类对象进行克隆
$obj1 = new Student();
$obj2 = clone $obj1; //克隆新对象:将产生两个不同的对象
var_dump($obj1,$obj2);		

```

## 对象遍历
* 遍历对象和遍历数组都使用`foreach`
* ==注意:在类外只能遍历对象的共属性==
* ==注意:在类内可以遍历对象所有属性==

```php

public function __toString(){
			$str = "";
			foreach($this as $key => $value){
				$str .= "\$obj->$key = $value\n";
			}
			return "$str"; 
		}

```

## 魔术方法
>> __toString()

* 将一个对象转换成字符串时,`__toString()`就会自动调用
* 魔术方法的作用: 屏蔽一些错误.


```php

final class Student{
		private $age = 24;
		protected $edu = "大本";
		public function showInfo(){
			echo __CLASS__;
			echo __METHOD__;
			
			foreach($this as $key => $value){
				echo "\$obj->$key = $value\n";
			}
		}
		
		public function __clone(){
			$this->name = "李狗蛋";
			echo __METHOD__."已经调用,{$this->name}对象克隆完成";
			
		}
		//
		public function __toString(){
			$str = "";
			foreach($this as $key => $value){
				$str .= "\$obj->$key = $value\n";
			}
			return "$str"; 
		}
		
	}


```


>> __invoke

* 当场所调用函数的方式调用一个对象时,`__invoke()`方法就会自动调用


```php

//类文件路径是:/Library/WebServer/Documents/Demo1/libs/lA
	final class Student{
		
		private $age = 24;
		protected $edu = "大本";
		public function showInfo(){
			echo __CLASS__;
			echo __METHOD__;
			
			foreach($this as $key => $value){
				echo "\$obj->$key = $value\n";
			}
		}
		
		public function __clone(){
			$this->name = "李狗蛋";
			echo __METHOD__."已经调用,{$this->name}对象克隆完成";
			
		}
		
		public function __toString(){
			$str = "";
			foreach($this as $key => $value){
				$str .= "\$obj->$key = $value\n";
			}
			return "$str"; 
		}
		
		public function __invoke(){
			echo "将对象当成函数调用时";
		}
		
	}

```

## 面向对象设计模式
>> 什么是设计模式

* 简单讲,就是经过反复使用,分类的代码,设计经验的总结
* 设计模式的好处,降低开发成本,提供开发效率,方便后期维护

>> 常用的设计模式

* **单例模式**: 一个类只能创建一个对象,不管用什么办法,都无法创建第二个对象. 如 数据库对象
* **工厂模式**:根据传递的不同类名参数,可以穿件不同类的对象

## 单例设计模式

>> 单例设计的要求(三私一公)

* 一私: **私有的静态的保存对象属性**
* 二私: **私有的构造方法,组织类外new对象**
* 三私: **私有的克隆方法,阻止类外clone对象**
* 一公: 公共的静态的创建对象的方法.

>> instanceof 关键字

* 描述:判断对象是否属于某个类的实例
* 语法: `$obj instanceof ClassName`
* 返回: 如果`$obj`是`ClassName`的实例返回`true`

>> 举例说明

```php

class Db{ 
	//① 私有的静态的保存对象的属性
	private static $obj = null;
	//② 私有的构造方法,组织类外new对象
	private function __construct(){}
	//③ 私有的克隆方法,阻止类外clone对象
	private function __clone(){}
	//④ 公共的静态的创建对象的方法
	public static function getInstance(){
		 //判断对象是否存在
		if(!self::$obj instanceof self){
			//如果对象不存在,则创建它
			self::$obj = new self;
		}
		return self::$obj;
	}
}

```

## 综合案例:学生信息管理

* ① 数据表结构 itcast 数据库->student表

```php

+--------+-------------------------------------------------------+------+-----+---------+----------------+
| Field  | Type                                                  | Null | Key | Default | Extra          |
+--------+-------------------------------------------------------+------+-----+---------+----------------+
| id     | int(10) unsigned                                      | NO   | PRI | NULL    | auto_increment |
| name   | varchar(12)                                           | NO   |     | NULL    |                |
| sex    | enum('男','女')                                       | NO   |     | 男      |                |
| age    | tinyint(4)                                            | NO   |     | 24      |                |
| edu    | enum('初中','高中','大专','大本','研究生')            | NO   |     | 大专    |                |
| salary | float(8,2) unsigned                                   | NO   |     | 0.00    |                |
| bonus  | float(6,2) unsigned                                   | NO   |     | 0.00    |                |
| city   | varchar(32)                                           | YES  |     | NULL    |                |
+--------+-------------------------------------------------------+------+-----+---------+----------------+

```

* ② 单例的数据库操作类


```php

<?php 
header("Content-type:text/html;charset=utf-8");
	
final class Db1{
	//初始化变量
	private $db_name;		//数据库名
	private $db_user; 		//用户名
	private $db_pass;		//密码
	private $db_host;		//数据库服务名称
	private $db_charset;	//字符集

	//私有化
	private static $obj = null;
	//私有化构造方法 类初始化
	private function __construct($config = array()){
		$this->db_name = $config['db_name'];
		$this->db_user = $config['db_user'];
		$this->db_pass = $config['db_pass'];
		$this->db_host = $config['db_host'];
		$this->db_charset = $config['db_charset'];

		//① 连接数据库
		$this->LinkDB();
		//② 选择数据库
		$this->selectDb("itcast");
		//③ 设置字符集
		$this->setSetChar($this->db_charset);
	}
	//私有化克隆方法
	private function __clone(){}

	//获取当前对象的实例
	public static function getInstance($arr){
		if (!self::$obj instanceof self) {
			self::$obj = new self($arr);
		} 
		return self::$obj;
	}
	//连接数据库
	public function LinkDB(){
		$link = @mysql_connect(
			 $this->db_host
			,$this->db_user
			,$this->db_pass)
			 or die("数据库连接失败".mysql_error());
	}
	
	//选择数据库
	public function selectDb($db_name){
		if (!mysql_select_db($db_name)) {
			die("选择数据失败");
		}
	}
	//选择字符集
	public function setSetChar($Char){
		return $this->exec("set names $Char"); 
	}	



	//将sql语句区分 有结果集的和无结果集的
	//公共执行SQL语句的方法 insert update delete set create drop 无结果集
	private function exec($sql){
		//先将sql转换成小写方便判断
		$sql = strtolower($sql);
		//判断sql语句是否是select 如果不是select则执行
		if (substr($sql,0,6) == "select") {
			die("请使用query()方法执行select查询");
		}else {
			return mysql_query($sql);
		}

	}

	//私有执行SQL语句的方法 select show 有结果集
	public function query($sql){
		$sql = strtolower($sql);
		if (substr($sql,0,6) == "select") {		
			return mysql_query($sql);
		}else {
			exit("请使用exec()方法执行");
		}
	}

	//获取查询记录数
	public function getRecords($sql){
		$res = $this->query($sql);
		return mysql_num_rows($res);
	}

	//执行sql语句   获取数据结果的数组 
	//返回数组类型 type 默认返回 混合数组
	public function fetchALL($sql,$type = 0){
		$arr = array(); //初始化返回结果集
		$types = array(MYSQL_BOTH,MYSQL_NUM,MYSQL_ASSOC);
		$res = $this->query($sql);
		if ($res) {
			while ($row = mysql_fetch_array($res,$types[$type])) {
				$arr[] = $row;
			}
		}else{
			echo "未获得资源";
		}		
		return $arr;
	}

	//关闭资源
	public function __destruct(){
		mysql_close();
	}
}	

?>

```

* ③ 创建conn公共文件


```php

<?php 
header("Content-type:text/html;charset=utf-8");

//自动加载类
spl_autoload_register(function($className){
	$arr[] = "/Library/WebServer/Documents/Demo1/PHP_DAY07/$className.class.php";
	foreach ($arr as $key => $value) {
		if (file_exists($value)) {
			echo $value;
			require_once($value);
		}
	}
});

//创建数据库对象
	$arr = array( 
	"db_name" => "itcast",
	"db_user" => "root",
	"db_pass" => "12345",
	"db_host" => "localhost",
	"db_charset" => "utf8");

	$db = Db1::getInstance($arr);
	
function dump($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>

```

* ④ 显示学生信息列表`list.php`


```php

<?php 
header("Content-type:text/html;charset=utf-8");

require_once("./conn1.php");

$sql = "SELECT * from student order by id desc";

$arr = $db->fetchALL($sql,0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class = "title" >
		<a href="#">添加学生</a>
		共
		<?php echo $db->getRecords($sql) ?>		
	</div>	
	<table border="1" bordercolor="#CCC" rules="all" align="center" width="600">
		<tr>
			<th>编号</th>
			<th>姓名</th>
			<th>性别</th>
			<th>年龄</th>
			<th>学历</th>
			<th>工资</th>
			<th>奖金</th>
			<th>籍贯</th>
		</tr>
		<?php 
			foreach ($arr as $key => $value) {				
		?>
		<tr>
			<td><?php echo $value[0] ?></td>
			<td><?php echo $value[1] ?></td>
			<td><?php echo $value[2] ?></td>
			<td><?php echo $value[3] ?></td>
			<td><?php echo $value[4] ?></td>
			<td><?php echo $value[5] ?></td>
			<td><?php echo $value[6] ?></td>
			<td><?php echo $value[7] ?></td>
			
		</tr>

		<?php 

			}

		 ?>

	</table>
	
</body>
</html>

```


