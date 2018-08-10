<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 2:58 PM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;


class input extends html_tag
{
    function __construct($arguments = null) {
        parent::__construct($arguments);
        $this->close_tag = 1;
    }

    function type($type) {
        $this->type = $type;
        return $this;
    }

    function placeholder($name) {
        $this->placeholder = $name;
        return $this;
    }

    function value($value) {
        $this->value = $value;
        return $this;
    }
}
