<?PHP
	#展示使用foreach时,迭代器的调用顺序..
	# rewind->valid->current->key-> next->valid->current->key..
	class MyIterator implements Iterator{
		#实现了 Iterator 接口...
		private $position = 0;
		private $arr = array('firstelement','secondelement','thirdelement');
		
		#构造方法,将指针下标初始化到 0 的位置..
		public function __construct(){
			$this->position = 0;
		}
		#初始化指针...返回迭代器的第一个元素..当第一次执行完毕之后,以后就不再执行...
		function rewind(){
			var_dump(__METHOD__);	#调用魔术常量...这个能够同时显示方法和类名...
			$this->position = 0;
		}

		#返回当前的对象是否有效
		function valid(){
			var_dump(__METHOD__);
			return isset($this->arr[$this->position]);
		}

		#返回当前元素..
		function current(){
			var_dump(__METHOD__);
			return	$this->arr[$this->position];
		}


		#返回当前元素的键...
		function key(){
			var_dump(__METHOD__);
			return $this->position;
		}

		#向前移动到下一个元素上..
		function next(){
			var_dump(__METHOD__);
			++$this->position;
		}
	}
	
#	foreach循环输出.
	$arr = new MyIterator();
	foreach($arr as $key => $value){
		echo $key,'==>',$value;
		echo "\n";
	}
	
?>
