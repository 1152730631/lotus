# PHP_面向对象_Day_06_{类创建}_{成员属性方法}_{静态}_{this}_{self}_{构造方法}_{析构方法}
![PHP_典型应用_Day_06](media/14923901014634/PHP_%E5%85%B8%E5%9E%8B%E5%BA%94%E7%94%A8_Day_06.png)

[TOC]

## 面向过程与面向对象
* 面向过程(Procedure Oriented): 以过程为中心的编程思想
* 面向对象(Object Oriented):以事务为中心的编程思想

****

## 类与对象
### 类的概念
* 类就是类别,分类,理论,概念,无形的东西
* 类是由相同属性(特征)和方法(行为,动作)的对象构成一个集合
* 例: 类相当于于图纸,对象相当于房子

****

### 对象的概念
* 每一个实体,都可以是一个对象
* 在计算机中,先有类,在有对象;在现实中,先有对象,再有类

****

### 类的定义

```php

class Classname{
	$attr1 = "";
	$attr2 = "";

	function method1(){

	}

	function method2(){

	}	

}

```

* Class声明类的关键字,关键字不区分大小写
* ClassName 类名,类名的命名规则与普通变量相似

> 例 定义一个学生类

```php

header("content-type:text/html;charset=utf-8");
class Student{
	public $name = "张三";
	public $age = 24;

	public function info(){
		echo "{$this->name} 的年龄是{$this->age}岁";
	}
}

$obj = new Student();
$obj->info();

```

****

###定义类的成员属性
* 类的成员就是各种对象; 
* 成员属性,与普通变量相似
* ==成员属性,必须要加权限控制符,而普通变量没有==

> 定义格式

```php
//定义成员属性的语法格式
//成员属性可以没有默认值
权限控制符 变量名 = 变量值

```

> 访问修饰符号

* public(公共) 
* private(私有) 本类中访问
* protected(受到保护的) 只能在本类和子类中

****

### 定义类的成员方法
> 成员方法介绍

* 成员方法就是对象的方法,不是类的方法
* 成员方法可以加权限控制符号 默认是public,但普通函数不带权限控制符 

> 成员方法的定义格式


```php
权限控制符号 function funcName(形参1,形参2..){
    //TODO方法的功能代码
    return 参数;
}
```

****

### 创建类的实例对象
> 实例对象的含义

* JS中创建对象`var tedey = new Date()`;
* PHP中创建对象`$obj = new Student()`;
* 使用`new`关键字创建对象,先有类后又对象,对象一定是某个类上创建的 一个类可以产生N多个对象
* 类的实例就是对象

> 使用格式

```php
//如果没有有参数传递可以省略括号
$obj = new ClassName(实参...);
$obj = new ClassName;
```

> 例: 实例化学生类

![屏幕快照 2017-04-17 下午18.48.55 下午-w608](media/14923901014634/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-17%20%E4%B8%8B%E5%8D%8818.48.55%20%E4%B8%8B%E5%8D%88.png)


****

### 访问对象的属性和方法

> ① 访问对象的属性和方法

* 在JS中访问对象的属性和方法,使用点`arrObj.length`
* 在PHP中访问对象的属性和方法,使用`->`操作符`$obj->name,$obj->showinfo()`

> ② 对象属性的操作 增删改查

```php

//(1) 修改属性 给成员属性赋值
//调用成员属性不能带$符号
$obj->name = "旺财";

//(2) 添加属性 给不存在的属性赋值
// 添加的属性的当前对象独有的 其他对象不具备当前属性
$obj->edu = "本科";

//(3) 删除对象属性
unset($obj->edu);

//(4) 读取属性
echo "$obj->name";

```

> ③ 对象方法的操作 调用 传递参数 返回值 
![屏幕快照 2017-04-17 下午18.49.59 下午-w607](media/14923901014634/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-17%20%E4%B8%8B%E5%8D%8818.49.59%20%E4%B8%8B%E5%8D%88.png)



### 伪变量$this的使用
* 在JS中 this 代表当前对象如: this.src = "";
* 在PHP中 `$this`代表当前对象 如:`$this->name = "张三"`
* `$this`代表当前对象 ,没有对象,就没有`$this`
* `$this` 只能调用对象的属性和方法
* ==`$this` 只能在成员方法中使用,在其他区域都不能使用==

![屏幕快照 2017-04-17 下午18.50.34 下午](media/14923901014634/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-17%20%E4%B8%8B%E5%8D%8818.50.34%20%E4%B8%8B%E5%8D%88.png)

![屏幕快照 2017-04-17 下午18.51.30 下午](media/14923901014634/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-17%20%E4%B8%8B%E5%8D%8818.51.30%20%E4%B8%8B%E5%8D%88.png)

****

## 定义常量
> 常量介绍

* 常量,就是值永远不变的量,常量不能修改也不能删除
* ==类常量,与类相关,与对象无关,简单说:不能用对象调用==
* 一个类只有一份常量,不管创建多少个对象,常量只有一份,可以被所有对象共享
* 使用常量的好处:可以极大的节省内存
* 类常量的调用 通过类名+'::' 来调用如`Student::HOST`
* `::`成为范围解析符号,或者 静态调用方式
* 类的内容都是使用`::`调用 对象的东西都使用`->`调用
* 调用类常量,不用创建对象,就可以调用类常量
* ==注意:类常量没有权限控制符==

> 类常量定义格式

```
const 常量名称 = 常量值;

```

> 访问常量的语法

```php

类名::常量名称
Student::HOST
```

> Const关键字 和 define()函数的区别

* Define()定义的常量为全局常量,任何地方都可以使用
* const 定义的常量只能在定义的范围内来使用,如果在类中定义,只能在类中使用;
* 如果在类外定义,也称为全局常量
* Define()不区分大小写 Const区分大小写

![屏幕快照 2017-04-17 下午18.52.06 下午-w554](media/14923901014634/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-17%20%E4%B8%8B%E5%8D%8818.52.06%20%E4%B8%8B%E5%8D%88.png)


****

## 静态属性和静态方法
> 概念


* static 修饰的属性就的静态属性,修饰的方法就是静态方法
* ==静态属性和静态方法,是与类相关的,与对象无关==
* 静态属性和静态方法,在内存中只有一份,不管创建多少对象,永远只有一份
* 极大的节省了内存,是所有对象共享的内容,并且该内容可变
* 例如:在线人数,所有在线的用户都可见,但值是不断的变化的
* 静态属性和静态方法的访问`Classname::静态属性|静态方法`
* 静态属性和方法的调用和对象无关,通过类名调用

> 格式

```php

//(1)静态属性的定义语法
	权限控制符 static 属性名 = 属性值;
	
	//(2)静态方法的定义语法
	权限控制符 static function funcName(){
		
	}

```

> 静态属性和静态方法的调用

![屏幕快照 2017-04-17 下午16.23.45 下午-w867](media/14923901014634/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-04-17%20%E4%B8%8B%E5%8D%8816.23.45%20%E4%B8%8B%E5%8D%88.png)


> 例 调用静态变量和静态方法

```php

class Student{
		//静态属性(类的属性)
		public static $db_host = "localhost";
		public static $db_user = "root";
		public static $db_pass = "12345";
		//静态方法显示一条线
		private static function showline(){
			return "--------------\n";
		}
		//静态方法
		public static function showinfo(){
			$str = "数据配置信息\n";
			$str .= Student::showline();
			$str .= "主机名: ".Student::$db_host; 
			echo $str;
		}
		
	}
	//静态方法调用类的成员
	Student::showinfo();

```

-------

###可以指定多个修饰符
* 静态属性和方法或者成员属性和方法都可以指定多个修饰符,但是==多个修饰符之间没有先后顺序==

-------

## self关键字
* `$this`代表当前对象,self代表当前类
* `$this` 可以调用对象的属性和方法
* `self`调用类的属性和方法: 静态属性,静态方法,类常量
* ==`$this` 只能用在成员方法中 self 可以用在成员方法和静态方法==

> 例 self的使用

```php
class Student{
		const TITLE = "数据配置信息\n";
		//静态属性(类的属性)
		public static $db_host = "localhost";
		public static $db_user = "root";
		public static $db_pass = "12345";
		//静态方法显示一条线
		private static function showline(){
			return "--------------\n";
		}
		//静态方法
		public function showinfo(){
			$str = self::TITLE;
			$str .= self::showline();
			$str .= "主机名: ".self::$db_host; 
			$str .= "\n用户名".self::$db_user;
			echo $str;
		}
		
	}
	
	$obj = new Student;
	$obj->showinfo();	
```

-------

## 构造方法
> 构造方法的概念

* 当创建对象是时,第一个自动调用的方法,就是构造方法
* 构造方法一般是自动调用,也可以手动调用
* 作用: 对象初始化 对象属性赋值,连通数据库等
* 构造方法的名称是固定的:`__construct(形参...)`
* 构造方法中不能使用return语句,返回一个值
* 构造方法必须是成员方法,不能是静方法

> 语法格式

```php
//构造方法的格式
		权限控制符 function __construct(){
			
		}	
```

> 例: 通构造方法传递参数

```php

//定义一个学生类
	class Student{
		//私有的成员属性
		private $name;
		private $age;
		
		public function __construct($name,$age){
			$this->name = $name;
			$this->age = $age;
		}
		
		//公共的成员方法
		public function showinfo(){
			echo "{$this->name}的年龄是{$this->age}岁";
		}
	}
	//(2) 创建学生类对象
	$obj = new Student("旺财","24");	
	$obj->showinfo();

```

# -------

# 析构方法
> 什么是析构方法

* ==当一个对象销毁**前**,自动调用的方法,就是析构方法==
* 析构方法的作用:做一些额外的工作比如:垃圾回收,断开数据库连接 关闭文件夹 关闭图片资源
* 析构方法的名称:`__destruct(void)`
* 析构方法没有参数 一定是成员方法 权限必须是public

> 语法格式: 

```php

	//析构方法的语法
	public function __destruct(){
		//
	}

```

> 例: 对象什么时候销毁

* 使用`unset()`手动删除对象变量
* 网页执行完毕对象销毁
* 函数执行完毕对象自动销毁


```php

class Student{
		public function __destruct(){
			echo "②对象即将删除";
		}
	}
	
	$obj = new Student();
	unset($obj);
	echo "①这是网页最后一行代码\n";

```

> 例: 模拟统计在线人数


```php

class Student{
		//私有的静态属性,保存在线人数
		private static $count = 0;
		//构造方法
		public function __construct(){
			self::$count++; 
		}

		public function getCount(){
			return self::$count; 
		}

		//析构方法
		public function __destruct(){
			self::$count--;
		}

	}
	$obj1 =  new Student;
	$obj2 = new Student;
	$obj3 = new Student;
	$obj4 = new Student;
	$obj5 = new Student;
	$obj = new Student;
	echo "当前在线人数".$obj->getCount();

```



 










