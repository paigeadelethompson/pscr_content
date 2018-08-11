<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/11/2018
 * Time: 12:12 AM
 */


namespace pscr\extensions\pscr_content\html;


class stylesheet extends link
{
    function __construct($arguments)
    {
        parent::__construct();
        $this->close_tag = 0;
        $this->href = $arguments[0];
        $this->type = "text/css";
        $this->rel = "stylesheet";
    }

    public function __toString()
    {
        return "link";
    }

    public function integrity($integ) {
        $this->integrity = $integ;
        return $this;
    }
    public function cross_origin($origin) {
        $this->crossorigin = $origin;
        return $this;
    }
}
