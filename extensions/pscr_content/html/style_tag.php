<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/11/2018
 * Time: 3:05 PM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class style_tag extends html_tag
{
    function __construct($arguments = null)
    {
        parent::__construct();
        $this->innerText = $arguments[0];
    }

    public function __toString()
    {
        return "style";
    }
}