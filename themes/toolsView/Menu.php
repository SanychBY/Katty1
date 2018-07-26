<?php
function themes_toolsView_Menu_get_html(\core\tools\Menu $params){
    echo "<ul id='$params->id' ";$params->print_attributes(); echo ">";

    echo '</ul>';
}