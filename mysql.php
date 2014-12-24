<?php
function connect(){
	$db_host="localhost";
	$db_username="root";
	$db_password="root";
	$db_database="plat";
	$db = mysqli_connect($db_host,$db_username,$db_password,$db_database) or die("Connect Error:".mysql_errno().":".mysql_error());	
	mysqli_set_charset($db,'utf8');
	//mysqli_select_db($db,$db_database) or die("open error");
	
	return $db;
}

/*function insert($data,$table,$array){
	$keys = join(",",array_keys($array));
	$vals = "'".join(",",array_values($array))."'";
	
	$sql = "insert {$table}($keys) values({$vals})";
	
	mysqli_query($data,$sql);
	
	return mysqli_insert_id;
}

function update($data,$table,$array,$where=NULL){
	foreach($array as $key=>$val){
		if($str==NULL){
			$sep=" ";
		}else{
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
	$sql="updata{$table} set {$str}".($where==NULL?NULL:"where".$where);
		
	mysqli_query($data,$sql);
		
	return mysql_affected_rows();
}

function delete($data,$table,$where){
	$where = $where==null?null:"where".$where;
	$sql = "delete from {$table} {$where}";
	mysqli_query($data,$sql);
	
	return mysqli_affected_rows();
}


function fetchone($data,$sql){
	$result=mysqli_query($data,$sql);
	if($result){
		$row=mysqli_fetch_array($result);
	}
	else{
		$row=NULL;
	}
	return $row;
}

function fetchall($data,$sql){
	$result=mysqli_query($data,$sql);
	while(@$row = mysqli_fetch_array($result)){
		$rows[]=$row;
	}
	return $rows;
}*/

?>