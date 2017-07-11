# CSS基础Day04_标准流_浮动_清除浮动_CSS样式化_overflow介绍_伪元素

[TOC]

## 标准流（normal flow）
* 标准流概念：在界面中标签（元素）默认的显示方式就是标准流的显示方式

------

##浮动
###用法

```*
    float:left | right;
```

###特点 
* 浮动的元素**不占位置**（脱标 ： 脱离了标准流的显示方式）
* 浮动**可以让块级元素在一行上显示**
* 浮动**可以进行元素的模式转换**（行内块）

-------

###作用
*  图片文字环绕效果（包裹性 ）
    * 文字不会被盖住 但标签会被盖住


* 让快级元素在一行上显示使用浮动 
    * 制作导航
    * 网页布局

##清除浮动
* 清除浮动对元素的影响 设浮动后元素不占位置 对后面的元素有影响 

------

###方式

#### 使用clear属性  

属性 | 说明 | 属性值 
-----| ----- | -----
clear | 清除浮动 | left清除左侧浮动 right清除右侧浮动 both清除所有浮动

* 在浮动元素后面 添加空div标签 设置clear：both；属性


------

#### 给父元素设置overflow：hidden
* 父元素设置 overflow ：hidden；
* 由于 overflow ：hidden；触发了bfc(格式化上下文)   
* 注意 ： overflow：hidden 可以将超出父元素的办法进行隐藏

-----

#### 使用伪元素清除浮动（推荐）


```css
    /*使用伪元素清除浮动*/
    .clearfix:after {
        content:"";
        height:0;
        line-height:0;
        display:block;
        clear:both;
        visibility:hidden;
    }
    
    .clearfix {
        /*兼容IE*/
        zoom:1;
    }
    
    /*双伪元素*/
    .clearfix:before,....
    
```

* 没有高度的父容器调用

------

#### 清除浮动的时机
* 父容器没有高度 （不设置高度）
* 父容器所有的子元素都设置了浮动

-----

##CSS样式初始化 


```CSS

body,p,h1,h2,h3,h4,h5,h6,ul,ol,dl,li,dt,dd {
		    	margin: 0;
		    	padding: 0;
		    	list-style: none;
		    	font-size: 12px;
		    	font-family: "宋体","微软雅黑";
		    	color: #000;
		    }

			a {
				 color: #000;
				 text-decoration: none;
			}

			a:hover {
				 color: red;
			}

			
			img,input {
				 margin: 0;
				 padding: 0;
				 border: 0 none;
				 outline-style: none;
			}

```

##overflow 介绍

属性值 | 说明
---- | ----- 
visible | 默认情况下可将超出部分显示
hidden | 将超出部分隐藏
scroll | 设置滚动条
auto | 自适应

##伪元素

```CSS
    /* */
    div:before,div:after {
        content:"";
        
    }
```


```CSS
    /* 选择区域*/
    div::selection {
        
    }
```





                                                    


