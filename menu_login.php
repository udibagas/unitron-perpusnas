<?php

	@session_start();
	if(isset($_SESSION['username'])==true)
	{
		echo "<meta http-equiv='refresh' content='0;URL=media.php?page=ikhtisar' />";
	}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Selamat Datang di SMADING PERPUSNAS 2016</title>

	<link rel="stylesheet" type="text/css" href="less/login.css" />

    <!-- Bootstrap Core CSS -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Core JS -->
	<script src="js/bootstrap.min.js"></script>

<!--  include JQuery Library -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ajaxlogin.js"></script>
<script>
$(document).ready(function(){

	// parameter is an associate array with 9 elements, only 2 are compulsory, order not important
	$(".container").ajaxLogin({

		action: "less/login.php",

		success_redirect_page: "redirect.php",
		success_response: "true",
		error_msg: "Gagal Login, Silahkan Ulangi !",

		username_label: "Username",

		password_label: "Password",
		submit_label: "Log In",

		header_label: "Silahkan Login",
		progress_image_src: "images/progress_image.gif"

	});

});
</script>

</head>

<body>


<div class="container"></div>

<div style="text-align: center;">
<p>Copyright SMADING PERPUSNAS <?= date('Y') ?></p>
</div>

</body>
</html>
