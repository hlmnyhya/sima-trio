<?php
foreach ($menu as $m ) {
    
    echo $m['id_menu']."-".$m['menu']."<br/>";
    $submenu = $this->mmenu->SubMenu($m['id_menu']);
    foreach ($submenu as $sub ) {
        echo "  ".$sub['sub_menu']."<br/>" ;
    }
}