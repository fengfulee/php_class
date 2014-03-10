<?PHP
	#这里的一个实例是讲解如何使用PDO的事务处理,以及异常类的使用..
	$dsn = "mysql:host=localhost;dbname=test";
	$username = 'root';
	$password = 'root';
try{
	$db = new PDO($dsn,$username,$password);
	$db->query('set name uft8');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->beginTransaction();	#开始事务处理
	$db->exec('insert into `test`.`user` (`name`,`age`) values ("fengfulee","23");');
	$db->exec('insert into `test`.`user` (`name`,`age`) values ("fengfulee","23");');
	$db->exec('insert into `test`.`user` (`name`,`age`) values ("fengfulee","23");');
	$db->exec('insert into `test`.`user` (`name`,`age`) values ("fengfulee","23");');
	$db->exec('insert into `test`.`user` (`name`,`age`) values ("fengfulee","23");');
	#这里要注意下,我没有sex这个字段.那么也就会报错,这样就执行事务的回滚操作...
	$db->exec('insert into `test`.`user` (`name`,`sex`) values ("fengfulee","男");');
	$db->commit();	#提交事务处理.
}catch(Exception $e){
	$db->rollBack();			#执行回滚操作
	echo "FAILED:".$e->getMessage();
}

#################test
#这里会报一个错误. column `age` not found in table `user`....
#同样前面的操作不能执行到数据库当中....
?>
