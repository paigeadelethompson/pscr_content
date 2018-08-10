<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/11/2018
 * Time: 6:27 AM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class pre extends html_tag
{
    function __construct($arguments = null)
    {
        parent::__construct();
        $this->innerText = ("\n" . $arguments[0]);
    }
}
