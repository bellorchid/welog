<!DOCTYPE html>
<html>
<head>
	<title>Carnival Platform</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=1">
	<!--script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<!--script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	<script src="login.js"></script-->
    <link rel="stylesheet" href="js/jquery.mobile/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="css/mycss.css">
	<script src="js/jquery.js"></script>
   	<script src="js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
   	<!--script src="js/show.js"></script-->
</head>
<body>
	
    <!--enter page , login required! -->
  
  <div data-role="page" id="loginpage">
    	<div data-role="header">
        	<h1>Login Required</h1>
        </div>
        <div data-role="content">
        	<form method="post" action="dologin.php" id="login_form" data-ajax="false">
            	<label for="user">UserName</label>
                <input name="user" id="user" type="tel" required/>
                <label for="pwd">Password</label>
                <input name="pwd" id="pwd" type="password" required/>
                <label for="imgcode">Verify</label>
                <input type="text" name="authcode" id="authcode" required/><img id="verification" src="verify.php?r=<?php echo'rand()';?>" width="100" height="30"/><a  href="javascript:void(0)" onClick="document.getElementById('verification').src='verify.php?r='+Math.random();" id="changeverify">Change</a><br>			
                <div id="error">
                <?php 
					if(isset($_COOKIE['loginError'])){
                 		echo $_COOKIE['loginError']; 
            		} 
				 ?>
                </div>
                <input type="submit" name="btn_login" value="Login" id="btn_login"/>
            </form>
        </div>
    </div>
    
</body>
</html>
