<!--untuk box pencarian-->

<?php
$flashmessage= $this->session->flashdata('message');
echo '<h1>Home -> '.$menu.'</a></h1>';
//untuk link yang terdapat dalam form cukup 1 saja
echo '<div id="alternate_menu">'.$link.'-'.$link1.'</a></div>';
echo !empty($pagination) ? '<p id="pagination">'.$pagination.'</p>' : '';
$attributes = array('name' => 'delete_form', 'id' => 'delete_form');
echo form_open($form_action, $attributes);
echo !empty($table) ? $table : '';
echo '<input type="submit" value="delete" class="button_blue" />';
echo "</form>";
echo !empty($pagination) ? '<p id="pagination">'.$pagination.'</p>' : '';
//setiap message di taruh dibawah agar halaman di load dulu
echo !empty($flashmessage) ? '<script type="text/javascript">alert("'.$flashmessage.'")</script>' : '';
echo ! empty($message) ? '<script type="text/javascript">alert("'.$message.'")</script>': '';