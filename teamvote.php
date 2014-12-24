<?php 
	header("Content-type:text/html;charset=utf-8");
	session_start();
	require('mysql.php');
	if(isset($_COOKIE["usercookies"])){
		$stus = true;
		$conn = connect();
		$user = $_COOKIE["usercookies"];
		$sql = "select user_poll from user where user_name='{$user}'";
		$res = mysqli_fetch_array(mysqli_query($conn,$sql));
		$team = $_REQUEST['teamid'];
		//print_r($team);
		//print_r($res['user_poll']);
		if($res){
			if($res['user_poll'] <1){
				$stus ="没票了";
				echo $stus;				
				return;				
			}else{
				
				
				$tem = $res['user_poll'] - 1;
				$sql = "update user set user_poll = '{$tem}' where user_name = '{$user}'";
				$sql1 = "update team set team_poll = team_poll+1 where team_id = '{$team}'";
				$sql2 = "select team_poll from team where team_id='{$team}'";
				$chk = mysqli_query($conn,$sql);
				$chk1 = mysqli_query($conn,$sql1);
				$chk2 = mysqli_query($conn,$sql2);
				
				$stus= mysqli_fetch_array($chk2);
				
				echo "<script>alert('投票成功!')</script>";
				echo"<script>window.location.href='index.php'</script>";
				return;
			}
		}else{
			$stus = "error";
			echo $stus;
			return;
		}
	}else{
		
		$stus = false;
		header("location:login.php");
		echo $stus;
		
		return;
	
	}
	
?>