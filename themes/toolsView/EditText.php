<?php
function themes_toolsView_EditText_get_html($params){
    echo "<{$params->type} "; $params->print_attributes(); echo "/>";
}
