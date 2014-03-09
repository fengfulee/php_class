<?PHP
#	该类主要是实现了PDO....算是一个小小的尝试吧.

#	这里需要定义一个路径,来引入我们的配置文件..
define('BASE_DIR',dirname(__FILE__).'/');
class PDO_Mysql{
	#定义一个静态的PDO对象...初始化为NULL.
	private static $instance = null;
	#实例化对象,这里采用的也是单例模式...
	static function instance(){
		if(self::$instance){
			return self::$instance;
		}

		$ini = BASE_DIR.'config.ini';
		$parse = parse_ini_file($ini,true);	#这里的parse_ini_file()表示获取配置文件的信息..
							#这里还要说明的一点是:参数为true表示能够返回多维数组,否则不能这样返回..
		if(!is_array($parse)) return;		
		#默认的形式是:
		#$db = new PDO('mysql:host=localhost;dbname=test',$user,$password,$options);
		$driver = $parse['db_driver'];
		$dsn = $driver.":";		#也可写成 $dsn = "{$driver}:",或者 $dsn = "${driver}:";
		$user = $parse['db_user'];
		$password = $parse['db_password'];
		$options = $parse['db_options'];
		$attributes = $parse['db_attributes'];
		#[dsn] 里面存放的是参数
		foreach($parse['dsn'] as $key => $value){
			$dsn .= $key."=".$value.";";
		}
		self::$instance = new PDO($dsn,$user,$password,$options);
		#[db_options]里面存放的是属性..
		foreach($attributes as $k => $v){
			self::$instance->setAttribute(constant("PDO::{$k}"),constant("PDO::{$v}"));
		}

		return self::$instance;
	}	
	#这里很重要,调用了__callStatic方法....当类里面没有该静态方法时调用.
	public static function __callStatic($name,$args){
		$callback = array(self::instance(),$name);	#这里就是进行实例化的一步了...然后获取到PDO的实例化对象继续进行操作.
		return call_user_func_array($callback,$args);	#call_user_func_array();自动调用,无需实例化...
	}
}//end of clazz..


	##############test######################	
	#下面有些方法就是执行了PDO封装的方法了...
	$stmt = PDO_Mysql::prepare('select * from user;');
	$stmt->execute();		#执行内容...
	print_r($stmt->fetchAll());	#获取全部的内容..
	$stmt->closeCursor();		#关闭指针...

?>
