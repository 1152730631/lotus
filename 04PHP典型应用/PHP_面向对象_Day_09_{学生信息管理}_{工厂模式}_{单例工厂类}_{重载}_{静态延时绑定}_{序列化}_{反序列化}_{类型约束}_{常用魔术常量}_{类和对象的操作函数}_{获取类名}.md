# PHP_面向对象_Day_09_{学生信息管理}_{工厂模式}_{单例工厂类}_{重载}_{静态延时绑定}_{序列化}_{反序列化}_{类型约束}_{常用魔术常量}_{类和对象的操作函数}_{获取类名}

![PHP_面向对象_Day_09](media/14927355308000/PHP_%E9%9D%A2%E5%90%91%E5%AF%B9%E8%B1%A1_Day_09.png)

[TOC]

## 面向对象的开发流程
* 面向过程是以过程为中心的编程思想
* 面向对象是是事物(对象)为中心的编程思想
* 面向对象一个项目,由多个功能构成:用户管理,产品管理,新闻管理,留言管理,商品管理,分页,图像处理,文件管理,图像验证码,数据库管理等
* 每个功能对应一个对象.每个对象由**属性**和**方法**构成
* 每一个方法,代表一个小功能,与该功能无关的不做,每个方法只能做一件事
* 面向对象开发中是可以包含面向过程的代码
* 例如:定义一个数据库类,则顶层的开发,数据库所有函数禁止使用(mysql_connect(),mysql_fetch_array())
* 把数据库的函数封装到方法中,使用方法来完成任务
![屏幕快照 2017-04-21 下午09.17.18 上午-w840](media/14927355308000/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-21%20%E4%B8%8B%E5%8D%8809.17.18%20%E4%B8%8A%E5%8D%88.png)

## 单例模式
* 单例模式:一个类只能产生一个对象,不管用什么办法,都无法产生第2对象,如数据库类
* 一私: **私有的静态的保存对象属性**
* 二私: **私有的构造方法,组织类外new对象**
* 三私: **私有的克隆方法,阻止类外clone对象**
* 一公: 公共的静态的创建对象的方法.

```php

//final 的单例数据库操作类
	final class Db{
		//① 私有的静态的保存对象属性
		private static $obj = NUll;
		//② 私有的构造方法
		private function __construct(){}
		//③ 私有的克隆方法
		private function __clone(){}
		
		//④ 创建获取对象的静态公共方法
		public function getInstance(){
			//对象是否存在
			if(!self::$obj instanceof self){
				//如果对象不存在,则创建它
				self::$obj = new self();
			}
			return self::$obj;
		}
	}

```


## 学生信息管理(面向对象)

### 创建pager.class 将分页显示逻辑封装

```php

<?php 
//分页类 最终的分页类
final class Pager{
	public function showPages($page,$pages){
		 	   $start = $page - 5;
               $end = $page + 4;
                
                if ($page < 6) {
                    $start = 1;
                    $end = 10;
                }

                if ($end > $pages) {
                    $start = $pages-10+1;
                    $end = $pages;  
                }

                if ($pages <= 10 ) {
                    
                    $start = 1;
                    $end = $pages;

                }   
    
                //循环输出所有的页码
                //当前页
                for($i = $start; $i <= $end; $i++){
                    if ($i == $page) {
                        echo "<a class='page' href='?page = $i'> $i </a>";
                    }else {
                        echo "<a href='?page = $i'> $i </a>";
                    }
                    
               }

	}

}


?>

```

### 创建Db.class类将数据库操作封装

```php

<?php
	//final 的单例数据库操作类
	final class Db{
		//私有的数据库配置信息;
		private $db_host; //主机名	
		private $db_user; //用户名	
		private $db_pass; //密码		
		private $db_name; //数据库名
		private $charset; //字符集		
		
		//① 私有的静态的保存对象属性
		private static $obj = NUll;
		//② 私有的构造方法 
		private function __construct($config = array()){
			$this->db_host = $config["db_host"];
			$this->db_user = $config["db_user"];
			$this->db_pass = $config["db_pass"];
			$this->db_name = $config["db_name"];
			$this->charset = $config["charset"];
			
			//① 连接数据库
			$this->LinkDB();
			//② 选择数据库
			$this->selectDb($this->db_name);
			//③ 设置字符集
			$this->setSetChar($this->charset);
		}
		//③ 私有的克隆方法
		private function __clone(){}
		
		//④ 创建获取对象的静态公共方法
		public static function getInstance($config){
			//对象是否存在
			if(!self::$obj instanceof self){
				//如果对象不存在,则创建它
				self::$obj = new self($config);
			}
			return self::$obj;
		}
		
		// 连接数据库
		public function LinkDB(){
			$link = @mysql_connect(
				 $this->db_host
				,$this->db_user
				,$this->db_pass)
				 or die("数据库连接失败".mysql_error());
		}
		
		// 选择数据库
		public function selectDb($db_name){
			if (!mysql_select_db($db_name)) {
				die("选择数据失败");
			}
		}
		// 选择字符集
		public function setSetChar($Char){
			return $this->exec("set names $Char"); 
		}
		
		//将sql语句区分 有结果集的和无结果集的
		//公共执行SQL语句的方法 insert update delete set create drop 无结果集
		public function exec($sql){
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
		private function query($sql){
			$sql = strtolower($sql);
			if (substr($sql,0,6) == "select") {		
				return mysql_query($sql);
			}else {
				exit("请使用exec()方法执行");
			}
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
		//获取一行数据
		public function fetchOne($sql,$type = 0){
			$arr = array(); //初始化返回结果集
			$types = array(MYSQL_BOTH,MYSQL_NUM,MYSQL_ASSOC);
			$res = $this->query($sql);
			//返回一维数组
			return mysql_fetch_array($res,$types[$type]);
		}
		
		//获取查询记录数
		public function getRecords($sql){
			$res = $this->query($sql);
			return mysql_num_rows($res);
		}
		
		//关闭资源
		public function __destruct(){
			mysql_close();
		}
	
	}
	
?>

```

### 公共类conn.php

```php
<?php
	//(1)类的自动加载
	spl_autoload_register(function($className){
		//构建类文件路径
		$fileName = "/Library/WebServer/Documents/Demo1/PHP_DAY08/$className.class.php";
		
		if(file_exists($fileName))require_once($fileName);
	});
	
	//(2)创建数据库对象
	$arr = array( 
	"db_name" => "itcast",
	"db_user" => "root",
	"db_pass" => "12345",
	"db_host" => "localhost",
	"charset" => "utf8");
	$db = Db::getInstance($arr);
//	print_r($db);

	//(3)遍历数组或者对象的函数
	function dump($arr){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
?>
```

### 创建学生信息显示列表 list.php

```php
<?php 
header("Content-type:text/html;charset=utf-8");
//(1)包含连接数据库的文件
require_once("./conn.php");

//获取当前页码,并计算开始行号
$pagersize = 10; 						//每页要显示的记录数
if (isset($_GET['page_'])) {
	$page = $_GET['page_']; 		 		//当前页数
	$startrow = ($page-1)*$pagersize; 	//起始行数
}else{
	$page =1;
	$startrow = 0;
}

//(2)构建查询的SQL语句
$sql = "SELECT * from student order by id desc";

//计算总页数和总记录数
$cont = $db->getRecords($sql);
$pagers = ceil($cont / $pagersize);
$sql .= " LIMIT $startrow,$pagersize"; 

$arr = $db->fetchALL($sql,0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.title{
			padding: 10px 0px;
			text-align: center;
		}
	</style>

	<script>
		function confirmDel(id){
			//询问是否删除
			if(window.confirm("你确定要删除吗?")){
				//确认跳转到删除界面
				location.href = "./deleteStudent.php?id="+id;
			}else{

			}
		}

	</script>
</head>
<body>
	<div class = "title" >
		<a href="./addStudent.php">添加学生</a>
		当前共<font color = "red">
		<?php echo $db->getRecords($sql) ?>
		</font>	名学生.	
	</div>	
	<table border="1" bordercolor="#CCC" rules="all" align="center" width="600">
		<tr bgcolor="#f0f0f0">
			<th>编号</th>
			<th>姓名</th>
			<th>性别</th>
			<th>年龄</th>
			<th>学历</th>
			<th>工资</th>
			<th>奖金</th>
			<th>籍贯</th>
			<th>操作</th>
		</tr>
		<?php 
			foreach ($arr as $key => $value) {				
		?>
		<tr align="center">
			<td><?php echo $value[0] ?></td>
			<td><?php echo $value[1] ?></td>
			<td><?php echo $value[2] ?></td>
			<td><?php echo $value[3] ?></td>
			<td><?php echo $value[4] ?></td>
			<td><?php echo $value[5] ?></td>
			<td><?php echo $value[6] ?></td>
			<td><?php echo $value[7] ?></td>
			<td><a href="#" onclick="confirmDel(<?php echo $value['id'] ?>)">删除</a> 
			| <a href="./editStudent.php?id=<?php echo $value[0]; ?>">修改</a>	</td>
		</tr>
		<?php 

			}

		 ?>

		 <tr align="center" bgcolor="#f0f0f0">
		 	<td colspan="9">
		 		<?php 
		 		 	$pag = new pager();
		 		 	$pag->showPages($page,$pagers);
		 		?>
		 	</td>
		 </tr>
	</table>
</body>
</html>

```

### 创建删除学生记录deleteStudent.php

```php
<?php
header("Content-type:text/html;charset=utf-8");

	//包含连接数据库的公共文件
	require_once("./conn.php");
	
	//获取地址栏传入的id
	$id = $_GET['id'];
	
	//构建删除的SQL
	$sql = "DELETE FROM student where id = $id";

	//执行sql语句
	if ($db->exec($sql)) {
		echo "<h2>id={$id}的记录删除成功</h2>";
		header("refresh:1;url =./list.php");
		die();
	}else {
		echo "<h2>id={$id}的记录删除失败</h2>";
		header("refresh:1;url =./list.php");
		die();		
	}

?>
```

### 添加学生记录逻辑

```php

<?php 
header("Content-type:text/html;charset=utf-8");

//添加学生信息记录
session_start();

//包含连接数据库的公共文件
require_once("./conn.php");
dump($_POST);
//判断表单是否提交
if (isset($_POST["ac"]) && $_POST["ac"] == $_SESSION["randValue"]) {
	//获取表单数据
	foreach ($_POST as $key => $value) {
		$$key = $value;
	}

	$sql = "INSERT into student values(null,'$name','$sex','$age','$edu','$salary','$bonus','$city')";
	echo $sql;
	if($db->exec($sql)){
		echo "<h2> 学生信息添加成功 <h2>";
		header("refresh:3;url =./list.php");
	}else {
		echo "<h2> 学生信息添加失败 <h2>";
	}
	
	exit();
}else {
	$_SESSION["randValue"] = uniqid();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加学生信息</title>
</head>
<body>
	<div class = "title" >
		<h2>添加学生</h2>
		<a href="javascript:history.go(-1)">返回</a>
		
	</div>	

	<form action="" method="post" name="form1">
		<table border="1" bordercolor="#CCC" rules="all" align="center" width="400">
			<tr>
				<td width="80" align = "right">姓名:</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td width="80" align = "right">性别:</td>
				<td><input type="radio" name="sex" value="男">男
				<input type="radio" name="sex" value="女">女</td>
			</tr>

			<tr>
				<td width="80" align = "right">年龄:</td>
				<td><input type="text" name="age"></td>
			</tr>						
			
			<tr>
				<td width="80" align = "right">学历:</td>
				<td>
					<select name="edu" id="">
						<option value="初中">初中</option>
						<option value="高中">高中</option>
						<option value="大专">大专</option>
						<option value="大本">本科</option>
						<option value="研究生">研究生</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td width="80" align = "right">工资:</td>
				<td><input type="text" name="salary"></td>
			</tr>
			<tr>
				<td width="80" align = "right">奖金:</td>
				<td><input type="text" name="bonus"></td>
			</tr>
			<tr>
				<td width="80" align = "right">籍贯:</td>
				<td><input type="text" name="city"></td>
			</tr>			
			
			<tr>
				<td width="80" align = "right"></td>
				<td><input type="submit" value ="提交"></td>
				<td><input type="hidden" name="ac" value ="<?php echo $_SESSION['randValue']; ?>"></td>
			</tr>			
			
		</table>

	</form>
	
</body>
</html>

```

### 修改学生信息记录
```php
<?php 
header("Content-type:text/html;charset=utf-8");
//添加学生信息记录
session_start();
//包含连接数据库的公共文件
require_once("./conn.php");
dump($_POST);
//判断表单是否提交
if (isset($_POST["ac"]) && $_POST["ac"] == $_SESSION["randValue"]) {
	//获取表单数据
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}

		$sql = "UPDATE student SET 
		name='$name',
		sex='$sex',
		age='$age',
		edu='$edu',
		salary='$salary',
		bonus='$bonus',
		city='$city' where id='$id'";
		
		echo $sql;
		if($db->exec($sql)){
			echo "<h2> 修改学生信息成功 <h2>";
			header("refresh:3;url =./list.php");
			exit();
		}else{
			echo "<h2> 修改学生信息失败 <h2>";
		}
		
} else {
	$_SESSION["randValue"] = uniqid();

	$id = $_GET['id'];

	$sql = "SELECT * from student where id = $id";
	$row = $db->fetchOne($sql); 

	dump($row);

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改学生信息</title>
</head>
<body>
	<div class = "title" >
		<h2>修改学生信息</h2>
		<a href="javascript:history.go(-1)">返回</a>
		
	</div>	

	<form action="" method="post" name="form1">
		<table border="1" bordercolor="#CCC" rules="all" align="center" width="400">
			<tr>
				<td width="80" align = "right">姓名:</td>
				<td><input type="text" name="name" value="<?php echo $row['name']; ?>"></td>
			</tr>
			<tr>
				<td width="80" align = "right">性别:</td>
				<td><input type="radio" name="sex" value="男">男
				<input type="radio" name="sex" value="女">女</td>
			</tr>

			<tr>
				<td width="80" align = "right">年龄:</td>
				<td><input type="text" name="age"></td>
			</tr>						
			
			<tr>
				<td width="80" align = "right">学历:</td>
				<td>
					<select name="edu" id="">
						<option value="初中">初中</option>
						<option value="高中">高中</option>
						<option value="大专">大专</option>
						<option value="大本">本科</option>
						<option value="研究生">研究生</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td width="80" align = "right">工资:</td>
				<td><input type="text" name="salary" value="<?php echo $row['salary']; ?>"></td>
			</tr>
			<tr>
				<td width="80" align = "right">奖金:</td>
				<td><input type="text" name="bonus" value="<?php echo $row['bonus'] ?>"></td>
			</tr>
			<tr>
				<td width="80" align = "right">籍贯:</td>
				<td><input type="text" name="city" value="<?php echo $row['city'] ?>"></td>
			</tr>			
			
			<tr>
				<td width="80" align = "right"></td>
				<td><input type="submit" value ="提交">
				<input type="hidden" name="ac" value ="<?php echo $_SESSION['randValue']; ?>">
				<input type="hidden" name="id" value="<?php echo $id; ?>"></td>
			</tr>			
			
		</table>

	</form>
	
</body>
</html>

```

## 工厂模式
>> 什么是工厂模式

* 工厂模式,也是一种设计模式
* 工厂模式:根据传递的不同类名参数,来创建不同的类的对象,就是创建对象的工厂
* 工厂模式:创建所有类的对象,给了统一的方法

>>  工厂模式的设计要求

* 工厂模式可以是一个工厂类,就是工厂类;也可以是工厂的方法
* 工厂类中只有一个公共静态的创建不同类的对象方法
* 工厂类本身不需要创建对象
* 静态方法的代码,根据传递不同类的参数,创建不同类的对象
* **工厂模式**:适用于构造方法,不带参数的情况

>> 举例说明

```php

header("Content-type:text/html;charset=utf-8");
//(1)定义一个学生类
class Student{
	
}
//(2) 定义一个教师类
class Teacher{
	
}

//(3)创建一个工厂类,生产不同类的对象的工厂
final class Factory{
	//公共的静态的创建不同类对象的方法
	public static function getInstance($className){
		return new $className();
	}
}
	
//(4)创建学生类对象
	$stuObj = Factory::getInstance("Student");
	$stuObj1 = Factory::getInstance("Teacher");
	var_dump($stuObj);
	var_dump($stuObj1);

```

## 单例的工厂类

```php

//单例的工厂类
//(1)定义一个学生类
class Student{
	
}
//(2) 定义一个教师类
class Teacher{
	
}

//(3)创建一个工厂类,生产不同类的对象的工厂
final class Factory{
	//私有的静态属性保存对象的数组属性
	private static $obj = array();
	
	//公共的静态的创建不同类对象的方法
	public static function getInstance($className){
		//判断对应的类的对象是否存在
		if(!isset(self::$obj[$className])){
			//创建新对象,并存入数组属性中
			/*
				$obj[Student] = Student对象;
				$obj[Teacher] = Teacher对象;
				
			*/
			self::$obj[$className] = new $className;
		}
		//返回类的对象
		return self::$obj[$className];
	}
}

//(4)创建学生类和教师类对象
$stuObj = Factory::getInstance("Student");
$stuObj2 = Factory::getInstance("Teacher");
$stuObj1 = Factory::getInstance("Student");

var_dump($stuObj,$stuObj2,$stuObj1);

```

## 重载
>> 什么是重载

* PHP不支持重载,这是一种变相的说法
* **重载:指动态的修改对象的属性,或者调用对象**
* 面向对象中的重载是通过魔术方法来实现的
* ==访问不可方法的属性或者方法时,这些魔术方法就回自动调用==
* 魔术方法作用:屏蔽一些错误

>> 属性重载

> __set()

* 再给不可访问的属性赋值是会自动调用`__set()`方法
* 语法`public void __set(string $name,mixed $value)`
* 参数 `$name`属性名 `$value`属性值

```php

class Student{
	private $name = "";
	public $edu = "";
	//当给不可访问的属性赋值时 __set()自动调用
	public function __set($n,$v){
		//$n代表外部赋值操作的属性名
		//$v代表外部赋值操作的属性值
		$this->$n = $v;
	}
}

$obj = new Student();
//给私有的属性赋值
$obj->name = "旺财";
$obj->age = 24;
$obj->edu = "蓝翔";
var_dump($obj);

```

> __get()

* 读出对象中属性值


```php

class Student{
	private $name = "";
	public $edu = "";
	//当给不可访问的属性赋值时 __set()自动调用
	public function __set($n,$v){
		//$n代表外部赋值操作的属性名
		//$v代表外部赋值操作的属性值
		$this->$n = $v;
	}
	
	public function __get($n){
		//$n代表外部要获取的属性名
		return $this->$n;
	}
}

//读取私有属性的值
echo $obj->name;

```

> __isset

* 判断私有属性是否存在


```php

class Student{
	private $name = "";
	public $edu = "";
	//当给不可访问的属性赋值时 __set()自动调用
	public function __set($n,$v){
		//$n代表外部赋值操作的属性名
		//$v代表外部赋值操作的属性值
		$this->$n = $v;
	}
	
	public function __get($n){
		//$n代表外部要获取的属性名
		return $this->$n;
	}
	
	//当判断不可访问的属性时,__isset()自动调用
	public function __isset($n){
		var_dump(isset($n));
	}
}

$obj = new Student();
//给私有的属性赋值
$obj->name = "旺财";
$obj->age = 24;
$obj->edu = "蓝翔";
var_dump($obj);

//读取私有属性的值
echo $obj->name;

//判断私有属性是否存在
isset($obj->name); //bool(true)


```

> __unset()

* 删除一个不存在或私有的属性调用unset()时,会自动调用


```php
class Student{
	private $name = "";
	public $edu = "";
	//当给不可访问的属性赋值时 __set()自动调用
	public function __set($n,$v){
		//$n代表外部赋值操作的属性名
		//$v代表外部赋值操作的属性值
		$this->$n = $v;
	}
	
	public function __get($n){
		//$n代表外部要获取的属性名
		return $this->$n;
	}
	
	//当判断不可访问的属性时,__isset()自动调用
	public function __isset($n){
		var_dump(isset($n));
	}
	//删除私有属性
	public function __unset($n){
		unset($n);	
	}
}

$obj = new Student();
//给私有的属性赋值
$obj->name = "旺财";
$obj->age = 24;
$obj->edu = "蓝翔";
var_dump($obj);

//读取私有属性的值
echo $obj->name;

//判断私有属性是否存在
isset($obj->name); //bool(true)

unset($obj->name);

```

>>方法重载

>(1) __call()

* 描述: 在对象中调用不可方法我方法时 __call()会被调用
* 语法:`public mixed __call(string)`


```php


class Student{
	private function showInfo(){
		
	}
	//当访问不可访问方法
	public function __call($name,$ages){
		echo "方法{$name}".implode(",",$ages);
	}
}

$obj = new Student();
$obj->showInfo("a","b","c");

``` 

> __callStatic()

* 描述: 当用静态化方式访问不可访问方法

```php

class Student{
	private static function showInfo($a,$b,$c){
		
	}
	//当用静态化方式访问不可访问方法
	public function __callStatic($name,$ages){
		echo "方法{$name}".implode(",",$ages);
	}

}

$obj = new Student();
Student::showInfo("a","b","c");

```

## 静态延时绑定
>> 什么是静态延时绑定

![屏幕快照 2017-04-21 下午15.58.41 下午-w880](media/14927355308000/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-21%20%E4%B8%8B%E5%8D%8815.58.41%20%E4%B8%8B%E5%8D%88.png)

* `seif`总是调用当前类的东西, 包括静态属性,静态方法,成员方法,类常量
* 如果只有一个类`self`和`static`含义一样,都是调用当前类的内容
* 如果继承范围内,`self::`总是调用当前类的内容`static`调用最终类的内容(创建对象的那个类)

> 举例说明


```php

//静态延时绑定
class Student{
	const DB_HOST = "localhost";
	
	public function show(){
		echo "主机名:".self::DB_HOST;
		echo "\n主机名:".static::DB_HOST;
	}
}

$obj = new Student();
$obj->show();
//如果一个类时,self::和 static::都代表当前类,调用当前内容
//主机名:localhost
//主机名:localhost

```


```php

//静态延时绑定
class Student{
	const DB_HOST = "localhost";
	
	public function show(){
		//self只代表自己所在的类
		echo "主机名:".self::DB_HOST;
		
		//相对于static代表了BlueStudent 
		//static表示谁创建对象它就代表谁
		echo "\n主机名:".static::DB_HOST;
	}
}

class BlueStudent extends Student{
	const DB_HOST = "127.0.0.1";
}
$obj = new BlueStudent();
$obj->show(); 

//主机名:localhost
//主机名:127.0.0.1

```

![屏幕快照 2017-04-21 下午16.16.29 下午-w845](media/14927355308000/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-21%20%E4%B8%8B%E5%8D%8816.16.29%20%E4%B8%8B%E5%8D%88.png)


## 序列化
>> 什么是序列化

* 序列化:将变量转成可以保存或者可传输的字符串,不丢失结构和类型
* 反序列化,把序列化字符串,还原成原始变量
* 作用:主要用在PHP与JS 进行数据交互

>> serialize()

* 描述:产生一个可储存的值 

```php

$arr = array(
	'db_host' => 'localhost',
	'db_user' => 'root'
);
$str = serialize($arr);
echo $str;
//(2) 将序列化字符串保存到记事本
file_put_contents("./1.txt",$str);

```

>> unserialize()

* 描述: 从已经存储的表示中创建PHP的值
* 语法: `mixed unserialize()`

```php
//从文件中读出数据反序列化
$str = file_get_contents("./1.txt");
$arr = unserialize($str);
var_dump($arr);

```

## 对象序列化和反序列化
* 对象序列化的数组变量一样
* 的对象序列化时,`__sleep()`会自动调用,做些清理工作
* 当对象反序列化时,`__wakeup()`会自动调用,当对象就绪时,做一些初始化工作

> 对象序列化 

```php
//(1) 对象序列化 将对象变量保存到记事本
class Db{
	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	
	public function __construct($config = array()){
		$this->db_host = $config['db_host'];
		$this->db_user = $config['db_user'];
		$this->db_pass = $config['db_pass'];
		$this->db_name = $config['db_name'];
	}
	
	//当对象序列化时,自动调用__sleep
	public function __sleep(){
		//返回保留的对象属性,没有列出的不进行序列化
		return array("db_pass","db_user");
	}
}

$arr = array(
	'db_host' => 'localhost',
	'db_user' => 'root',
	'db_pass' => '12345',
	'db_name' => 'itcast'
); 

$db = new Db($arr);
$str = serialize($db);
echo $str;
//将对象序列化存到记事本
file_put_contents("./2.txt",$str);

```

> 对象反序列化

```php

//(1) 对象序列化 将对象变量保存到记事本
class Db{
	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	
	public function __construct($config = array()){
		$this->db_host = $config['db_host'];
		$this->db_user = $config['db_user'];
		$this->db_pass = $config['db_pass'];
		$this->db_name = $config['db_name'];
	}
	
	//当对象序列化时,自动调用__sleep
	public function __sleep(){
		//返回保留的对象属性,没有列出的不进行序列化
		return array("db_pass","db_user");
	}
	
	//当对象反序列化时会自动调用__wakeup
	public function __wakeup(){
		$this->name = "itcast";
		$this->host = "localhost";
		echo "连接数据库";
		//$this->connMySQL();
	}
}


//对象的反序列化 将对象从字符串还原
$str = file_get_contents("./2.txt");
$obj = unserialize($str);
var_dump($obj

```

## 类型约束
> 类型约束的简介

* java是强类型语言,从执行开始到结束,变量的类型不能改变
* PHP是弱类型语言,在脚本执行过程中,变量类型随时可定改变
* PHP类型约束,只限于函数参数或者方法参数
* 可以限制的数据类型包括 数组 函数 对象


```php

function abc($a,array $b,Student $c,Inter1 $d){
	//$a参数没有类型限制
	//$b参数要求必须是数组
	//$c参数要求必须是Student的对象
	//$d参数要求必须是Inter1接口的对象 Inter1接口名字
}

$arr =  array();
interface Inter1{}
class Student implements Inter1{}
$obj = new Student();
abc(100,$arr,$obj,$obj);

```

## 常用的魔术常量

```php

class Student{
	public static function getInstance(){
		$className = __CLASS__; 
		return new $className;  //可变类
	}
	
	public function showInfo(){
		echo "当前行号".__LINE__;
		echo "\n当前文件".__FILE__;
		echo "\n当前目录".__DIR__;
		echo "\n当前类名".__CLASS__;
		echo "\n当前方法名".__METHOD__;
		echo "\n当前函数名".__FUNCTION__;
	}
}
//用静态化方式创建对象
$obj = Student::getInstance();
$obj->showInfo();

```

## 常用类的对象的操作函数
> 判断类 接口 方法 属性 是否存在

* class_exists();
* interface_exists();
* method_exists();


## 获取类名
* 返回对象的类名 get_class();
* 返回对象的父类类名 get_parent_class();

```php

class Student{}
class BlueStudent extends Student{}
$obj = new BlueStudent();
echo "当前类".get_class($obj);
echo "\n父类是".get_parent_class($obj);

```




