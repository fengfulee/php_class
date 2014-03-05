<?PHP
	#实现了apc和文件缓存...
abstract class CacheAbstract{
	#读取缓存变量....
	#通过 $key 获取缓存变量的值....
	abstract public function fetch($key);

	#缓存变量.
	#$key	缓存变量下标
	#$value 缓存变量的值..
	abstract public function store($key,$value);

	#删除缓存变量的值...
	#$key为下标值..
	abstract public function delete($key);

	#清空所有的缓存..
	abstract public function clear();


}


?>
