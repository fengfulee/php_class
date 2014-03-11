<?PHP
#####################该类是用来实现我们日历的功能########################
class Calendar{
	private $year;
	private $month;

	public function __construct(){
		$this->year = 	$_GET['year']?$_GET['year']:date('Y');		#这个表示获取url参数年,没有则是当前 年
		$this->month = 	$_GET['month']?$_GET['month']:date('m');	#这个表示	参数月,没有这是当前 月
	}


	#这是头部的连接...
	public function header(){
		echo "<table border=1 cellpadding='0' cellspacing='0' bordercolor='#eee'><tr>";
		echo "<td><a href='".$this->lastYear($this->year,$this->month)."'><<<"."</a></td>";
		echo "<td><a href='".$this->lastMonth($this->year,$this->month)."'><<"."</a></td>";
		echo "<td>".$this->year,"</td><td>&nbsp</td><td>",$this->month."</td>";
		echo "<td><a href='".$this->nextMonth($this->year,$this->month)."'>>></a></td>";
		echo "<td><a href='".$this->nextYear($this->year,$this->month)."'>>>></a></td>";
		echo "</tr>";
	}
		
	#上一年..下限是 1970年.
	public function lastYear($year,$month){
		if($year==1970){
			$year=1970;
		}else{
			$year --;
		}

		return "?year=".$year."&month=".$month;
	}
	#上一个月..
	public function lastMonth($year,$month){
		if($month==1&&$year>1970){
			$month = 12;
			$year --;
		}else{
			$month --;
		}

		return "?year=".$year."&month=".$month;
	}

	#下一年 ..上限 2038年.
	public function nextYear($year,$month){
		if($year >=2038){
			$year =2038;	
		}else{
			$year++;
		}

		return "?year=".$year."&month=".$month;
	}
	#下一个月..
	public function nextMonth($year,$month){
		if($month>=12&&$year<2038){
			$year ++;
			$month = 1; }else{
			$month ++;
		}
		return "?year=".$year."&month=".$month;
	}
	#显示日期
	public function week(){
		$arr = array('日','一','二','三','四','五','六');
		echo "<tr>";
		foreach($arr as $key => $value){
			echo "<th>".$value."</th>";
		}
		echo "</tr>";
	}
	#显示天数.
	public function showDay(){
		$weekday = date('w',mktime(0,0,0,$this->month,1,$this->year));
		echo "<tr>";
		for($i=0;$i<$weekday;$i++){
			echo "<td>$nbsp</td>";	
		}
		$dayOfMonth = date('t',mktime(0,0,0,$this->month,1,$this->year));
		for($j=1;$j<$dayOfMonth;$j++){
			$i++;
			echo "<td>".$j."</td>";
			if($i%7==0){
				echo "</tr></tr>";
			}
		}

	}
	public function out(){
		$this->header();
$str = <<<EOF
	<style type="text/css">
		a{
			text-decoration:none;
			color:#bb55bb;
		}
		table{
			width:200px;
			bordercolor:#eee;
			cellpadding:0;
			cellspacing:0;
		}	

		td{
			text-align:center;
			width:16.7%;
		}
	</style>
EOF;
		echo $str;
		$this->week();
		$this->showDay();
	}

}
?>
##############test####################
<?PHP
	header('Content-type:text/html;charset=utf-8');
	$calendar = new Calendar();
	$calendar -> out();
?>
