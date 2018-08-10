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
}
