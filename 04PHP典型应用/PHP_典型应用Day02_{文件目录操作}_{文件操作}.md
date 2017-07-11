# PHP_典型应用Day02_{文件目录操作}_{文件操作}

![PHP_典型应用Day02](media/14917862148455/PHP_%E5%85%B8%E5%9E%8B%E5%BA%94%E7%94%A8Day02.png)


[TOC]


## 描述
* PHP具有文件夹 和 文件处理能力 
* 对文件夹:创建目录 删除目录 复制目录 移动目录 目录更名 目录访问权限
* 对文件:创建 打开 写入 关闭 删除
* 例如: 网盘管理. 


-------

## 文件目录操作

### mkdir() 创建目录 
* 描述: mkdir — 新建目录
* 语法: `bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )`
* 参数:
    * `$pathname` : 目录名称
    * `$mode` : 给目录指定访问权限,默认的 mode 是 0777,意味着最大可能的访问权
    * `$recursive` :如果上层目录不存在,是否递归创建
* 返回值: 返回布尔值


```php

<?php
	//每隔一秒刷新一次
	header("refresh:1");
	//目录名称
	$dir = "./DemoDir".date("YmdHis");
	
	var_dump(mkdir("./DemoDir", 0700));

?>

```

-------


### is_dir() 判断是不是一个目录 
* 描述: is_dir — 判断给定文件名是否是一个目录
* 语法: `bool is_dir ( string $filename )`



-------

### file_exists() 判断文件是否存在 
* 描述: file_exists — 检查文件或目录是否存在
* 语法:`bool file_exists ( string $filename )`


```php

//目录名称
	$dir = "./upload/";
	if(!file_exists($dir)){
		echo mkdir($dir, 0777) ? "创建成功": "创建失败"; 
	}else {
		echo "{$dir}目录以及存在";
	}
	
```


-------

### rmdir() 删除目录 
* 描述: rmdir — 删除目录
* 语法: `bool rmdir ( string $dirname [, resource $context ] )`
* ==注意:只能删除空目录,该目录必须有访问权限==
* 


```php

	//目录名称
	$dir = "./upload/";
	if(!file_exists($dir)){
		echo mkdir($dir, 0777) ? "创建成功": "创建失败"; 
	}else {
		echo rmdir($dir) ? "目录删除成功":"目录删除失败";
	}

```

-------

### chmod() 更改目录的访问权限 
* 描述:chmod — 改变文件模式
* 语法:`bool chmod ( string $filename , int $mode )`
* 参数:
    * `$filename` : 代表要修改的权限目录
    * `$mode` : 必须八进制,设置访问权限的值
    * 参数包含三个八进制数按顺序分别指定了所有者、所有者所在的组以及所有人的访问限制。
    * 数字 1 表示使文件可执行，数字 2 表示使文件可写，数字 4 表示使文件可读
* 注意: 只有在linux unix系统有效果  

-------


### fileperms() 取得文件夹的访问权限 
* 描述:fileperms — 取得文件的权限
* 语法: `int fileperms ( string $filename )`

-------

### substr() 截取字符串 
* 描述:substr — 返回字符串的子串
* 语法:`string substr ( string $string , int $start [, int $length ] )`
* 返回字符串 string 由 start 和 length 参数指定的子字符串。
* 参数:
    * `$string` 原始字符串
    * `$start`开始截取的下标 
    * `$length` 截取的长度 省略代表到结尾


```php

	$dir = "./upload/";
	if(!file_exists($dir)){
		echo mkdir($dir, 0777) ? "创建成功": "创建失败"; 
	}else {
		//获取目录权限 转换八进制 取出后四位
		echo substr(decoct(fileperms($dir)) ,-4);
	}

```
 
-------

### sprintf() 字符串格式化输出 
* 描述: 返回一个格式化后的字符串
* 语法: `string sprintf ( string $format [, mixed $args [, mixed $... ]] )`
* `$format` 指定字符串输出的格式.以`%`开头
    * `%u`  
    * `%o` 转成八进制输出
    * `%d` 转成十进制输出
    * `%c` 转成ASCII输出
    * `%b` 转成二进制输出
* `$args` 原始字符串 一般是个整形

```php

$int = 16895;
echo sprintf("DEMO %o DEMO %X DEMO", $int ,$int);

```

-------


### rename() 目录重命名或移动目录 
* 描述: rename — 重命名一个文件或目录
* 语法: `bool rename ( string $oldname , string $newname [, resource $context ] )`
* 尝试把 oldname 重命名为 newname。
    * `$oldname` 原文件或目录
    * `newname` 新文件和目录
* 如果同目录下操作: 是重命名
* 如果不同目录,相当于移动  


```php

//目录名称
		$dir = "./upload/";
		$newdir = "./DemoDir/demo";
		
		if(!file_exists($dir)){
			echo mkdir($dir, 0777) ? "创建成功": "创建失败"; 
		}else {
			rename($dir,$newdir);
		}

```

-------

### opendir() 打开目录 
* 描述:opendir — 打开目录句柄
* 语法:`resource opendir ( string $path [, resource $context ] )`
* 返回值: 如果成功返回 目录句柄的 resource 

    
```php

var_dump(opendir($dir)); // stream文件流 相当于调用文件管理器

```

-------

### readdir() 读取文件条目 
* 描述: readdir — 从目录句柄中读取条目
* 语法: `string readdir ([ resource $dir_handle ] )`
* 每次从目录中读出一个文件名 并下移文件指针


-------

### iconv() 显示中文目录 
* 描述:iconv — 字符串按要求的字符编码来转换
* 语法:`string iconv ( string $in_charset , string $out_charset , string $str )`
* 参数
    * `$in_charset` : 输入字符集
    * `$out_charset` : 输出字符集
    * `$str` : 原始字符串
    
    
```php

function d3(){
		
		$dir = "/Library/WebServer/Documents/Demo1";
		$handle =  opendir($dir); //打开目录返回一个目录句柄
		//var_dump($handle);
	 	// 从目录句柄中,读出一个条目
		while($item = readdir($handle)){
			echo  iconv("utf-8","utf-8",$item) . "\r";
		}
	}

```

-------

### closedir() 关闭目录句柄 
* 描述:closedir — 关闭目录句柄
* 语法:`void closedir ( resource $dir_handle )`


-------


### 递归遍历所有的子目录
#### 递归思想
* 将一个复杂的问题,解析若干个相似的问题来解决.
* 递归效率不太高 
* 函数递归: 在函数中不断的调用自己

-------


#### 递归实现的条件
* 递归的公式.
* 递归的退出条件.

-------

#### 递归遍历 某个目录中的所有文件夹和文件


```php

// 递归遍历 phpMyAdmin 所有的子目录
	function d4($dir){
		//打开目录返回目录句柄
		$handle = opendir($dir);
		//循环读出目录中所有的item
	
		while($item = readdir($handle)){
			if($item == '.' || $item == '..'){
				continue;
			}
						
			echo "\r ".$dir."/".$item;	
			
			//如果是目录,则递归调用
			if(is_dir($dir."/".$item)){
				d4($dir."/".$item);
			}
		}
		//关闭目录
		closedir($handle);
	}

```

-------

 
## PHP操作文件 

### fopen() 打开文件 和 创建文件;
* 描述:fopen — 打开文件或者 URL
* 语法:`resource fopen ( string $filename , string $mode [, bool $use_include_path = false [, resource $context ]] )`
* fopen() 将 filename 指定的名字资源绑定到一个流上。

* 参数:
    *  `$filename` 打开文件的名称
    *  `$mode` 文件打开方式
        * `r` 只读 打开文件,文件指针位于文件开头(read)
        * `w` 写入 如果文件不存在,则会创建文件,如果文件存在,则覆盖(write)
        * `a` 追加 如果不存在会创建 存在会追加(appand)
        * `b` 以二进制方式打开 以安全方式打开 其他几个参数与b 参数联合使用()
* 返回值: 如果文件打开成功 返回资源 如果失败返回FALSE


```php

$filename = "./a.txt";
		//以写入的方式打开
		$handle = fopen($filename,"wb");
		var_dump($handle);

```


-------

### fclose() 关闭文件 
* 描述:fclose — 关闭一个已打开的文件指针
* 语法:`bool fclose ( resource $handle )`


```php

    $filename = "./a.txt";
		//以写入的方式打开
		$handle = fopen($filename,"wb");
		var_dump($handle);
		
		//关闭打开的文件
		fclose($handle);
		var_dump($handle);
		//resource(5) of type (Unknown)

```

-------

### fread() 读取指定大小文件内容 
* 描述: fread — 读取文件（可安全用于二进制文件）,所谓二进制文件注意指各种附件(视频 PPT 文本等)
* 语法:`string fread ( resource $handle , int $length )`
* fread() 从文件指针 handle 读取最多 length 个字节。 该函数在遇上以下几种情况时停止读取文件：
* 参数
    * `$handle` : 指定打开的文件
    * `$length` : 指定每次读取的字符的字节数 一般是1024(1kb)
* 返回读取的文件内容,可以读取文件 图片 音频 应用程序等


-------

### filesize() 获取文件大小
* 描述:filesize — 取得文件大小
* 语法:`int filesize ( string $filename )`
* 取得指定文件的大小。返回文件大小的字节数，如果出错返回 FALSE 并生成一条 E_WARNING 级的错误。
* 参数
    * `filename`文件的路径。

    
-------

    
###  读取图片数据 

 
```php
    //声明页面字符集:为图片类型
    header("content-type:image/jpeg")
		$filename = "./1.jpeg";
		//打开文件:以只读方式打开
		$handle = fopen($filename,"rb");
		//读取指定大小的文件内容
		$str = fread($handle,filesize($filename));
		echo $str; 

```

-------


### fgets() 读取一行内容 
* 描述:fgets — 从文件指针中读取一行
* 语法: `string fgets ( resource $handle [, int $length ] )`
* 从文件指针中读取一行。
* 参数
    * `$handle` 打开的文件句柄
    * `$length` 读取内容长度 
    * 从 handle 指向的文件中读取一行并返回长度最多为 length - 1 字节的字符串。碰到换行符（包括在返回值中）、EOF 或者已经读取了 length - 1 字节后停止（看先碰到那一种情况）。如果没有指定 length，则默认为 1K，或者说 1024 字节。

```php

	//循环读取记事本中所有行数据
		$filename = "./a.txt";
		//打开文件:以只读方式打开
		$handle = fopen($filename,"rb");
		
		//循环读取记事本数据
		// fgets() 有下移指针的功能
		while($str = fgets($handle)){
			echo $str."\r";
		}	
		
```

-------


### file() 把整个文件读入数组 
* 描述:file — 把整个文件读入一个数组中,该函数不需要打开文件
* 语法: `array file ( string $filename [, int $flags = 0 [, resource $context ]] )`

* 参数: 
    * `$filename` 原始文件名
    * `$flags` 
        * `FILE_USE_INCLUDE_PATH` 在 include_path 中查找文件。
        * `FILE_IGNORE_NEW_LINES` 在数组每个元素的末尾不要添加换行符 
        * `FILE_SKIP_EMPTY_LINES` 跳过空行

* 返回值: 返回一个数组
* 二进制的数据不适合使用`file()`进行读取

```php

$arr = file("./a.txt",FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
		
		print_r($arr); 

```

-------


### file_get_contents 把文件内容读取到字符串中
* 描述:file_get_contents — 将整个文件读入一个字符串
* 语法:`string file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = -1 [, int $maxlen ]]]] )`



```php

$str = file_get_contents("./a.txt");
		$handle = fopen("./b.txt");
		fwrite($handle, $str);
		//echo $str;
		fclose($handle);

```

-------


### 读取文本文件中的学生信息

```php

header("Content-type:text/html;charset=utf-8");

	$filename = "./a.txt";

	 $handle = fopen($filename, "rb");

	 $str = "<table border = 1>";

	 //循环文件句柄
	 while ( $item = fgets($handle)){
	 	
	 	// 将字符串用 , 分割 
	 	// implode 连接字符串
	 	$arr = explode(" " , $item);
	 	
	 	
		 $str .= "<tr>";
		 foreach ($arr as $key => $value) {
		 	$str .= "<td> $value </td>"; 
		 }
		 

		 $str .= "</tr>";
	 }

	 $str .= "</table>";

	 echo $str;

```

-------

### fwrite() 写入文件内容 
* 描述:fwrite — 写入文件（可安全用于二进制文件）
* 语法:`int fwrite ( resource $handle , string $string [, int $length ] )`
* 参数
    * `$handle` 文件句柄
    * `$String` 写入的内容
    * `$length` 写入的字符长度


```php

$filename = "./a.txt";
		$content ="4 江大桥 男 20 大本 5000 50 京都\n";
		//打开文件 以追加方式打开
		$handle = fopen($filename,"ab");
		fwrite($handle, $content);
		fclose($handle);

``` 

### file_put_contents() 将字符串写入到文件
* 描述:file_put_contents — 将一个字符串写入文件
* 语法:`int file_put_contents ( string $filename , mixed $data [, int $flags = 0 [, resource $context ]] )`
* 和依次调用 `fopen()`，`fwrite()` 以及 `fclose()` 功能一样。
* 参数
    * `$filename` 要被写入数据的文件名。
    * `$data` 写入的字符串
    * `$flags` 
        * `FILE_USE_INCLUDE_PATH` 在 include 目录里搜索 filename。
        *  `FILE_APPEND`  如果文件 filename 已经存在，追加数据而不是覆盖。
        *  `LOCK_EX` 在写入时获得一个独占锁 
        
   
```php

        $str = file_get_contents("./a.txt");
		//如果文件不存在自动创建
		file_put_contents('./b.txt',$str);

```  

### copy() 拷贝文件
* 描述:copy — 拷贝文件
* 语法:`bool copy ( string $source , string $dest [, resource $context ] )`  
* 参数:
    * `$source` 源文件
    * `dest` 目标文件


```php

     $source = "./a.txt";
		$dest = "./c.txt";
		
		copy($source,$dest);

```  


### unlink() 删除文件 
* 描述:unlink — 删除文件
* 语法:`bool unlink ( string $filename [, resource $context ] )`
* 注意:删除的文件不会进入回收站


```php

        $filename = "./c.txt";
		
		unlink($filename);

```


### 递归删除目录中的所有文件

```php

//递归删除所有的文件
	function recursion($dir){
		// 打开目录	
		$handle = opendir($dir);
		
		//循环读取目录中的条目
		while($item = readdir($handle)){
			if($item == '.' || $item == ".."){
				continue;
			}
			
			if(is_dir("$dir/$item")){
				recursion("$dir/$item");
			}else {
				//删除文件
				unlink("$dir/$item");
			}
		}
		
		closedir($handle);
		rmdir($dir);
		
	}
	
	//函数调用
	recursion("/Volumes/LIFANG/笔记");

```

## 其他文件操作函数
* `is_writable()` 判断文件是否可写
* `is_readable()` 判断文件是否可读
* `feof` 判断文件指针是否到达文件结尾
* `filectime()` 获取文件创建的时间 
* `fileatime()` 获取文件最后访问的时间
* `filemttime` 获取文件修改的时间戳

     



     






    



