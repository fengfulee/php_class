<?PHP
#	对字符串进行编码转换的类...
class WordEx{
#	将UTF8编码转化为GBK编码,//IGNORE表示在转换时忽略错误..	
	static function U2G($word){
		return iconv("UTF-8","GBK//IGNORE",$word);
	}
#	将GBK编码的字符串转化为UTF_8编码...
	static function G2U($word){
		return iconv("GBK","UTF-8//IGNORE",$word);
	}
#	将有关处理大小写转化的函数集合在一起,然后统一调配.
	static function strTo($str,$type){
		if(empty($str))  return false;
		switch($type){
			case 1:
			case "upper":
				$str = strtoupper($str);
			break;
			case 2:
			case "lower":
				$str = strtolower($str);
			break;	
			case 3:
			case "ucfirst":
				$str = ucfirst($str);
			break;
			case 4:
			case "ucwords":
				$str = ucwords($str);
			break;
			default:
				return $str."<br/>";
		}
		return $str."<br/>";
	}
}	
?>
