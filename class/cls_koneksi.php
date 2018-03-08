<?php
//
class koneksi{
	private $host;
	private $username;
	private $password;
	private $database;
 
	public function koneksi(){
		$host = "localhost";
		$username = "root";
		$password = "";
		$database =	"coba";
		$konek = new mysqli($host,$username,$password,$database);
	}
	public function periksa()
	{
		if (mysqli_connect_errno()) 
		{
    		printf("Connect failed: %s\n", mysqli_connect_error());
    		exit();
		}
	}

	public function putus()
	{
		$konek->close();
	}

	public function tampilkan_tabel($query)
	{	
		//$datas = array();
		$sql=$konek->query($query);

		while($row=$sql->fetch_assoc()){
			$datas[]=$row;
		}
		return $datas;
	}

}

?>

