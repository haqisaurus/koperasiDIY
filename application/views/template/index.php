<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sistem Manajemen Koperasi - Bank BPD DIY</title>
	<link media="screen" type="text/css" href="css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jsFunction.php"></script>
	<script type="text/javascript">
	
		
		
    	
		
	
		
    </script>
</head>

<body>
	<?php
		switch($_GET["hal"])
		{
			case "login" : $hal="login.php"; break;
			case "table" : $hal="table.php"; break;
                        case "formulir" : $hal="formulir.php"; break;
			default : $hal="login.php"; break;
		}
		include $hal;
	?>


</body>
</html>
