<?php

namespace views;

class Render
{
    public static function render($page, $arguments = [], $ajax = false) {
        ob_start();
        if (!$ajax) { require_once 'header.php'; }
        extract($arguments, EXTR_OVERWRITE);
        require_once 'views/' . $page . '.php';
        if (!$ajax) { require_once 'footer.php'; }
        return ob_get_clean();
    }
}
