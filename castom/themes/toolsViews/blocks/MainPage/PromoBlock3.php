<?php
function castom_themes_toolsViews_blocks_MainPage_PromoBlock3_get_html($params){
    echo <<<HTML
    <form>
    <input type="text" placeholder="логин или email" class="form-control">
    <input type="text" placeholder="пароль" class="form-control">
    </form>
HTML;

}