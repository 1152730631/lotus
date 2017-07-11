# JavaScript基础Day03_switch_变量的自增自减_算数优先级_循环_break_continue_数值_函数

[TOC]

##switch 语法结构

```switch(变量){
        case值1:
            /*执行语句*/ 
            break;
        case值2:  
            /*执行语句*/  
            break;
        default:
            /*执行语句*/
            break;    
   }
```

* 注意: switch 中的变量数据类型必须与 case值的数据类型保持一致
* 一般情况下如果变量表示的不是一个范围,而是一些具体值,可以考虑使用switch结构
* case 后面的值可以同时设置多个(利用穿透效果)
* 每一段代码块结束后 必须加break;

##变量的自增自减
* 变量自增或者自减 每次增1或者减1
* ++i 如果运算符(++ --) 放在操作数的**前面**则是**先自增或者自减**,**再进行其他运算**
* i++ 如果运算符(++ --) 放在操作数的**后面**则是,**先进行其他运算**,**在自增或者自减**

##算数优先级

```txt
()

++ --

* / + -

比较运算

逻辑运算

```

##循环
### while循环

```//

 定义变量
 
 while(循环条件) {
    /*循环体代码*/
    /*变量增减*/
 }

```

### do while循环

```//

初始化变量

do {
    /*循环体*/
}while(循环条件);

```

* 条件不成立时 无条件先执行循环体一次

### for循环

```//

for (初始化表达式; 循环条件; 操作表达式;){
    /*循环体*/
}

```

* 执行顺序 


```//
for (① ; ② ; ④) {
    ③/*循环体*/
}
```

1. 变量初始化①
2. 表达式判断② 如果成立 然后执行③ 再进行变量自增或者自减④


##Break语句 continue 语句
* 在循环中使用break 语句,程序会跳出**当前**循环
* 在循环中使用continue 语句,程序会结束本次循环进入到下次循环中 当程序执行完continue 语句时后面的代码不会执行

##数组
* 数组一次可以保存多个值

### 定义数组

```Javascript
/*通过对象创建数组*/
var a = new Array();
```   

```Javascript
/*直接创建一个数组 不用规定数据类型*/
var a = []; 
```

###数组的符值

```Javascript
    var ary = [1,2,3,4,"ad",true]
```

```Javascript
    /*通过索引下标赋值 索引号从0开始*/
    var a = [];
    
    //通过索引赋值
    a[0] = 123;
    a[1] = "abc";
    a[2] = true; 

```

###数组的遍历
数组**属性**: **length**



```Javascript

for (var i = a.length - 1; i >= 0; i--) {
		console.log(a[i]);
	}


```

### 数组的增删改查

```Javascript

arr.push("e");//向数组追加数据
arr.splice(1,1);//通过索引位置删除项目
arr[1] = "ccc"; //修改原始
arr[2] //根据角标进行查询

```

### 数组常用方法

```Javascript

arr.reverse() //反转数组
arr.join('-')    //数组打印

```



###数组中的方法

* 数组合并

```Javascript

    /*数组合并*/
    /*通过该方法返回的是一个新数组*/
    var ary3 = ary1.concat(ary2);
```

* 数组打印

```Javascript
/*通过该方法返回的是一个string*/
var ary=[2,3,4,5];
ary = ary.join("|");

``` 

### 字符串中的函数

```Javascript

        var username = "abcdef";
        var str = new String("abc");

        //将当期字符串转换为大写
        username.toUpperCase();
        //将当期字符串转换为小写
        username.toLowerCase();

        //截取字符串
        //从索引为1的开始 截取索引值小于3的字符串
        console.log(username.substr('1', "3"));

        //分割字符串
        console.log(username.split("c"));

        //拼接字符串
        str.concat(username);

        //翻转字符串
        function reverString(username){
            var arr = username.split("");
            arr.reverse();
            return arr.join("");
        }
        //console.log(reverString(username));


        //判断当前字符串当中是否包含指定的字符串
        function containsString(str,substr){
            //indexOf() 方法可返回某个指定的字符串值在字符串中首次出现的位置。
            if(str.indexOf(substr) >= 0){
                return true;
            }else{
                return false;
            }
        }
        //去除空格
        username.trim();

```

##函数

```//
//创建方法
function 方法名 () {

}

//方法调用
方法名();

```


### 函数的概念和应用

```js

 <script>
        //函数的概念和作用
        /**
         * 具有一定功能的可以重复执行的代码块
         */

        function fn(){
            alert("www");
        }
        //函数调用的时间人机交互
        //js里面的函数都是基于事件驱动
        //触发一个事件,执行一个函数,调用函数里面的代码,
        //实现具体的业务
        fn();
    </script>
</head>
<body>
<!-- onclick监听,用户行为,点击这样的一个行为 -->
<input type="button" value="按钮" onclick="fn()">
</body>

```

### 函数的定义方式

```js

 /**
         * 函数定义有三种方式
         */
        function fn1(){

        }

        //第二种方式 函数表达式
        var foo = function(a,b){
            console.log(a+b);
        }

        //第三中方式,通过构造去产生一个新的函数
        var foo1 = new Function("a","b","return a+b");

        console.log(foo("a", "b"));
        console.log(foo1("aa", "bb"));

```

### 函数参数

```js

       /**
         * 参数.形参
         * @param a
         * @param b
         */
        function fn(a,b,c){
            console.log(a);
            console.log(b);
            c();
        }
        /**
         * 实参
         * Js里面函数的调用,只需要方法名就可以调用到该方法
         * 和参数的个数,类型没有任何关系
         * 参数可以是任意类型
         */

        var foo = function(){
            console.log("调用foo");
        }
        fn(11,['aa','bb'],foo);

```

### 函数返回值

```js

//函数的返回值
        function fn(){

        }
        console.log(fn()); //默认返回值是undefined

        //去返回内容 我们使用return关键字
        //返回值可以是任意类型
        /**
         * 返回数组
         * @returns {string[]}
         */
        function fn1(){
            return ['a','b','c']
        }
        console.log(fn1());

        /**
         * 返回函数
         * @returns {Function}
         */
        function fn2(){
            return function(){
                return "返回测试";
            }
        }
        //调用返回的函数
        console.log(fn2()());

        /**
         * 可以结束当前函数,我们return之后,当前代码就不执行了
         * 不加返回值的return 一般用来结束函数
         */
        function fn3(){
            return;
        }
        console.log(fn3());//返回默认值 undefined

```

### 关闭窗口的案例

```js

    //函数小案例
        function closeWin(){
            //弹出确认提示框
            var flog = window.confirm("您确定要退出吗?");
            if(flog){
                window.close();
            }
        }

    </script>
    <style>
        div{
            width: 200px;
            border: 1px solid #ccc;
            line-height: 30px;
            float: right;
            text-align: center;
        }
    </style>
</head>
<body>
    <div onclick="closeWin()">退出系统</div>

</body>

```

### js中函数同名问题

```js

 function fn(a,b){
            return a+b;
        }

        //因为当前函数名跟上面的函数名相同
        //就会直接把上边的方法覆盖掉
        //Js 中在同一个作用域中不能同名的
        //在开发的过程中,系统非常庞大,多人开发功能
        //编写函数,会有命名冲突问题
        //怎么解决同名问题,命名空间,面向对象编程
        function fn(a,b,c){
            return a+b+c;
        }

        console.log(fn(1, 2));//结果 NaN
        console.log(fn(1, 2, 3)); // 6

```

### js中没有快级作用域

```js

//js的代码块
        {
            var a = "aaaaa";
            console.log(a);
        }
        //js里面没有快级作用域的概念,所以可以访问到
        console.log(a);

        for(var i = 0;i<5; i++){
            var a = "cc";
        }
        
        //函数域 局部域中的变量无法访问
        function fn(){
            var a = "aa";
        }

```

### 匿名函数和自调函数

```js

//匿名函数是没有名字的函数
       //定义了匿名函数的作用,没有变量名,就不好污染全局域
       //没有名字,节省了命名空间

       //当前这个函数,自己调用
       (function(){
           console.log("www");
       })()

       //自调用函数可以用来做页面初始化,一次性的任务
       //当前这个函数,自己调用
       (function(window){
           console.log(window);
       })(window) //传入成员变量

```

### arguments的使用


```js

//arguments 参数
        function fn1(){
            //arguments 是函数fn的属性,
            //代表的是调用时传入的参数
            //Arguments { 0: 1, 1: 2, 2: 3, 3: 4, 等 2 项… }
            console.log(arguments);
        }
        //fn1(1,2,3,4);


        function fn2(){
            //arguments 是函数fn的属性,
            //代表的是调用时传入的参数
            //不写形参 也可以获取传入的实参
            console.log(arguments[0]); //1
            console.log(arguments[1]); //2
            console.log(arguments[2]); //3
            console.log(arguments[3]); //4
        }
        //fn2(1,2,3,4);

        function fn3(){
            cont = 0;
            for(var i = 0; i < arguments.length ;i++){
                cont = cont + arguments[i];
            }
            return cont;
        }
        console.log(fn3(1, 2, 3, 4));

```

### 回调函数

```js

function fn(a,b){
            return a() + b();
        }

        var one = function(){
            return 1;
        }

        var two = function(){
            return 2;
        }

        console.log(fn(one, two));

        //将一个函数作为参数传递,作为参数传递的函数
        //就是回调函数

        /**
         * 匿名回调函数
         * 将一个匿名函数作为参数传递,参数中的函数
         * 就是匿名回调函数
         */
        //作用将一个方法的调用,作为方法委托给了另外一个函数
        var value = fn(
                function(){return 1;},
                function(){return 2;}
        );
        console.log(value);

```


```js

        /**
         * 实现一个功能,将具体的功能,传入方法实现
         * @param a
         * @param b
         * @param fn
         * @returns {number}
         */

        function fn1(a,b,fn){
            //实现 a+b * 10
            //实现 a-b * 10
            //实现 a*b * 10
            //实现 a/b * 10
            return fn(a,b) * 10;
        }

        var value1 = fn1(10, 5,function(a,b){
            return a+b;
        });

        var value2 = fn1(10,5,function(a,b){
            return a-b;
        });

        var value3 = fn1(10,5,function(a,b){
            return a*b;
        });

        var value4 = fn1(10,5,function(a,b){
            return a/b;
        });

        console.log(value1);
        console.log(value2);
        console.log(value3);
        console.log(value4);

```

### 函数递归

```js

        /**
         * 函数内部调用函数自己本身
         * 递归,必须要有出口
         */

        function fn(num){
            if(num == 1){
                console.log("递归结束==" + num);
                return 1;
            }else{
                console.log("递归前==" + num);
                var ret = fn(num-1)*num
                return ret;
            }
        }

        var resule = fn(5);
        console.log(resule);

```

### js域解析

```js

/**
         * 什么是js的预解析
         * js 在运行时候分为两个阶段
         *
         * 1:预解析阶段
         * 把所有通过var 定义的变量,或者function 定义的函数先预先声明
         *
         * 2:运行阶段
         * 预解析阶段,function的优先级高于var定义变量
         */

        console.log(a);//输出 function a(){ }


        var a = 123;

        function a(){

        }
        /**
         * JS 语法 ECMAScript
         */
        //ECMAScript6 简称 es6

```









