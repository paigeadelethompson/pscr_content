<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 2:53 PM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;


class form extends html_tag
{
    function action($action) {
        $this->action = $action;
        return $this;
    }

    function method($method) {
        $this->method = $method;
        return $this;
    }

    function target($target) {
        $this->target = $target;
        return $this;
    }

    function accept_charset($charset) {
        $this->accept_charset = $charset;
        return $this;
    }

    function autocomplete_on() {
        $this->autocomplete = "on";
        return $this;
    }

    function autocomplete_off() {
        $this->autocomplete = "off";
        return $this;
    }

    function enctype($enc) {
        $this->enctype = $enc;
        return $this;
    }

    function novalidate() {
        $this->novalidate = null;
        return $this;
    }
}
