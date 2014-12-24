$(function() {
	$("#btn_login").click(function() {
		var frmdata = $("#login_form").serialize();
		
		$.ajax({
			
			type:"POST",
			url:"dologin.php",
			cache:false,
			data:frmdata,
			success: function(data){
				if(data == "True") {
					$("#error").html("login success!")
				}else{
					$("#error").html("login error!");
					$("#authcode").val("");
					$("#pwd").val("");
					$("#user").val("");
				}
			}
		})
		return false;
	})
})