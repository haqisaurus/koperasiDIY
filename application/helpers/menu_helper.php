<?php
function showMenu() {
        $CI = & get_instance();
        $CI->load->model('menu_model');
       
        echo "<div id='nav'>";
        echo '"<ul id="nav-one" class="nav">';
        foreach ($CI->menu_model->getMenu(0, $CI->session->userdata('group_id'))->result() as $row) {
            echo " <li>" . anchor($row->menu_path, ucwords($row->menu_name));
            $i=0;
            foreach ($CI->menu_model->getMenu($row->menu_id, $CI->session->userdata('group_id'))->result() as $row1) {
                $i++;
            }
            $n=$i;
            $i=0;
            if($n>0)
                {
                    $arrow = "<img src='".base_url("images/bawah.gif")."' class='arrow'/>";
                }
                else{
                    $arrow = "";
                }
                echo $arrow;
            foreach ($CI->menu_model->getMenu($row->menu_id, $CI->session->userdata('group_id'))->result() as $row1) {
                if($n>0 && $i==0)
                {
                    echo "<ul>";
                }
                
                if($row1!=" ")
                {
                echo " <li>" . anchor($row1->menu_path, ucwords($row1->menu_name)) . "</li>";
                }
                $i++;
                if($i==$n)
                {
                   echo "  </ul> ";
                }
            }
            
            echo "  </li> ";
        }

        echo "</ul>";
        echo "<div class='user' style='text-decoration: none'><label>Wellcome</label>::&nbsp;";
        echo "<a href='#' rel='link to profil'>" . $CI->session->userdata('username') . "</a> &nbsp;||&nbsp;";
        echo anchor('login/login/process_logout', 'Logout');
        echo "</div>";
        echo "</div>";
    }

?>