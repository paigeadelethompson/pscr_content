<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/11/2018
 * Time: 12:12 AM
 */

namespace pscr\extensions\pscr_content\html;


class javascript extends script
{
    function __construct($arguments)
    {
        parent::__construct();
        $this->src = $arguments[0];
    }

    public function __toString()
    {
        return "script";
    }
}
