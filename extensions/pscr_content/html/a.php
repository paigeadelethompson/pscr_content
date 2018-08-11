<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/9/2018
 * Time: 12:14 AM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class a extends html_tag
{
    function __construct($arguments = null)
    {
        parent::__construct($arguments);
        if($arguments != null)
            $this->innerText = $arguments[0];
    }

    function href($href) {
        $this->href = $href;
        return $this;
    }
}
