<?php

class View {

    function render($view, $data = [], $template = DEFAULT_TEMPLATE) {
	extract($data);
	if ($template) {
	    include_once 'views/' . $template;
	}
    }

}
