<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/9/2018
 * Time: 12:15 AM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class br extends html_tag
{
    function __construct($arguments = null) {
        parent::__construct($arguments);
        $this->close_tag = 1;
    }
}
