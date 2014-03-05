<?PHP
	#	通过PHP 的 apc(Advanced PHP Cache )来进行缓存...

class CacheAPC extends CacheAbstract{
	#为缓存设置一个前缀.....

	protected $prefix = "fengfulee_";
	
	#将前缀添加上去..这样后面的好弄..
	private add_prefix($key){
		return $this->prefix.'_'.$key;
	}
	public function __construct(){
		if(!extension_loaded('apc')){
			echo "系统不支持APC缓存扩展..";
			die;	
		}
	
	}


	#	保存缓存变量..
	public function store($key,$value){
		return apc_store($this->add_prefix($key),$value);
	}

	#	读取变量..
	public function fetch($key){
		return apc_fetch($this->add_prefix($key));
	}

	#清空缓存..
	public function clear(){
		apc_clear_cache();
	}

	#删除缓存单元..
	public function delete($key){
		apc_delete($this->add_prefix($key));
	}

	





}
?>
