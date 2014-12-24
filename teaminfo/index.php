<?php
	header("Content-type:text/html;charset=utf-8");
	session_start();
	$conn = connect();
	$thisid = $_REQUEST['teamid'];
	
	require('../mysql.php');
	
	if(isset($_COOKIE['usercookies'])){
		$thisid = $_REQUEST['teamid'];
		$sqlp= "selcet * from photo where team_id='{$thisid}'";
		$sqlt="select *from team where team_id ='{$thisid}'";
	
		mysqli_query($conn,$sqlp);
		mysqli_query($conn,$sqlt);
	}else{
		echo"<script>alert('还木有登陆，请登录先!')</script>";
		echo"<script>window.location.href='login.php'</script>";
	}
fei
server_fei<7819
?>

<!DOCTYPE html>
<html>
<head>
    <title>队伍信息</title>
    <meta name="viewport" content="width=device-width, 
          initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" /> 
    <link  href="../../js/jquery.mobile/jquery.mobile-1.4.5.min.css" 
           rel="Stylesheet" type="text/css" />
    <link  href="Css/Css6.2/camera.css" 
           rel="Stylesheet" type="text/css" />
    <script src="Js/jquery-1.6.4.js"
           type="text/javascript"></script>
    <script src="../../js/jquery.mobile/jquery.mobile-1.4.5.min.js"
           type="text/javascript"></script>
    <script src="Js/Js6.2/jquery.easing.1.3.js" 
           type="text/javascript"></script>
    <script src="Js/Js6.2/camera.min.js" 
           type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('#camera_wrap_1').camera({
            time: 500,
                thumbnails:false
            })
        });
	</script>
</head>
<body>
<div data-role="page">
   <div data-role="header"><h1>队伍信息</h1></div>
     <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
       <div data-thumb="Images/testimg/thumb/list_1.jpg" 
            data-src="Images/testimg/list_1.jpg">
         <div class="camera_caption fadeFromBottom">
           第<em>1</em> 幅图片的说明文字
         </div>
       </div>
       <div data-thumb="Images/testimg/thumb/list_2.jpg" 
            data-src="Images/testimg/list_2.jpg">
         <div class="camera_caption fadeFromBottom">
           第<em>2</em> 幅图片的说明文字
         </div>
       </div>
       <div data-thumb="Images/testimg/thumb/list_3.jpg" 
            data-src="Images/testimg/list_3.jpg">
          <div class="camera_caption fadeFromBottom">
            第<em>3</em> 幅图片的说明文字
          </div>
       </div>
     </div>
</div>
</body>
</html>
