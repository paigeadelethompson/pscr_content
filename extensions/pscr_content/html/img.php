<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/7/2018
 * Time: 6:57 PM
 */
namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;

class img extends html_tag
{
    function src($src) {
        $this->src = $src;
        return $this;
    }
}
