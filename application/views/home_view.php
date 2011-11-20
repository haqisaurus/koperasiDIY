<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Sistem Manajemen Koperasi - Bank BPD DIY</title>
        <link rel='stylesheet' type='text/css' href='<?php echo base_url() . "css/style.css" ?>'/>
        <link rel='stylesheet' type='text/css' href='<?php echo base_url() . "css/dot-luv/jquery-ui-1.8.16.custom.css" ?>'/>

        <script type="text/javascript" src="<?php echo base_url() . 'js/jquery-1.6.2.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/jquery-ui-1.8.16.custom.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/jsFunction.js'; ?>"></script>
        
    </head>
    <body>
        <div id="wrap">
            <div id="header">
                <div id="header2">
                    <!--[if gte IE 6]>
                        <img src="images/header_01.gif" alt="logo_bpd" style="float:left" />
                    <img src="images/header_kanan.gif" alt="logo_bpd" style="float:right" />
                    <div class="clear"></div>
                    <![endif]-->
                </div>
            </div>
            <div id="menu">

                <?php
echo showMenu();
?>

<!--                <div id="welcome">Selamat Datang, <span style="color:#fff; font-style:normal; text-decoration:underline;">Administrator</span></div >-->
            </div>
            <div id="content">
            <?php

$this->load->view($content);
?>
            </div>
            
        </div>
        <div id="footer">
            Sistem Manajemen Koperasi Bank BPD - Copyright  RPI &copy; 2011 
        </div>
    </body>
</html>

