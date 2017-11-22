<?php
class Conmysql{
	public $servername;
	public $username;
	public $password;
	public $dbname;
	public $con=null;
	public function __construct($servername,$username,$password,$dbname){
		$this->servername=$servername;
		$this->username=$username;
		$this->password=$password;
		$this->dbname=$dbname;
	}
	public function getContention(){
		try {
			echo "1111";
			/*$dsn="mysql:host=$this->servername;dbname=$this->dbname";
		    $this->con= new PDO($dsn, $this->username,$this->password); */
		    $this->con= new PDO("mysql:host=localhost;dbname=test","root"); 
		    echo "链接";
		}
		catch(PDOException $e)
		{
		    echo $e->getMessage();
		}
	}
	public function updateData($sql){
		if($this->con==null){
			$this->getContention();
		}
		$res=$this->con->exec($sql);
		$this->closeCon();
	}
	public function closeCon(){
		$this->con=null;
	}
}

class realConn extends Conmysql{
	public function __construct($servername,$username,$password,$dbname){
		parent::__construct($servername,$username,$password,$dbname);
	
		
	}
	public function updateRealData(){
		$sql="UPDATE text SET num=num+1 WHERE id=1";
		$this->updateData($sql);
	}
}
$praiseCon=new realConn('localhost','root','','test');
$praiseCon->updateRealData();

?>

<?php
	$servername="localhost";
	$username="root";
	//创建链接
	$conn=mysql_connect($servername,$username,"");
	if($conn){
		mysql_select_db("phplesson",$conn);
//		$sql = "INSERT INTO news (title, content, src, time) VALUES ('百度','https://www.baidu.com/','4','2015-9-09')";
//		$sql = "INSERT INTO news (title, content, src, time) VALUES (".$title.",".$news)";
		mysql_query("set names 'utf8'");
		$result=mysql_query($sql);
		if(!$result)
		{
			die("Error".mysql_error());
		}else{
			echo "success";
		}	
	}else{
		die("could not connet");
	}
	mysql_close($con);
?>