<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 3:15 PM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;

class meta extends html_tag
{

    function __construct($arguments = null) {
        parent::__construct($arguments);
        $this->close_tag = 1;
    }

    function content($content) {
        $this->content = $content;
        return $this;
    }

    function property($prop) {
        $this->property = $prop;
        return $this;
    }
}
