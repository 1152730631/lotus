# 项目_day02:电商后台管理Demo
# 首页
## ① 退出登录的实现
![-w587](media/14959327833546/14959354222548.png)

* http://amazeui.org 

![-w791](media/14959327833546/14959358551146.png)

![-w469](media/14959327833546/14959359101739.png)

-------

## ② 导航菜单切换
![-w1201](media/14959327833546/14959364676414.png)

-------

## ③ 显示用户数据

```js


        $(function() {

            $("#userTableId").bootstrapTable({
                url: "/user/queryUser",
                method: "get",
                queryParams: function (params) {
                    //指定参数，发送参数给服务器.
                    //这个回调函数什么时候调用，每次发送请求之前，都会通过这个回调函数去设置参数.
                    //console.log(params);
                    //如果是第一页，params offset=0
                    //如果是第二页，params offset=10
                    //如果是第三页，params offset=20
                    params.page = (params.offset / 10) + 1;
                    params.pageSize = 10;
                    return params;
                },
                pagination: true,

                sidePagination: "server",

                pageList: [10],

                columns: [
                    {
                        checkbox: true
                    },
                    {
                        title: "用户名",
                        field: "username"
                    },
                    {
                        title: "手机号",
                        field: "mobile"
                    },
                    {
                        title: "是否禁用",
                        field: "isDisable"
                    },
                    {
                        title: "操作",
                        field: "operation"
                    }
                ]
            });

        });

```

![-w850](media/14959327833546/14961158365705.png)
![-w838](media/14959327833546/14961160290588.png)

![-w1204](media/14959327833546/14961158768752.png)

-------

## ④ 显示用户 用户分页处理

* 展示用户数据,我们需要实现 table 展示 bootstrap 自带table 功能单一 bootstrap 的table 查询完成分页功能


```js

                queryParams: function (params) {
                    //指定参数，发送参数给服务器.
                    //这个回调函数什么时候调用，每次发送请求之前，都会通过这个回调函数去设置参数.
                    //console.log(params);
                    //如果是第一页，params offset=0
                    //如果是第二页，params offset=10
                    //如果是第三页，params offset=20
                    params.page = (params.offset / 10) + 1;
                    params.pageSize = 10;
                    return params;
                },

```


```js

                pagination: true,

                sidePagination: "server",

```

-------

### bootstrap-table 插件
* http://bootstrap-table.wenzhixin.net.cn/zh-cn/getting-started/

* **下载 保存 css 和js文件**

![](media/14959327833546/14959377680546.png)


![-w532](media/14959327833546/14959378302584.png)

-------

* **① 引入文件**

![-w916](media/14959327833546/14959378847373.png)
![-w819](media/14959327833546/14959379527737.png)

![](media/14959327833546/14959384856165.png)

-------


* **② 画页面表格 ,展示用户信息的表格**

* 使用`bootstrapTable()`方法定义表格

![-w485](media/14959327833546/14959381353338.png)


* http://bootstrap-table.wenzhixin.net.cn/zh-cn/documentation/

-------

* (1)定义table列
 
![-w562](media/14959327833546/14959385761650.png)

-------

* (2)定义每列对应什么字段

![-w529](media/14959327833546/14959387408253.png)

-------

* (3) 查阅文档,请求接口 返回数据

![-w764](media/14959327833546/14959390734446.png)

* (4) 指定参数 请求接口

![](media/14959327833546/14959393973901.png)

![-w558](media/14959327833546/14959394644053.png)

-------

* (5) 请求到数据 把数据显示在table中 开启服务器端分页


![-w858](media/14959327833546/14959404071608.png)
![-w852](media/14959327833546/14959404379674.png)



![-w873](media/14959327833546/14959400385896.png)

![-w1130](media/14959327833546/14959404626701.png)


-------

* (6)显示全每一行数据

![-w726](media/14959327833546/14959411283002.png)

![-w784](media/14959327833546/14959413850503.png)

![](media/14959327833546/14959414674645.png)

![-w1127](media/14959327833546/14959414874471.png)


-------


## ⑤ 禁用/启用用户
* 添加按键点击事件 
* 有一个回调函数 onLoadSuccess 数据加载完毕选好之后触发


```js

                //还有回调函数，rowStyle,每一行的数据渲染之前，都会调用这个回调函数.
                rowStyle:function(row,index){
                    if(row.isDelete==1){
                        row.isDisable="已启用";
                        row.operation="<a href='#' id='"+row.id+"' class='btn btn-danger disableButton'>禁用</a>";
                    }else{
                        row.isDisable="<font color='red'>已禁用</font>";
                        row.operation="<a href='#' id='"+row.id+"' class='btn btn-success enableButton'>启用</a>";
                    }
                    //row 代表每一行的数据.
                    return row;
                },

                //有一个回调函数，onLoadSuccess 数据加载完毕渲染之后触发.
                onLoadSuccess:function(){

                    var changeStatus=function(userId,isDelete,message){
                        //发送ajax 请求，去后台禁用这条记录
                        $.ajax({
                            url:"/user/updateUser",
                            type:"post",
                            data:{
                                id:userId,
                                isDelete:isDelete
                            },
                            success:function(data){
                                if(data.success){
                                    alert(message);
                                    //重新去刷新这个table
                                    //传递这个refresh 的方法名,底层会重新去加载这个表格，渲染数据.
                                    $("#userTableId").bootstrapTable("refresh");
                                }
                            }
                        })
                    }

                    //禁用
                    $(".disableButton").on("click",function(){
                        var userId=this.id;
                        //禁用
                        changeStatus(userId,0,"禁用成功");
                    });
                    //启用
                    $(".enableButton").on("click",function(){
                        var userId=this.id;
                        //禁用
                        changeStatus(userId,1,"启用成功");
                    });
                }

            });

```

![](media/14959327833546/14961161012146.png)

![](media/14959327833546/14961161767173.png)


-------

* (1) 添加class

![-w972](media/14959327833546/14959417039635.png)

-------

* (2) 在`onLoadSuccess`数据加载完毕后绑定点击事件 

![-w714](media/14959327833546/14959417631569.png)


-------

* (3) 点击禁用 发送ajax 请求,去后台禁用这条记录

![-w734](media/14959327833546/14959418813361.png)

* 对每一个按钮 a 标签 添加id

![-w691](media/14959327833546/14959421439747.png)

* 获取到当前点击的 item id值 请求接口更新数据

![-w714](media/14959327833546/14959422198036.png)

-------

* (4) 请求成功后 自动刷新界面 

![-w719](media/14959327833546/14959423739413.png)

![-w906](media/14959327833546/14959424470993.png)

-------

* (5) 封装方法 完成启用逻辑
![-w658](media/14959327833546/14959427213043.png)


-------

## ⑥ 添加参数指定分页条数
![-w719](media/14959327833546/14959429074714.png)

-------

## ⑦ 全选功能

```js

columns: [
                    {
                        checkbox: true
                    },
        ]

```

![-w1131](media/14959327833546/14959430374919.png)

![-w825](media/14959327833546/14959430640855.png)

-------

# 侧边栏
## ① 分类管理
* (1) 将 退出登录 检测登录 功能 封装到 common.js
* **注意** 检测登录 功能 不能 封装到 common.js中 因为 login界面也引入了 common.js

* categoryFirst.html

![](media/14959327833546/14959538855553.png)

* **① 引入文件**

![](media/14959327833546/14959541060909.png)

* **② 使用bootstrapTable 创建table界面**
![-w752](media/14959327833546/14959543416975.png)


```js

            $("#categoryTableId").bootstrapTable({
                method:"get",
                url:"/category/queryTopCategoryPaging",
                queryParams:function(params){
                    params.page=1;
                    params.pageSize=10;
                    return params;
                },
                pageList:[10],
                //开启服务端分页
                pagination: true,
                sidePagination:"server",
                /* showRefresh:true,*/
                columns:[
                    {
                        "title":"分类编号",
                        "field":"id"
                    },
                    {
                        "title":"分类的名称",
                        "field":"categoryName"
                    }
                ]
            });

```

## ② 实现添加分类功能

![-w1005](media/14959327833546/14959547932640.png)

![-w741](media/14959327833546/14959555513998.png)

```js


      $(function(){

            $("#categoryTableId").bootstrapTable({
                method:"get",
                url:"/category/queryTopCategoryPaging",
                queryParams:function(params){
                    params.page=1;
                    params.pageSize=10;
                    return params;
                },
                pageList:[10],
                //开启服务端分页
                pagination: true,
                sidePagination:"server",
                /* showRefresh:true,*/
                columns:[
                    {
                        "title":"分类编号",
                        "field":"id"
                    },
                    {
                        "title":"分类的名称",
                        "field":"categoryName"
                    }
                ]
            });
            //添加分类的数据.
            $(".categorySave").on("click",function(){
                //获取分类的名称.
                var categoryName=$(".categorySave").val();
                $.ajax({
                    type:"post",
                    url:"/category/addTopCategory",
                    data:{
                        categoryName:categoryName
                    },
                    success:function(data){
                        if(data.success){

                            //触发取消按钮的点击事件.
                            $(".cancelCategoryButton").click();
                            //刷新这个table
                            $("#categoryTableId").bootstrapTable("refresh");
                            alert("添加成功");
                        }
                    }
                })
            });

        });

```

## ③ 二级分类
* **(1) 显示二级分类界面**

![](media/14959327833546/14959568677960.png)
* **① 引入文件**

```html

<!--start 文件上传需要依赖的js 文件-->
    <script src="assets/jquery-fileupload/jquery.ui.widget.js"></script>
    <script src="assets/jquery-fileupload/jquery.iframe-transport.js"></script>
    <script src="assets/jquery-fileupload/jquery.fileupload.js"></script>
    <!--end 文件上传需要依赖的js 文件-->

    <script src="js/common.js"></script>
    <script src="js/indexUtils.js"></script>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/bootstraptable/bootstrap-table.js"></script>
    <script src="assets/bootstraptable/bootstrap-table-zh-CN.js"></script>

```

* **(2) 显示品牌数据**

![-w774](media/14959327833546/14959572275222.png)


```js

        $(function(){
            $("#categorySecondId").bootstrapTable({
                method:"get",
                url:"/category/querySecondCategoryPaging",
                queryParams: function (params) {
                    params.page = (params.offset / 10) + 1;
                    params.pageSize=1;
                    return params;
                },
                pagination:true,
                paginationLoop:true,
                sidePagination:"server",
                onlyInfoPagination:false,
                pageList:[10,20,30],
                paginationPreText:"上一页",
                paginationNextText:"下一页",
                rowStyle:function(row,index){
                    row.brandLogo="<img src='"+row.brandLogo+"' style='width:100px;'>"
                    return row;
                },
                columns:[
                    {
                        "title":"品牌编号",
                        "field":"id"
                    },
                    {
                        "title":"品牌的名称",
                        "field":"brandName"
                    },
                    {
                        "title":"品牌logo",
                        "field":"brandLogo"
                    }
                ]
            });
        });

```

## ④ 实现添加品牌功能
![-w808](media/14959327833546/14959576988415.png)

![-w773](media/14959327833546/14959578538333.png)

 
 
```js

            /*
             * 1:获取一级分类的数据，渲染到下拉菜单.
             * */
            $.ajax({
                url:"/category/queryTopCategoryPaging",
                type:"get",
                data:{
                    page:1,
                    pageSize:30
                },
                success:function(data){
                    for(var i=0;i<data.rows.length;i++){

                        //这里是获取下拉列表的数据，然后组装成li 元素.然后放在页面上面.
                        var li="<li><a href='#' id='"+data.rows[i].id+"'>"+data.rows[i].categoryName+"</a></li>"
                        $("#categoryMenu").append(li);
                    }
                }
            });

```


```js


            //要添加到服务器端品牌的数据.
            var params={
                categoryId:"",
                //图片上传的地址
                brandLogo:"",
                hot:"",
                //品牌的名称.
                brandName:""
            };

```


```js

             //给所有的下拉框的li 添加点击事件，点击li 元素，可以自动选中
            $("#categoryMenu").on("click","a",function(){
                var categoryName = $(this).text();
                //选中的分类对应的id，需要发送到后台去的.
                params.categoryId=this.id;
                $("#button_text")[0].innerHTML=categoryName;
            })
```


```html

 <input type="file" id="input_file_imgaeId" name="pic1" data-url="/category/addSecondCategoryPic">

```


```js

            /*文件上传的使用.*/
            $("#input_file_imgaeId").fileupload({
                autoLoad:true,
                done:function(e,data){

                    console.log(data);
                    //服务端的数据通过data 返回.
                    var src=data._response.result.picAddr;
                    console.log(src);
                    //这个地址页是要发送到服务器的.
                    params.brandLogo=src;
                    //这个也是地址.
                    //预览图片.
                    //创建img ，放在对应的区域
                    var img=document.createElement("img");
                    img.src=src;
                    img.style.width="100px";
                    img.style.height="100px";
                    $("#imagePreview").html(img);
                    //图片的盒子.
                    $("#imagePreview").fadeIn(1000);
                }
            });

```



```js

        /*是否是热门品牌的下拉列表选中.*/
        $("#hotMenudropId li a").on("click",function(){
              var text=$(this).text();
              //是否是热门品牌的，也需要发送给服务器.
              params.hot=this.id;
              //改下拉列表框的值.
              $("#hotMenuId")[0].firstChild.nodeValue=text;
        });

```


```js

        /*是否是热门品牌的下拉列表选中.*/
        $("#hotMenudropId li a").on("click",function(){
              var text=$(this).text();
              //是否是热门品牌的，也需要发送给服务器.
              params.hot=this.id;
              //改下拉列表框的值.
              $("#hotMenuId")[0].firstChild.nodeValue=text;
        });

        //点击确定，获取品牌相关的数据，发送到服务器，关闭这个弹出框，刷新这个表格.
        $(".okBrandButton").on("click",function(){
              //准备数据
              params.brandName=$("#brandNameId").val();
              //发送请求之前要对params 里面的key 对应 的值进行判断，
             //发送请求
             $.ajax({
                 url:"/category/addSecondCategory",
                 type:"post",
                 data:params,
                 success:function(data){
                        //上传成功:
                        if(data.success){
                               //关闭弹出框
                                $(".cancelBrandButton").click();
                                 //刷新表格.
                               $("#brandTableId").bootstrapTable("refresh");
                        }
                 }
             })

```


```js

        //点击确定，获取品牌相关的数据，发送到服务器，关闭这个弹出框，刷新这个表格.
        $(".okBrandButton").on("click",function(){
              //准备数据
              params.brandName=$("#brandNameId").val();
              //发送请求之前要对params 里面的key 对应 的值进行判断，
             //发送请求
             $.ajax({
                 url:"/category/addSecondCategory",
                 type:"post",
                 data:params,
                 success:function(data){
                        //上传成功:
                        if(data.success){
                               //关闭弹出框
                                $(".cancelBrandButton").click();
                                 //刷新表格.
                               $("#brandTableId").bootstrapTable("refresh");
                        }
                 }
             })

```
























