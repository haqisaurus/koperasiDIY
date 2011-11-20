<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>::Koperasi : LOGIN ::</title>
        <link rel='stylesheet' type='text/css' href='<?php echo base_url() . "css/style.css" ?>'/>
        <link rel='stylesheet' type='text/css' href='<?php echo base_url() . "css/dot-luv/jquery-ui-1.8.16.custom.css" ?>'/>

        <script type="text/javascript" src="<?php echo base_url() . 'js/jquery-1.6.2.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/jquery-ui-1.8.16.custom.min.js'; ?>"></script>
        <script type="text/JavaScript">
            $(document).ready(function(){
                $('#username').focus();
            });

            //cek form
            $().ready(function(){
                $("#login_form").submit(function(){
                    if($("#username").val()==""){
                        alert("Username harus diisi");
                        $("#username").focus();
                        return false;
                    }else if($("#password").val()==""){
                        alert("Password harus diisi");
                        $("#password").focus();
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body>
        
            
        
        <table id="login_interface">
		<tr>
			<td valign="middle" align="center">
				<div id="login_interface2">
                <?php
            $attributes = array('name' => 'login_form ', 'id' => 'login_form');
            echo form_open('/login/login/process_login', $attributes);
            ?>
					<table>
						<tr>
							<td>

								Username
							</td>
							
							<td>
								<input name="username" id="username" type="text" class="TextBox"  onfocus="this.className='TextBoxOn'" onblur="this.className='TextBox'" value="<?php echo set_value('username'); ?>" size="25" maxlength="25" />
							</td>
						<tr>
						<tr>
							<td>

								Password
							</td>
							
							<td>
								<input name="password" id="password" type="password" class="TextBox"  onfocus="this.className='TextBoxOn'" onblur="this.className='TextBox'" value="<?php echo set_value('password'); ?>" size="25" maxlength="25" />
							</td>
						<tr>
                        <tr>
                        	<td colspan="2" align="right"><input type="submit" value="submit" class="button_blue" /></td>

                        </tr>
                        <tr>
                    
                    <td height="25" colspan="2" align="center" valign="middle">
                        <?php echo form_error('username', '<p id="message"">', '</p>'); ?>
                        <?php echo form_error('password', '<p id="message"">', '</p>'); ?>
                        <?php
                        $message = $this->session->flashdata('message');
                        echo $message == '' ? '' : '<p id="message">' . $message . '</p>';
                        ?>
                    </td>
                </tr>
					</table>
                    </form>
				</div>
				Copyright RPI &copy; 2011
			</td>
		</tr>
	</table>

        
        
    </body>
</html>

