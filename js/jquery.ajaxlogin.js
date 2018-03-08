
(function($) {
	$.fn.ajaxLogin = function(args){

		if (args.length == 0 || args.action == undefined || args.success_redirect_page == undefined)   {
			alert ("Missing parameters!");
			return
		};

		this.html('<div class="container"><section class="login-form"><div class="panel panel-default"><div class="panel-heading text-center">Welcome to SMADING PERPUSNAS</div><div class="panel-body"><form action="" id="ajaxlogin_action"><div><label for="username">E-mail</label><input type="email" placeholder="Email" required id="ajaxlogin_username" class="form-control input-lg" /></div><div><label for="password">Password</label><input type="password" placeholder="Password" required id="ajaxlogin_password" class="form-control input-lg" /></div>.<div id="progress"><input type="submit" value="Log in" id="ajaxlogin_submit" class="btn btn-lg btn-info btn-block" /></div></form></div><div><h2 align="center"><a class="btn btn-success btn-lg" href="registrasi.php" style="text-decoration:none;">Registrasi</a> &nbsp; <a class="btn btn-danger btn-lg" href="forget.php" style="text-decoration:none;">Lupa Password !!</a></h2><br></div></div></section>');

		$("#ajaxlogin_action").attr("action", args.action);

		success_redirect_page =  args.success_redirect_page;

		if (args.success_response != undefined) {
			success_response =  args.success_response;
		} else {
			success_response =  "true";
		};

		if (args.error_msg != undefined) {
			error_msg =  args.error_msg;
		} else {
			error_msg =  "Sign in unsuccessful!";
		};

		if (args.username_label != undefined) {
			$("#ajaxlogin_username").attr("placeholder", args.username_label);
		};

		if (args.password_label != undefined) {
			$("#ajaxlogin_password").attr("placeholder", args.password_label);
		};

		if (args.submit_label != undefined) {
			$("#ajaxlogin_submit").attr("value", args.submit_label);
		};

		if (args.header_label != undefined) {
			$("#ajaxlogin_header").html(args.header_label);
		};

		var progress_image_src = "";
		if (args.progress_image_src != undefined) {
			progress_image_src = args.progress_image_src;
		};

		$("#ajaxlogin_action").submit(function(){

         	var username=$("#ajaxlogin_username").val();
         	var password=$("#ajaxlogin_password").val();
		 	var oldcontent=$("#progress").html();

         	$.ajax({
            	type: "POST",
            	url: "less/login.php",
            	data: "username="+username+"&password="+password,
            	success: function(response){
              		if(response == success_response)
              		{
                	 	window.location = success_redirect_page;
              		}
              		else
              		{
						if (progress_image_src != ""){
				  			$("#progress").html(oldcontent);
						}
                  		alert(error_msg);
					}
            	},
            	beforeSend: function()
            	{
					if (progress_image_src != ""){
						$("#progress").html('<p align="center"><img src="'+progress_image_src+'" alt="Tunggu Proses.." id="ajaxlogin_progress_image" /></p>');
					}
            	}
        	});

        	return false;
    	});

	return this;
	};

}( jQuery ));
