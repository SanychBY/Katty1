<?php
function themes_toolsView_Form_get_html(\core\tools\Form $params){
    echo "<form action='#' ";$params->print_attributes(); echo ">";
    $params->print_elements();
    echo "</form>";
}
