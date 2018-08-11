<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 3:16 PM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;


class option extends html_tag
{

    function disabled() {
        $this->disabled = null;
        return $this;
    }

    function selected() {
        $this->selected = null;
        return $this;
    }

    function hidden() {
        $this->hidden = null;
        return $this;
    }
}
