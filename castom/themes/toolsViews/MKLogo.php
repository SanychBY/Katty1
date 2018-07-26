<?php
function castom_themes_toolsViews_MKLogo_get_html(\castom\themes\tools\MKLogo $params){
    echo "<div id='$params->id' ";$params->print_attributes(); echo ">";
    echo "Katty";
    echo '</div>';
}