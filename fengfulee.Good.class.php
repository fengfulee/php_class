<?PHP
#	php 中一个不错的类的调用方法..很适合一些不用返回值的函数.
class Good{
	var $name;
	var $sex;
#	给$name初始化..
	function name($name){
		$this->name = $name;
		return $this;
	}
#	给性别初始化..
	function sex($sex){
		$this->sex = $sex;
		return $this;
	}
#	打印...
	function show(){
		print "Name:{$this->name};Sex:{$this->sex}";
	}
	
}//end of clazz.

$good = new Good();
$good->name('fengfulee')->sex('男')->show();

?>
