<?PHP
#	FTP helper 类,帮助进行 远程服务器的 ftp管理...
class FTP
	var $conn_id;	#FTP 连接句柄..
	var $timeout;	#设置超时时间...
	#	连接 ftp..
	function conn($host,$port,$username='anonymous',$password=''){
		#判断$host是否是数组,如果是,表示所有的参数都从这里获得,否则,分别判断这些值.
		if(is_array($host)){
			$host = $host[0];
			$port = $host[1];	
			$username = $host[2];	
			$password = $host[3];	
		}
		$this->conn_id = ftp_connect($host,$post,$this->timeout);
		if(!$this->conn_id)
			return false;
		$login = ftp_login($this->conn_id,$username,$password);
			return ($logn==true)?true:false;
	}	

	# 	下面设置超时时间....
	#	这里要注意:必须在调用 conn函数之前调用该函数,否则将不会生效,因为那时FTP已经连接上了.
	function setTimeout($time){
		if(is_numeric($time)){
			$this->timeout = $time;
		}else{
			return false;
		}
	}
	#	查看当前目录....
	function pwd(){
		if(!$this->conn_id) return false;
		return ftp_pwd($this->conn_id);
	}	

	#	建立文件夹,这里要注意,这里建立文件夹是指当前文件夹,即童工ftp_chdir()进入的目录中..
	function mkdir($directory){
		if(!$this->conn_id) return;
		#	下面的写法非常好.
		return ftp_mkdir($this->conn_id,$directory)==$directory;
		#因为ftp_mkdir函数如果建立成功,将会返回建立的文件夹名称.这里用== 表示 如果相等则返回true,否则返回false;
	}

	#	删除文件夹...该方法返回bool值..
	function rmdir($directory){
		if(!$this->conn_id) return;
		return ftp_rmdir($this->conn,$directory);
	}
	
	#	删除文件,这里要注意,这里加入的路径是文件的绝对路径...没有相对路径的说法....
	function delete($directory){
		if(!$this->conn_id) return;
		return ftp_delete($this->conn_id,$directory);
	}

	#	将本地的文件发送到远程的FTP服务器上面..
	function put($local,$remote){
		if(!$this->conn_id) return;
		return ftp_put($this->conn,$remote,$local,FTP_ASCII);
		#这里的FTP_ASCII表示的是文本模式,FTP_BINARY表示二进制模式...
	}
	#	关闭FTP连接..
	function close(){
		if(!$this->conn_id) return;
		ftp_quit($this->conn_id);
		$this->conn_id = false;
	}






?>
