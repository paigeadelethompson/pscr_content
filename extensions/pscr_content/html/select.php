<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 2:59 PM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;


class select extends html_tag
{

    function multiple() {
        $this->multiple = null;
        return $this;
    }
}
