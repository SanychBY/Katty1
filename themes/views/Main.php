<?php
function themes_views_Main_get_html(\core\Page $params)
{
    echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    {$params->meta}
    <title>{$params->title}</title>
    {$params->styles}
    {$params->scripts}
</head>
<body>
<header>";
    $params->get_header();
    echo "</header>";
    $params->get_content();
    echo "{$params->footer}
</body>
</html>";
}