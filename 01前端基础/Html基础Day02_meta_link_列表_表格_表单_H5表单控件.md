# Html基础Day02_meta_link_列表_表格_表单_H5表单控件
![Html基础Day02](media/14903668755486/Html%E5%9F%BA%E7%A1%80Day02.png)

[TOC]

##meta标签
###meta标签用法
####设置编码集

```//
<head>
	<meta charset="UTF-8">
</head>
```

* 属性： **charset** 设置界面编码集 （如： UTF-8 GBK GB2312 BIG5 ）  

-------

####设置网页关键字

```//
<meta name="keywords" content = "女装，男装">
``` 
* 注意： 该标签中的**关键字**不是给用户看的，给**搜索引擎**提供的

####设置网页描述信息

```//
<meta name="description" content = "描述信息">
```
* 注意： 该标签中的关键字不是给用户看的，给搜索引擎提供的

-------

####网址重定向
```//
<meta http-equiv="refresh" content = "3；http://www.baidu.com">
```

-------

##Link标签
####设置网页图标

```//
<link rel="icon" href="favicon.ico">
```
注意：最好将图片放到网页根目录下

-------

####设置引用外部样式表

```//
<link rel="stylesheet" href="1.css">
```

-------

##列表
#### 无序列表 

```
<ul>
    <li>列表项</li>
</ul>

```

* 无序列表li标签中可以包含**任何**标签
* ul属性 **type** 属性值 **squier** **square** ...

-------

####有序列表

```
<ol>
    <li>列表项</li>
</ol>
```

* ol属性 **type** 属性值 A
* 无序列表li标签中可以包含**任何**标签
* 一般情况下使用无序列表 应用场景如：排行榜

-------

####自定义列表

```
<dl>
<dt>标题</dt> 
<dd>列表项</dd>
</dl>
```

* 注意： **dt**标签中只能包含**行内元素**（如：span a）
* 注意： **dd**标签中可以包含**所有元素**
* 应用场景：京东网站页脚 服务列表 一般网页结尾处

-------

##表格
###1 组成
* 行 **tr**
* 列 **td**
* 表格 **table**
* 行与列是**嵌套关系** **行中包含列**


```//
<table>
    <tr>
        <td>姓名</td>
         <td>年龄</td>
    </tr>
    
    <tr>
         <td>name</td>
         <td>age</td>
    </tr>
</table>

```

-------

###2 作用
* 用于显示数据
* 网页布局（在没有div+css之前使用表格进行网站布局）

-------

###3 table属性
    
属性| 说明 | 属性值
---- | ---- | -----
**border** |  设置边框 | int 
 **width**  | 设置宽度 | 
 **height**  | 设置高度 
 **cellspacing** | 设置td与td直接的间距 | 默认值2 
 **cellpadding** | 设置单元格内容与td标签 左侧间距
 **align** | 设置table对齐方式  | left（左侧）  center（中央） rigth（右侧）  
 **bgcolor** | 设置表格背景颜色 
 
 
 * **align**       作用：设置table对齐方式 
    * 注意：如果给table标签设置 设置table表对于界面的对齐方式 
    * 给tr或者td设置align属性 为单元格内容设置对齐方式

-------

###4 表格中的标签
* **th**  设置表头 
* 一个table **只有一个th** 保证语义性 用法与td一样
* 设置表头方式 可以用**td且内容居中**

```//
<table>
    <tr>
        <th>姓名</th>
         <th>年龄</th>
    </tr>
    
    <tr>
         <td>name</td>
         <td>age</td>
    </tr>
</table>
```
* **caption** 设置表格标题

```//
<table>
    <caption>人员表</caption>
    <tr>
        <th>姓名</th>
         <th>年龄</th>
    </tr>
    
    <tr>
         <td>name</td>
         <td>age</td>
    </tr>
</table>
```

-------

###5 表格结构介绍
```//
* emmet 表格生成语法 
* table[border = "1" ...]>tr*4>td*4 + tab
```

* **thead标签** 包含一个tr和td
* **tbody标签** 可以包含tr和td
* **tfoot标签** 包含一个tr和td
    * 注意该结构已过时

-------

###6 合并单元格
* td标签属性 **colspan** **横向**合并


```//
<td colspan = "2"></td>
<!-- <td></td> -->
注意要将多出的列删除掉 合并几列属性值写几 
```    
    
* td标签属性**rowspan** **纵向**合并 

```//
<td rowspan = "2"></td>
注意要将多出的td删除掉 合并几行属性值写几 
```

-------

##表单
* 作用：收集用户信息
* 组成：提示信息 表单控件 表单域 
 
-------
 
###表单域 form


```//
<form action="1.php" method="get">
    用户名： <input type="text" name="username">
    <br>
    密码：<input type ="password" name="pwd">
    <input type = "submit">
</form>
```

    属性 |说明 | 属性值
    ----| ------ | ----
    **action** | 设置处理数据的后台程序
    **method** | 设置提交数据给后台数据的方式 | get  或者 post
    
-------

###表单控件 
####文本与密码输入框input type=text 或 type=password
```//
<form action="1.php" method="get">
    用户名： <input type="text" name="username">
    <br>
    密码：<input type ="password" name="pwd">
    <input type = "submit">
</form>
```
 
属性 | 说明 | 属性值 
----|-----|-----
**maxlength** | 限制输入的最大长度 | int
**readonly** | 设置控件为只读（不可输入）| readonly
 **disabled** | 禁止用户输入 | disabled 
 **value** | 设置默认值 | "默认值"
 **name** | 设置控件名称 | "username" 
 **id** | 控制编号 | "user" 
 **type** | 设置输入文本类型| **password**：密码输入框 **text**：文本输入框
  
-------

####单选框input type="radio"

```//
<form action="1.php" method="get">
    男 <input type="radio" name="gerder" value="1">
    女 <input type ="radio" name="gerder"
    value="0">
    <input type = "submit">
</form>
```

* *注意：该控件实现单选效果要设置统一的name名称*
* 属性 **checked**=checked：设置控件**默认选中项**（最后一个设置checked的控件选中）
* 属性 **value**="0"：设置提交到后台的数据 

-------

####下拉列表 select

```//
籍贯：<select multiple="multiple">
        <option value="hb" selected>河北</option>
        <option value="hn">河南</option>
    </select>
```

* option属性 **selected**：设置默认选中项
* select属性 **multiple**：设置多选效果

* 其他写法

```//
    <select>
       <optgroup label="河北省">
            <option>张家口</option>
            <option>保定</option>
       </optgroup>
    </select>    
```

-------

####多选控件 input type="checkbox"

```//
    爱好：
    <input type="checkbox" checked>看书
    <input type="checkbox">学习
```

* 属性 **checked** ：设置**默认选中项**
 
-------

####资源上传控件 input type="file"

```//
请上传头像
 <input type="file" name="file">
```

-------

####多行文本域 textarea

```//
    文本域：
    <textarea>    
    </textarea>
```

-------

####隐藏控件 input type="hidden"

```//
<input type="hidden" value="123">
```

-------

####普通按钮 input type="button"

```//
<input type="button" value="按钮">
```

* 不可用于提交表单

-------

####提交按钮 input type="submit"

```//
<input type="submit" >
```

* 用于提交**表单数据**

-------

####重置按钮 input type="reset" 

```//
<input type="reset" >
```

* 用于将**数据恢复默认值**

####图片提交按钮 type="image

```//
<input type="image" src="1.jpg">
```

* 用于提交表单数据和图片


-------

#### 分组控件 （fieldset） 和 标题（legend）

```//
<form>
    <fieldset>
        <legend> 标题 </legend>
    </fieldset>
</from>
```

* **fieldset**用于定义**表单区域** 
* **legend**当前组**标题**

-------

##标签语义化（了解）
* 概念： 根据内容的结构化，选择合适的标签
* 含义： 
    * 网页结构合理
    * 有利于seo
    * 方面其他设备解析
    * 方便团队开发和维护   
* 注意事项
    * 少用无语义标签，尽量使用有语义的标签
    * 不要使用纯样式标签 样式使用css设置（如：font b u 等） 
    
-------

##Emmet语法
####嵌套运算符

```//
div>ul>li + tab

<div>
    <ul>
        <li></li>
    </ul>
</div>
```

-------

####兄弟关系


```//
div+p+ul>li  tab

<div></div>
<p></p>
<ul>
    <li></li>
</ul>
```

-------

####重复

```//
ul>li*10
```

-------

####分组

```//
```

-------

####自定义属性

```//
table[border="1" width] + tab
```

####编号
```//
div{$}*10
```

-------

##H5表单控件（补充）
###输入类型

```//
邮箱： <input type = "email" name = "em">只能输入邮箱 自动效验
数字：<input type = "number" name = "nb" step = "5">只能输入数字 step属性代表步长 
网址： <input type = "url">
时间： <input type = "time">
日期： <input type = "date">
时间日期： <input type = "datetime">
周： <input type = "week">
取色器： <input type = "color">
滑块 <input type = "range" value = "0">
搜索 <input type = "search">（无效果语义性）
手机号 <input type = "tel"> （移动端有效）

```

-------

###其他标签

```//
<input type="text" list="dt">
<datalist id="dt">
    <option value="bj">北京</option>
    <option>上海</option>
</datalist>
```

###标签属性
* **placeholder** 占位符

```//
<input type="text" placeholder="北京" >
placeholder 占位符
```

* **autofocus** 自动获取焦点

```//
<input type="text" autofocus="北京" >
autofocus 自动获取焦点
```

* **autocomplete** 自动完成 （off关闭 no开启 默认开启）

```//
<form>
    <input type="text" autocomplete="off" >
    <input type="submit">
</form>
```
* **required** 必须填写

```//
<form>
    <input type="text" required >
    <input type="submit">
</form>
```

-------

    


 






