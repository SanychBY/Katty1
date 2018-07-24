<?php
function themes_toolsView_Button_get_html($params){
    echo "<button ";
    $params->print_attributes();
    echo ">$params->text</button>";
}
