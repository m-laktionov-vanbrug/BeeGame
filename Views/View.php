<?php
namespace Views;
/**
 * View.php Class
 * @author	Maksym Laktionov
 */

define('VIEWS_BASEDIR', __DIR__);

class View {
    function fetchPartial($template, $params = array()){
        extract($params);
        ob_start();
//        var_dump(VIEWS_BASEDIR . $template . '.php');
        include VIEWS_BASEDIR.$template.'.php';
        return ob_get_clean();
    }

    function renderPartial($template, $params = array()){
        echo $this->fetchPartial($template, $params);
    }

    function fetch($template, $params = array()){
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial('/layout', array('content' => $content));
    }

    function render($template, $params = array()){
        echo $this->fetch($template, $params);
    }
}