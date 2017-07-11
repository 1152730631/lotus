# JavaScript基础Day02_Math对象_数据类型转换_逻辑运算符_等号逗号运算符_分支结构_条件表达式

[TOC]

## Math 对象
方法 | 说明 
----|----
abs(x) | 绝对值  
ceil(x) | 向上取整(天花板函数)
floor(x) | 向下取整(地板函数)
round(x) | 四舍五入值
max(x,y) | 返回x 和 y 中的最大值
min(x,y) | 返回x 和 y 中的最小值
pow(x,y) | 返回x 的 y 次幂
random() | 返回 0-1 之间的随机数 没有0和1

###写法

```JavaScript
  var n1 = Math.ceil(2.333) //向上取整
```

##数据类型转换
###隐式转换
* 程序在参与运算的过程中 发送的数据类型转换

###显示转换(强制转换)
* 指定的具体数据类型

####转换String

方法名 | 说明  | 返回值
----- | ----- | -----
变量.toString() | 将数字类型转换为字符串类型 | string
String(x) | 直接转换为字符串类型 | string

------

####转换Namber
方法名 | 说明  | 返回值
----- | ----- | -----
Number(x) | 通过Number的构造转换数字类型保留原值  | Number 如果传入字母值为NaN 
parseInt(x) | 转换为整数 取整效果 按照每一位数进行转换的 | int Number 只保留数字部分
parseFloat(x) | 转换为浮点型 按照每一位数进行转换的 | float Number 只保留数字部分

------

####转换Boolean
 方法名 | 说明  | 返回值
----- | ----- | -----
Boolean(x) | 转换布尔类型 | 传0 空字符 null undefined NaN  为false

------

###案例
* 输入一个三位数 求处三个位数的和


```JavaScript
    /*方式1*/
    var n1 = prompt("输入3位数");
		var n2 = parseInt(n1/100);
		var n3 = parseInt((n1 - n2*100) / 10);
		var n4 = parseInt((n1 - n2*100 -n3*10));

		alert(n2 + n3 + n4);

```

```JavaScript
    /*方式2*/
    var bw = Math.floor(n1/100);
	  var sw = Math.floor(n1%100/10);
	  var gw = n1%10;
```

##逻辑运算符
* 或运算     || 遇true则true 
* 与(且)运算 && 遇fales则false
* 非运算 !   遇false为true  遇true为false

##等号逗号运算符
符号 | 说明
---  | ----
 =   |  赋值
 ==  |  相等  只判断值 不判断数据类型 
 === |  全等  同时比较值和数据类型
 !=  | 不相等
 
###逗号运算符

```JavaScript
    var n1 = 1, n2 = 2, n3 = 3;
``` 

##分支结构(条件判断) 条件结构嵌套

```JavaScript 
    if (条件表达式) {
        
    } if else(条件表达式) {
    
    }
```

##条件表达式

```JavaScript

条件表达式 ? 代码1 : 代码2;

```





 

