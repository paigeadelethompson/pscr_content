<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/9/2018
 * Time: 7:43 PM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class li extends html_tag
{
    public function __construct($arguments = null)
    {
        parent::__construct();
        $this->innerText = $arguments[0];
    }
}