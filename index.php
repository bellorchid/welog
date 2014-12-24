；；<?php
	header("Content-type:text/html;charset=utf-8");
	require_once('mysql.php');
	if(isset($_COOKIE["usercookies"])){
		$user = $_COOKIE["usercookies"];
	}else{
		$user = "stranger";
	}
	$url = $_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING'];//获取当前url
	$conn = connect();
	$sqlp = "select * from team where team_type = 1";
	$sqlc = "select * from team where team_type = 0";
	$resc=mysqli_query($conn,$sqlc);
	$resp = mysqli_query($conn,$sqlp);
	//print_r($res);
	
	$sql2="select * from team where team_type=1 order by team_poll desc";
	$res2=mysqli_query($conn,$sql2);
	
	$sql3="select * from team where team_type=0 order by team_poll desc";
	$res3 = mysqli_query($conn,$sql3);
	$sql4 = "select * from user where user_name='{$user}'";
	//print_r($user);
	$res4 = mysqli_query($conn,$sql4);
	
	$sql5 = "select * from team order by team_poll desc";
	
	$res5 = mysqli_query($conn,$sql5);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Carnival Platform</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=1">
	<link rel="Shortcut Icon" href="my.ico" type="image/x-icon">
	<link rel="stylesheet" href="js/jquery.mobile/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="css/mycss.css">
	<script src="js/jquery.js"></script>
   	<script src="js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
   	<!--script src="js/show.js"></script-->
    <script language="javascript">
	$(function(){
		$(".vote").click(function(){
			var id = $(this).attr('id').split('_')[1];
			$.post(
				'checkvote.php',
				{
					teamid:id,
				},
				function(data,status) {
					if(data==false){
						window.location.href="login.php";
					}else{
						if(data=="您没票了！！"){
							alert(data);
							$(".vote").attr("disabled","ture");
						}else{
							$("#count1_"+id).html(data);
							$("#vote_"+id).attr("disabled","ture");
						}
					}if(data=="error"){
						
					}
				}
			);
		});
	});
	
	$(function(){
		$("#imgup").click(function(){
			var name = $("#file").val();
			
			
			$.post(
				'upload.php',
				{
					photo:name,
				},
				function(data){
					$("#imgshow").attr("src",data);
					//alert(data);
				}
			)
		});
	});
	$(document).on("pageinit","#home",function(){
		$("#home_content").on("swiperight",function(){
			$("#panelone").panel('open');
			//$(".vote").removeAttr("disabled");
		});
		$("#panelone").on("swipeleft",function(){
			$("#panelone").panel('close');
		})
	});
	
	
	$(document).on("pageinit","#home",function(){
		$("#home_content").on("swipeleft",function(){
			$("#paneltwo").panel('open');
				
		});
		$("#paneltwo").on("swiperight",function(){
			$("#paneltwo").panel('close');
		})
		/*$("#imgup").tap(function(){
			$("#imgdisplay").css("display","none");
		})*/
	});
	</script>
</head>
<body id="fbody">
	<div data-role="page" id="home" class="ui-responsive-panel" style="font-family:FirstFont">
    	
    	<div data-role="header">	
        	<a data-role="button" id="user_info" data-icon="home" href="#panelone" data-theme="c" data-iconpos="notext" style="margin-left:7px;">User</a>
        <h1><img src="img/fav.ico" alt="tubiao" id="headimg"/><?php echo $user;?></h1>
            <a data-role="button" id="setting" data-icon="bars" href="#paneltwo" data-iconpos="notext" style="margin-right:7px;" onClick="javascript:void(0)"></a> 
        </div>
        <!--here are team infos-->
        <div data-role="content" id="home_content" align="center">
        	<!--team 1-->
            <div data-role="collapsible-set" id="product" data-collapsed-icon="false" style="text-align:center">
            <div data-role="collapsible" id="product" data-collapsed-icon="false">
            <h2><span class="center" style="font-family:jya">产品组</span></h2>
				<?php 
					while($infop = mysqli_fetch_array($resp)){
				?>
			
					<div data-role="collapsible" id="productteam" data-collapsed-icon="false">
                		<h4><span id="name" class="teamproduct" style="font-family:jya; font-size:16px"><?php echo $infop['team_name'];?></span><span class="ui-li-count" id="count1_<?php echo $infop['team_id'];?>"><?php echo $infop['team_poll'];?></span></h4>
                		<p><strong><?php echo $infop['team_nick']?></strong></p>
                        <p style="text-align:left; text-indent:2em; font-family:FirstFont;"><?php echo $infop['team_info']?></p>
                        <p style="text-align:left"><strong>技术架构：</strong><?php echo $infop['team_frame']?></p>
            <!--/div>
            <div id="support" align="center"-->
                		<section id="myvote_<?php echo $infop['team_id'];?>" name="myvote">
                        	<label for="thisurl"></label>
							<input type="hidden" name="teamid" id="teamid_<?php echo $infop['team_id'];?>" value="<?php echo $infop['team_id'];?>"/>
							<button data-inline="true" id="vote_<?php echo $infop['team_id'];?>" class="vote">vote</button>
                		</section>
    	    		</div>
            	<?php
					}
				?>
            </div>
            </div>
            
            
            <div data-role="collapsible-set" id="creative" data-collapsed-icon="false">
            <div data-role="collapsible" id="create" data-collasped-icon="false" >
            	<h2><span class="center" style="font-family:jya">创意组</span></h2>
				<?php 
					while($infoc = mysqli_fetch_array($resc)){
				?>
			
					<div data-role="collapsible" id="productteam" data-collapsed-icon="false">
                		<h4><span id="name" class="teamcreate" style="font-family:jya; font-size:16px
                        ;"><?php echo $infoc['team_name'];?></span><span class="ui-li-count" id="count1_<?php echo $infoc['team_id']?>"><?php echo $infoc['team_poll'];?></span></h4>
                		<p><strong><?php echo $infoc['team_nick']?></strong> </p>
                        <p style="text-align:left; text-indent:2em; font-family:FirstFont"><?php echo $infoc['team_info']?></p>
                        <p style="text-align:left"><strong>技术架构：</strong><?php echo $infoc['team_frame']?></p>
            <!--/div>
            <div id="support" align="center"-->
                		<section id="myvote_<?php echo $infoc['team_id']?>" method="post">
                        <label for="id"></label>
                        <input name="id" value="<?php echo $infoc['team_id']?>" type="hidden" id="teamid">
                		<button id="vote_<?php echo $infoc['team_id']?>" class="vote" data-inline="true">vote</button>
                		</section>
    	    		</div>
            	<?php
					}
				?>
            </div>
            </div>
        <!-- user infos-->
		</div>
        <div data-role="panel" id	="panelone" data-position="left" data-position-fixed="false" data-display="reveal" style="text-align:center">
        	<section id="upfield">
                <img alt="head" src="img/myphoto/<?php echo rand(1,18)?>.png" style="width:20%; height:20%"/>
                <h1 class="red"><?php echo $user;?></h1>
            </section>
            <div id="panel_info">
            	<div></div>
            </div>
            <div data-role="content">
            <section>
            <?php 
				while($info4 = mysqli_fetch_array($res4)){ 
			?>
                <img id="imgdisplay" class="imgshow" alt="我的图片" src="<?php echo $info4['user_img']?>" style="width:100%; height:40%;"/>
            <?php
				}
			?>
            </section>
            <form id="uploadimg" name="up" action="upload.php" method="post" enctype="multipart/form-data" data-ajax="false">
            	<label for = "photo"></label>
            	<input type="file" id="file" name="file" accept="image/jpeg,image/png,image/gif,image/bmp">
                <input data-role="button" type="submit" data-icon="arrow-u" data-inline="true" id="imgup" onClick="change()" data-iconpos="left" value="传照片">
            </form>
			</div>
            
            
    	</div>
        <div data-role="panel" id="paneltwo" data-position="right" data-display="overlay">
            <div data-role="header" data-theme="c">
            	<h2><span style="font-family:FirstFont">Rank</span></h2>
            </div>
            <div data-role="content" align="center">
            	<ul data-role="listview">
                	<div data-role="collapsible" data-theme="e" data-collapsed-icon="false">
                    <h2><span style="font-family:FirstFont">Top 10 Groups</span></h2>
                    <?php
					
						$i=0;
						while($info5=mysqli_fetch_array($res5)){
							$i++;
							
                    ?>
                    	<li><a data-role="button" style="font-family:FirstFont"><?php echo $info5['team_name'];?><span class="ui-li-count"><?php echo $info5['team_poll'];?></span></a></li>
                    <?php
					
							if($i<10){
								continue;
							}else{
								break;
							}
						}
					?>
                    </div>
                    <div data-role="collapsible" data-collapsed-icon="false">
                   	<h2 ><span style="font-family:FirstFont">Product Groups</span></h2>
                    <?php
						while($info=mysqli_fetch_array($res2)){ 
					?>
                		<li><a data-role="button" style="font-family:FirstFont"><?php echo $info['team_name'];?><span class="ui-li-count"><?php echo $info['team_poll'];?></span></a></li>
                    <?php
						}
					?>
                    </div>
                    <div data-role="collapsible" data-theme="e" data-collapsed-icon="false">
                    <h2><span style="font-family:FirstFont">Creative Groups</span></h2>
                    <?php
						while($info1=mysqli_fetch_array($res3)){
                    ?>
                    	<li><a data-role="button" style="font-family:FirstFont"><?php echo $info1['team_name'];?><span class="ui-li-count"><?php echo $info1['team_poll'];?></span></a></li>
                    <?php
						}
					?>
                    </div>
                    
                    
                </ul>
            </div>
    	</div>
    <!--home page over here-->
    </div>

</body>
</html>