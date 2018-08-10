<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/11/2018
 * Time: 4:41 AM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;


class h extends html_tag
{
    function __construct($arguments)
    {
        parent::__construct();
        $this->innerText = $arguments[0];
    }
}