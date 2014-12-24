<?php
	require('mysql.php');
	session_start();
	$conn = connect();
	
	$sql ="select * from team order by team_poll asc";
	
	$res = mysqli_query($conn,$sql);
	$arr = array();
	$he = mysqli_fetch_array($res);
	while($sort = mysqli_fetch_array($res)){
		$arr[$sort['team_id']] =$sort;
	}
	print_r($arr);
	
?>