<?php

use castom\themes\tools\MKHeader;

function castom_themes_toolsViews_MKHeader_get_html(MKHeader $params){
    echo "<div "; $params->print_attributes(); echo ">";
    $params->getLogo()->render();
    //$params->getMenu()->render();
    echo '</div>';
}