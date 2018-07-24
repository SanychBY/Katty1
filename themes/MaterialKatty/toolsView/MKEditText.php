<?php
function themes_MaterialKatty_toolsView_MKEditText_get_html(\themes\MaterialKatty\tools\MKEditText $params){
    echo "<div "; $params->print_attributes(); echo ">
    <input placeholder='{$params->placeholder}' class=\"mdl-textfield__input\" type=\"text\" id='siple1'>
    <label class=\"mdl-textfield__label\" for=\"siple1\">Text...</label>
  </div>";
}