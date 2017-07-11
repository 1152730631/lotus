# JavaScript_Day02_常见事件_事件冒泡_全选反选_表格的增删改查_下拉菜单_切换随机图片_选项卡案例_手风琴菜单_iframe标签的使用

[TOC]

## js里的常见事件
* 事件

### onclick
```js

            var cli = document.getElementsByTagName("div")[0];
            cli.onclick = function(){
                alert("点击事件");
            }

```

### onmouseover

```js

            cli.onmouseover = function () {
                cli.style.backgroundColor = "red";
            }

```
### onmouseout

```js

            cli.onmouseout = function () {
                cli.style.backgroundColor = "pink";
            }

```

### onsubmit

```js

        window.onload = function(){
            document.forms[0].onsubmit = function(){
                alert("提交前触发");
                var username = document.getElementById("username").value;
                console.log(username);
                return false; //阻止表单提交
            }
        }

```

### onload 和 DOMConentLoaded 

```js

 window.onload = function(){
            console.log("页面加载完毕");
        }

```


```js
        document.addEventListener("DOMContentLoaded",function(){
            console.log("页面上所有的dom,绘制完毕");
        })


```

> DOM文档加载的步骤为

1. 解析HTML结构。
2. 加载外部脚本和样式表文件。
3. 解析并执行脚本代码。
4. DOM树构建完成。//DOMContentLoaded
5. 加载图片等外部文件。
6. 页面加载完毕。//onload
* 在第4步，会触发DOMContentLoaded事件。在第6步，触发load事件。

### onfocus 和 onblur

```js

 document.getElementById("keyword").focus();//定位焦点

```


```js
            document.getElementById("keyword").onfocus = function(){
                console.log("捕获焦点");
            }
```


```js
            document.getElementById("keyword").onblur=function(){
                console.log("失去焦点");
            }

```


### onkeydown
* `document.onkeydown = function(event)`
* 根据event 对象的keyCode 值判断用户输入的那个键
* 根据用户的按键来调用对应的业务逻辑代码


```js

        /**
         * 监听键盘的事件
         * 浏览器可以监听我的键盘,它能够监听用户按的具体按键
         * 由浏览器传递来的 event对象
         * 键盘的按键对应到 keyCode值
         *
         */
        document.onkeydown = function(event){
            console.log("键盘的的按键被按下");
            console.log(event.keyCode);
            if(event.keyCode == 38){
                console.log("↑");
            }

            if(event.keyCode == 40){
                console.log("↓");
            }
        }

```

### onscroll
* 页面滚动是时候触发,
* 作用:页面滚动的时候进行加载    

```js

        window.onscroll = function(){
            console.log("滚动条触发");
        }

```


### onresize
* 浏览器的窗口大小发生改变的时候触发
* 作用:应用需要弹出多个窗口会使用该事件

```js

        window.onresize = function(){
            console.log("浏览器的大小发生改变");
        }

```

### onchange
* 下拉列表发生改变的时候触发

```js

        /**
         * onchange 主要是用在select 中
         * 一般是下拉框改变的时候触发
         */
        window.onload = function(){
            document.getElementById("province").onchange = function(){
                console.log("下拉框发生改变");
            }
        }

```

## 事件冒泡
* 父元素的点击事件,子元素也有点击事件
* 点击子元素,子元素的点击事件会想父元素传播,叫做事件冒泡

```js

        /**
         * 事件冒泡
         * 当点击box3 里面的盒子的点击事件
         *
         */

        window.onload = function(){
             document.getElementById("box1").onclick = function(event){
                 console.log("事件触发 box1");
                 //event.stopPropagation(); //阻止事件穿透

             }
            document.getElementById("box2").onclick = function(){
                console.log("事件触发 box2");
                //event.stopPropagation();

            }
            document.getElementById("box3").onclick = function(){
                console.log("事件触发 box3");
                //event.stopPropagation();
            }
        }

```


```html

    <div id = "box1">
        <div id = "box2">
            <div id = "box3">

            </div>
        </div>
    </div>

```

![2017-05-11 at 下午7.02-w329](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%887.02.png)


### 阻止事件冒泡
* 通过event对象来阻止事件冒泡
* `event.stopPropagation()`

```js

        window.onload = function(){
             document.getElementById("box1").onclick = function(event){
                 console.log("事件触发 box1");
                 event.stopPropagation(); //阻止事件穿透

             }
            document.getElementById("box2").onclick = function(){
                console.log("事件触发 box2");
                event.stopPropagation();

            }
            document.getElementById("box3").onclick = function(){
                console.log("事件触发 box3");
                event.stopPropagation();
            }
        }

```

![2017-05-11 at 下午7.03-w323](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%887.03.png)


### 阻止默认行为 
* `event.preventDefault()` 
* 处理的时候存在兼容性问题

```js

        window.onload = function(){
            document.getElementsByTagName("a")[0].onclick = function(e){
                e.preventDefault();
            }
        }

```

```html

  <a href="www.baidu.com">点击链接至百度</a>

```

#JS案例
## 1 全选反选 
* 操作表单属性 `checked disabled readonly selected`

```html

<ul>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
    <li><input type="checkbox"></li>
</ul>

    全选 <input type="checkbox" id="selectall">
    反选 <input type="checkbox" id="selectresered">

```


```js

            var ul = document.getElementsByTagName("ul")[0];
            var selectall = document.getElementById("selectall");
            var selectresered = document.getElementById("selectresered")

            selectall.onclick = function(){
                var lis = ul.children;
                for(var i = 0;i< lis.length ;i++){
                    lis[i].firstChild.checked = selectall.checked;
                }
            }

```
![2017-05-11 at 下午7.26-w882](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%887.26.png)

> 反选功能的实现

```js

            selectresered.onclick = function(){
                var lis = ul.children;
                for(var i = 0;i< lis.length ;i++){
                    lis[i].firstChild.checked = !lis[i].firstChild.checked;
                }
            }

```

![2017-05-11 at 下午7.33-w911](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%887.33.png)

    

## 2 表格的增删改查 
> 获取表单里面的内容，组装成tr，td，然后放在table 里面.


```html

<body>
<script></script>
<div style="width: 600px;margin: 0 auto;">
    <form action="">
        昵称: <input type="text" id="nickName"> <br><br>
        年龄: <input type="text" id="age"><br><br>
        描述: <input type="text" id="desc"><br><br>
        <input type="button" value="注册" id="buttonId">
    </form>
</div>
<hr>
<div style="width: 600px;margin: 0 auto;">
    <table>
        <tr>
            <td>姓名</td>
            <td>年龄</td>
            <td>描述</td>
            <td>操作</td>
        </tr>
    </table>
</div>

```


```css

table {
            width: 600px;
            border-collapse: collapse;
        }
        td {
            height: 40px;
            text-align: center;
            border: 1px solid #CCC;
        }
    </

```

![2017-05-11 at 下午7.57-w652](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%887.57.png)

![2017-05-11 at 下午7.54](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%887.54.png)

> 添加删除行功能
![2017-05-11 at 下午8.13-w1104](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%888.13.png)






```js

/**
     * //获取表单里面的内容，组装成tr，td，然后放在table 里面.
     *
     * ① 获取表单的值
     * ② 创建表格行 并且插入到table中
     */

    window.
     document.getElementById("buttonId").onclick = function(){

         var nickName = document.getElementById("nickName").value;
         var age = document.getElementById("age").value;
         var desc = document.getElementById("desc").value;
         var table = document.getElementsByTagName("table")[0];

         //创建tr元素
         var tr = document.createElement("tr");

         var td1 = document.createElement("td");
         td1.innerHTML = nickName;
         var td2 = document.createElement("td");
         td2.innerHTML = age;
         var td3 = document.createElement("td");
         td3.innerHTML = desc;
         //添加删除按钮
         var td4 = document.createElement("td");

         var input=document.createElement("input");
         input.setAttribute("type","button");
         input.setAttribute("value","删除");
         input.setAttribute("class","delButton");

         td4.appendChild(input);

         tr.appendChild(td1);
         tr.appendChild(td2);
         tr.appendChild(td3);
         tr.appendChild(td4);

         table.appendChild(tr);

         //给删除按钮添加点击事件.
         var delButton = document.getElementsByClassName("delButton");
         for(var i=0 ; i < delButton.length ; i++){
             delButton[i].onclick=function(){
                 //当事件触发删除当前行
                 var tr = this.parentNode.parentNode; //input->td->tr
                 tr.parentNode.removeChild(tr); //tr->table
             }
         }
        
     }

```

## 3 下拉菜单
* 主要html的结构 在li标签中添加事件

```html

<ul id="menuId">
        <li>
            <a href="javascript:void(0);">一级菜单1</a>
            <ul>
                <li><a href="javascript:void(0);">二级菜单1</a></li>
                <li><a href="javascript:void(0);">二级菜单2</a></li>
                <li><a href="javascript:void(0);">二级菜单3</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);">一级菜单2</a>
            <ul>
                <li><a href="javascript:void(0);">二级菜单1</a></li>
                <li><a href="javascript:void(0);">二级菜单2</a></li>
                <li><a href="javascript:void(0);">二级菜单3</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);">一级菜单3</a>
            <ul>
                <li><a href="javascript:void(0);">二级菜单1</a></li>
                <li><a href="javascript:void(0);">二级菜单2</a></li>
                <li><a href="javascript:void(0);">二级菜单3</a></li>
            </ul>
        </li>
    </ul>

```
![2017-05-11 at 下午8.53-w890](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%888.53.png)


```js

        var menuId = document.getElementById("menuId");
        var lis = menuId.children;
        for(var i=0;i < lis.length;i++){
            lis[i].onmouseover = function(){
                this.lastChild.previousSibling.style.display="block";

            }

            lis[i].onmouseout = function(){
                this.lastChild.previousSibling.style.display="none";
            }
        }

```

## 4 切换随机图片
* 注意 定时器的使用 
* 和图像操作方法的调用方式


```html

<input type="button" value="随机换一张" id="btnChangeImg">
<img src="" alt="" id="imgMax" title=""/>

```


```js

window.onload=function(){
            var img=document.getElementById("imgMax");
            img.src="imgs/a.jpg";

            //实现点击换图功能
            document.getElementById("btnChangeImg").onclick=change;

            //实现自动换图功能
            window.setInterval(change,1000);

            /**
             * 更换图片的方法
             */
            function change(){
                var rdm=Math.random()*5;
                var index=Math.floor(rdm);
                var src="";

                switch(index){
                    case 0:{
                        src="imgs/a.jpg";
                        break;
                    }
                    case 1:{
                        src="imgs/b.jpg";
                        break;
                    }
                    case 2:{
                        src="imgs/c.jpg";
                        break;
                    }
                    case 3:{
                        src="imgs/d.jpg";
                        break;
                    }
                    case 4:{
                        src="imgs/e.jpg";
                        break;
                    }
                }
                img.src=src;
            }
        }

```

![2017-05-11 at 下午9.23-w710](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.23.png)


## 5 选项卡案例[*]

```html

<div class="wrapper">
    <ul class="tab">
        <li class="tab-item active">国际大牌<span></span></li>
        <li class="tab-item ">国妆名牌<span></span></li>
        <li class="tab-item">清洁用品<span></span></li>
        <li class="tab-item">男士精品</li>
    </ul>
    <div class="products">
        <div class="main selected">
            <a href="###"><img src="imgs/guojidapai.jpg" alt=""/></a>
        </div>
        <div class="main">
            <a href="###"><img src="imgs/guozhuangmingpin.jpg" alt=""/></a>
        </div>
        <div class="main">
            <a href="###"><img src="imgs/qingjieyongpin.jpg" alt=""/></a>
        </div>
        <div class="main">
            <a href="###"><img src="imgs/nanshijingpin.jpg" alt=""/></a>
        </div>
    </div>

```

![2017-05-11 at 下午9.28-w630](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.28.png)


> 获取元素节点对象
![2017-05-11 at 下午9.32-w839](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.32.png)

![2017-05-11 at 下午9.39-w707](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.39.png)

![2017-05-11 at 下午9.43-w890](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.43.png)

![2017-05-11 at 下午9.48-w912](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.48.png)


```js

        //① 获取 选项 和 选项内容页
        var tabs=document.getElementsByClassName("tab")[0];

        var mains=document.getElementsByClassName("main");

        var tablis=tabs.children;


        for(var i = 0;i<tablis.length;i++){

            //给每一个li添加点击事件
            tablis[i].onclick = function(){
                //添加选中样式
                this.className="active";

                var index;

                //获取所有li选项
                var lis=this.parentNode.children;

                //遍历所有选项
                for(var j=0;j<lis.length;j++){
                   if(this != lis[j]){
                       lis[j].className="";
                   }else{
                       //记录选中样式的角标
                       index=j;
                   }
                }

                //遍历选项卡内容
                for(var z=0;z<mains.length;z++){
                    if(z==index){
                        //找到对应tabs 项，然后显示，
                        mains[z].className="main selected"
                    }else{
                        mains[z].className="main";
                    }
                }

            }

        }

```


## 6 手风琴菜单


```html

<ul class="parentWrap">
    <li class="menuGroup">
        <span class="groupTitle">我的好友</span>
        <div class="demo">我的好友列表</div>
    </li>
    <li class="menuGroup">
        <span class="groupTitle">土豪们</span>
        <div>兰博基尼、布加迪、法拉利、劳斯莱斯</div>
    </li>
    <li class="menuGroup">
        <span class="groupTitle">程序猿</span>
        <div>Tom、Jerry、nll、ll</div>
    </li>
    <li class="menuGroup">
        <span class="groupTitle">美工妹子</span>
        <div>罗丝、朱迪、冰冰</div>
    </li>
</ul>

```
![屏幕快照 2017-05-11 下午21.54.32 下午-w259](media/14944932623061/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-05-11%20%E4%B8%8B%E5%8D%8821.54.32%20%E4%B8%8B%E5%8D%88.png)

![2017-05-11 at 下午9.57-w895](media/14944932623061/2017-05-11%20at%20%E4%B8%8B%E5%8D%889.57.png)


```js

//js 实现好友列表案例.
    var spansTitle=document.getElementsByClassName("groupTitle");
    for(var i=0;i<spansTitle.length;i++){
        spansTitle[i].onclick=function(){
            //展开当前元素的下一个兄弟节点div
            this.nextSibling.nextSibling.style.display="block";
            console.log(this.nextSibling.nextSibling);
            //获取到当前元素的父元素.
            var limenu=this.parentNode;

            //获取到它的所有的兄弟节点.
            var limenus=limenu.parentNode.children;
            for(var j=0;j<limenus.length;j++){
                if(limenus[j]!=limenu){
                    limenus[j].lastChild.previousSibling.style.display="none";
                    //console.log(limenus[j].lastChild.previousSibling);
                }
            }
        }
    }


```

## 7 iframe 标签的使用
 



