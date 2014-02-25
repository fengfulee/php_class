<?PHP
#	cookie 的帮助类....
	/*
		配置文件中的数组..
		$ALL = array(
			'cookie' => array(
					'prefix'=> 'ffl_',
					'duration' => 3600,
					'hashprefix' => 'ffl@_',
					),
		);
	*/
class Cookie{
#	开始设置cookie值...
	private static $prefix;
	private static $duration;
	private static $hashprefix;
	function __construct(){
		#将全局的配置中获取有用的数据...
		global $ALL;
		self::$prefix = $ALL['cookie']['prefix'];
		self::$duration = $ALL['cookie']['duration'];
		self::$hashprefix = $ALL['cookie']['hashprefix'];
		echo self::$duration;
	}
#	set 方法
	function set($key,$value,$duration=0){
		//判断是否设置duration.
		$duration = $duration?$duration:self::$duration;
		setcookie(self::$prefix.$key,$value,time()+$duration);
	}

#	 get 方法..
	function get($key){
		return $_COOKIE[self::$prefix.$key];
	}

#	对 cookie值进行加密过程,这里要注意,加密之后是无法读取的
#	用法:比如用户登录成功之后,对用户名进行加密,然后写入cookie中
#	下次用户再次登录,将用户名拿出,进行加密后比对,如果成功,则允许登录..否则不允许,这是一种安全的机制...

	function makeHash($value){
		return md5(self::$hashprefix.$value);	
	}

#	设置 加密过的cookie值..
	function setHash($key,$value,$duration=0){
		$this->set($key,$this->makeHash($value),$duration);		
	}

#	检查 cookie值..
	function checkHash($key,$value){
		return ($this->get($key)==$this->makeHash($value))?TRUE:FALSE; 
	}

#	清除cookie值...将有效时间更改为过去,即为过期..
	function clear($key){
		$this->set($key,null,-3600);	
	}
 }//end of clazz...
?>
