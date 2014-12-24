$(function(){
	$("#btn_login").click(function(){
		var frmData = $("#login_form").serialize();
		$.ajax({
			type:POST,
			url:"login.php",
			cache:false,
			data:frmData,
			success: function(data){
				if(data == "False"){
					$("#error").html("password or user error! input again");
				}
			}
		})
		return false;
	})
})
