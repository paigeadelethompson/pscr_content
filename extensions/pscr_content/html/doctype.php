<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/7/2018
 * Time: 6:51 PM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class doctype extends html_tag
{

    function __construct($arguments = null)
    {
        parent::__construct($arguments);
        $this->close_tag = 0;
    }

    function __toString()
    {
        return "!DOCTYPE html";
    }
}
