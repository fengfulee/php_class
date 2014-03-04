<?PHP
#	编写对文件进行压缩和读取的类....

class Bzip{
	
#	压缩函数...
	static public function compress($in_file,$out_file){
		if(!file_exists($in_file)||!is_readable($in_file)){
			echo "文件不存在或者文件不可读!";
			return false;
		}
		if((!file_exists($out_file)&&!is_writeable(dirname($out_file)))||(file_exists($out_file)&&!is_writeable($out_file))){
			echo "文件不存在,但是文件夹不可写,或者文件存在,但是文件不可写!";
			return false;
		}
		$in = fopen($in_file,'r');
		$out = bzopen($out_file,'w');
		while(!feof($in)){
			$buffer = fgets($in,4096);
			bzwrite($out,$buffer,4096);
		}

		fclose($in);
		bzclose($out);
	#	将原始文件删除.
		unlink($in_file);
		return true;	#返回 true ,表示 压缩成功!
	}

#	解压缩文件..
	public static function uncompress($in_file,$out_file){
		if(!file_exists($in_file)||!is_readable($in_file)){
			echo "压缩文件不存在或者文件不可读!";
			return false;
		}
		if((!file_exists($out_file)&&!is_writeable(dirname($out_file)))||(file_exists($out_file)&&!is_writeable($out_file))){
			echo "写入文件不存在,但是文件夹不可写,或者文件存在,但是文件不可写!";
			return false;
		}
		$in = bzopen($in_file,'r');
		$out = fopen($out_file,'w');
		while($buffer=bzread($in,4096)){
			fwrite($out,$buffer,4096);
		}
		bzclose($in);
		fclose($out);
	#	将压缩文件删除..
		unlink($in_file);
		return true;
	}
}
	
#########################test############################
	$flag = Bzip::compress('./test','./test.bzip');
	$flag = Bzip::uncompress('./test.bzip','./test');	
?>
