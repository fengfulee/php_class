<?PHP
#####这是一个完整的使用PDO的例子....
#并且用到了 PDO的持久连接..
	$dsn = "mysql:host=localhost;dbname=test";
	$username="root";
	$password="root";
	$dbh = new PDO($dsn,$username,$password);
	$dbh-> exec('set name utf8');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

#持久化连接..
	$sql = "insert into `test`.`user` (`name`,`password`) values (:name,:password)";
	$stmt = $dbh->prepare($sql);
	#这里的prepare 会返回一个 statement的持久化对象.然后指向statement的方法...execute.
	#execute方法传递参数,能够传递数组...
	$stmt->execute(array(':name'=>'fengfulee',':password'=>'root'));
	echo $dbh->lastinsertid(),"\n";

#执行修改操作..
	$sql = "UPDATE `user` SET `password`=:password WHERE `id` = :userId";
	$stmt = $dbh -> prepare($sql);
	$stmt->execute(array(':userId'=>10,':password'=>md5('root')));
	echo $stmt->rowCount(),"\n";

#执行删除操作..
	$sql = "DELETE FROM `user` where `name` LIKE '%a%'";
	$stmt = $dbh -> prepare($sql);
	$stmt ->execute();
	echo $stmt->rowCount(),"\n";

#查询操作..
	$sql = "SELECT * from `user` where `name` like :username";
	$stmt =  $dbh -> prepare($sql);
	$stmt->execute(array(':username'=>'fengfu%'));
	print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

?>
