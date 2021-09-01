<?php
/*
 1-1. 将1234567890转换成1,234,567,890 每3位用逗号隔开。
 * 思路：将字符串翻转过来 0987654321 隔开后再翻转回来
*/
$str = '1234567890';
function str($str){
	// 翻转字符
	$str=strrev($str); 
	// 分割字符
	$str=chunk_split($str,3,',');
	//再翻转回来	
	$str=strrev($str);
	//去掉左侧 ','
	$str=ltrim($str,',');
	return $str;
	//strrev只能翻转数字字符，不能翻转中文
}
/*
	*1.2 实现字符串翻转 '你好666'
	*思路 使用正则和数组实现
 */

function str_utf8($str){
	// 分割成数组
	$arr = preg_split('//u', $str);
	// 数组翻转
	$arr2 = array_reverse($arr);
	// 将数组拼成一个字符串
	return implode("",$arr2);
}

/*
 2. 1-n只猴子 数m数 踢出去 最后剩下的是大王 求大王是哪只
 * 思路：
*/
function king($n, $m){
	// 构造数组
	for ($i=1;$i<=$n;$i++){
		$arr[]=$i;
	}
	$i = 0;
	while(count($arr)>1){
		//判断猴子是否出局，如果出局删掉，没出局放到数组最后 继续循环
		if($i+1 % $m == 0){
			unset($arr[$i]);
		}else{
			array_push($arr, $arr[$i])
			unset($arr[$i]);
		}
		$i++
	}
	return $arr;
}

/*
	*3. 给定一个无序整数数组，找出其中未出现的最小整数
 */
function getSmallInt($arr){
	$i=1;
	while(1){
		if(in_array($i,$arr)){
			return $i;
			break;
		}else{
			$i++;
		}
	}
}
/*
	*4. 写一段php确保多个进程同时写入同一个文件
	*思路：加锁
 */
function file4(){
	$file = fopen("text.txt","w+");
	if(flock($file, LOCK_EX)){
		// 获得写锁，开始写数据
		fwrite($file, '你好666');
		// 解除锁定
		flock($file, LOCK_UN);
	}else{
		echo "file is locking";
	}
	fclose($file);
}

/*
	*5. 判断字符串是否是正确的日期格式 2021-5-20 11:56:00
	*思路：转时间戳再转回来 判断是否一致
 */
function checkTimeStr($str){
	if(date('Y-m-d H:i:s',strtotime($str))==$str){
		return true;
	}else{
		return false;
	}
}

/*
	*6. 写一个函数，算出两个文件的相对路径 $a='/a/b/c/d/a.php' $b='/a/b/e/f/b.php'
	*思路：计算路径里面相同的部分，然后用..替换
 */
function changePath($a, $b){
	$aarr = explode('/', dirname($a));
	$barr = explode('/', dirname($b));
	for($i=0,$len=count($barr); $i<$len; $i++){
		if($aarr[$i] != $barr[$i]){
			break;
		}
	}
	if($i<$len){
		$path=array_fill(0, $len-$i, ".."); // 从下标0开始 填充 $len-$i个'..'
	}
	$path=array_merge($path, array_slice($aarr, $i)); // array_slice 从下标$i往后截取数组
	return implode($path);
}

/*
	*7. php的垃圾回收机制
 */
// 重点： 引用计数（reference counting)
// 每个对象被引用则+1 每个连接离开生存空间或者被设置为none的时候 -1 为0时 php将自动释放其占用空间

/*
	*8. 禁用cookie后session还能使用吗
 */
// 可以使用
// 默认sessionid保存在cookie里面
// 默认不能用
// 但是可以通过get传递 也可以直接开启透明的sid（需要关闭基于cookie的session配置项）

/*
	*9. 如何修改session的生存时间
 */
// 区分session的生存空间
// 1.session文件生存时间
// php.ini 三个参数：session.gc_probability,session.gc_divisor,session_maxlifetime
// 2.保存在客户端的sessionid的生存时间
// php.ini 设置session.cookie_lifetime

/*
	*10. mysql中MYISAM和INNODB的区别
 */
// MYISAM：不支持事务，支持表级锁，不支持MVCC，不支持外键，支持全文索引
// INNODB： 支持事务，支持行级锁，支持MVCC，支持外键，不支持全文索引
// INNODB引擎的四大特征：插入缓存 二次写 自适应哈希索引 预读

/*
	*11. INNODB的事务如何通过日志实现
 */
// 预写日志方式：
// 事务日志是通过redo和INNODB的存储引擎日志缓存来实现的。
// 当开启一个事务的时候，会记录事务的lsn号，当事务执行的时候，会往INNODB存储引擎的日志的日志缓存里面插入事务日志，当事务提交时，必须将存储引擎的日志缓存写入磁盘。

/*
	*12. 内连接，左连接，右链接，全连接
 */
// 内连接：仅选出两表中互相匹配的记录
// 左连接：只要左表有数据，数据就能检索出来
// 右链接：相反
// 全连接：全部检索

/*
	*13. 大流量高并发网站解决方案
 */
// 1.硬件方面
// 2.缓存技术 redis 
// 3.禁止外部盗链 
// 4.控制大文件下载
// 5.集群
// 6.统计每个页面流量消耗针对优化
// 7.分库分表，读写分离
// 8.sphinx全文索引引擎

/*
	*14. php网站主要攻击方式
 */
// 1.命令注入
// 2.eval注入
// 3.客户端脚本攻击
// 4.跨网站脚本攻击
// 5.sql注入
// 6.跨网站请求伪造攻击
// 7.session会话劫持
// 8.session固定攻击
// 9.http响应拆分攻击
// 10.文件上传漏洞
// 11.目录穿越漏洞
// 12.远程文件包含攻击
// 13.动态函数注入攻击
// 14.URL攻击
// 15.表单提交欺骗攻击
// 16.HTTP请求欺骗攻击

/*
	*15 给一个变量赋值0123 输出总是其他数字
 */
//php解释器会把0开头的数字当成8进制，但是输出会把8进制转成10进制输出
//0开头八进制 0b开头二进制 0x开头十六进制

/*
	*16 索引是什么 有什么作用
 */
// 索引是对数据库表中一或多个列的值进行排序的结构 是帮助MySql高效获取数据的一种数据结构
// 普通索引 唯一索引 主键索引 全文索引
// 索引增加查询性能 减少增删改性能 会占用内存空间

/*
	*数据库设计三范式
 */
// 1.每一列都不可再分割
// 2.要有主键，且实体属性完全依赖主键
// 3.消除依赖传递 一个关系表中不能包含其他表中包含的非主键信息

/*
	*web开发方面会遇到哪些缓存
 */
// 1.浏览器缓存
// 2.代理服务器缓存
// 3.网关缓存

/*
	*冒泡排序
 */
function eleSort($arr){
    $length=count($arr);
    if($length<2){
        return $arr;
    }
    for($i=0;$i<$length;$i++){
        for($j=$i+1;$j<$length;$j++){
            if($arr[$i]>$arr[$j]){
                $tmp=$arr[$j];
                $arr[$j]=$arr[$i];
                $arr[$i]=$tmp;
            }
        }

    }
    return $arr;
}

/*
	*快速排序
	*选一个基数 剩余数分别于基数判断 小于放到左边 大于放到右边 再递归排序左右两个数组 最后合并
 */
function quickSort($arr){
    $length=count($arr);
    if($length<2){
        return $arr;
    }
    $base_num=$arr[0];
    $leftarr=[]; // >base
    $rightarr=[]; // <base
    for ($i=0; $i < $length; $i++) { 
    	if($arr[$i]<$base_num){
    		$leftarr[]=$arr[$i];
    	}else{
    		$rightarr[]=$arr[$i];
    	}
    }
    $leftarr=quickSort($leftarr);
    $rightarr=quickSort($rightarr);
    return array_merge($leftarr,array($base_num),$rightarr);
}

/*
	*插入排序
	*假设一个有序数组，将新数据插入时分别与有序数组中的值作比较排好序放进去，当所有数据插入完成后得到的也是一个有序数组
 */
function inSort($arr){
    $length=count($arr);
    if($length<2){
        return $arr;
    }
    // 从第二个数开始依次和前面所有数比较
    for ($i=1; $i < $length; $i++) { 
    	$temp = $arr[$i];
    	// 内层循环
    	for($j=$i-1;$j>=0;$j--){
    		if($tem<$arr[$j]){
    			$arr[$j+1]=$arr[$j];
    			$arr[$j]=$tem;
    		}else{
    			break;
    		}
    	}
    }
	return $arr;
}

/*
	*选择排序
	*找到最小的数放进去 找第二小的放进去。。。
 */
function seSort($arr){
    $length=count($arr);
    if($length<2){
        return $arr;
    }
    for ($i=0; $i < $length-1; $i++) { 
    	// 假设$p为最小值
    	$p=$i;
    	// 分别与后面的数进行比较
    	for($j=$i+1; $j < $length; $j++){
    		if($arr[$p]>$arr[$j]){
    			$p=$j;
    		}
    	}
    	if($p!=$i){
    		$tem=$arr[$p];
    		$arr[$p]=$arr[$i];
    		$arr[$i]=$tem;
    	}
    }
	return $arr;
}

/*
	*不使用第三个变量交换两个变量的值
 */
// 1.字符串连接替换
// $a=1;
// $b=2;
// $a.=$b;
// $b=str_replace($b, '', $a);
// $a=str_replace($b, '',$a);

// // 2.数组赋值
// list($b, $a)=array($a, $b);

/*
	*单例模式
	*三私一共
 */
class Date
{
	private static $date;
	private function __construct(){

	}

	private function __clone(){

	}

	public static function getInstance(){
		if(!(self::$date)){
			self::$date = new self();
		}
		return self::$date;
	}
}

/*
	*工厂模式
 */
interface people
{
	public function type();
}
class man implements people
{
	public function type(){
		echo 'man';
	}
}
class women implements people()
{
	public function type(){
		echo 'women';
	}
}
class creatPeople
{
	public static creatMan(){
		return new man();
	}
	public static creatWomen(){
		return new women();
	}
}

/*
	*观察者模式
	*有事情变化时通知观察者
 */
// 定义事件产生类
abstract class getEvent
{
	private $observer = [];

	// 增加观察者
	public function addObserver($observer){
		$this->observer[]=$observer
	}

	// 通知观察者
	public function inForm(){
		if(!empty($this->observer)){
			foreach ($this->observer as $observer) {
				$observer->update();
			}
		}
	}
}
//定义观察者接口
interface obServer
{
	public function update();
}

class obServer1 implements obServer
{
	public function update(){
		echo '观察者1收到！'
	}
}
class obServer2 implements obServer
{
	public function update(){
		echo '观察者2收到！'
	}
}
// 定义触发类
class event extends getEvent
{
	// 事件触发
	public function demo(){
		// 通知观察者
		$this->inForm()
	}
}
// $a=new event();
// $a->addObserver(new obServer1());
// $a->addObserver(new obServer2());
// $a->demo();