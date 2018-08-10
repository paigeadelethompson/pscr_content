<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/11/2018
 * Time: 4:52 AM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;

class p extends html_tag
{
    function __construct($arguments = null)
    {
        parent::__construct($arguments);
        $this->innerText = $arguments[0];
    }
}