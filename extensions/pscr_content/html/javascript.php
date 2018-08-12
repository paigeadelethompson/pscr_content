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
    function __construct($arguments = null)
    {
        parent::__construct();
        if($arguments != null)
            $this->src = $arguments[0];
    }

    public function __toString()
    {
        return "script";
    }

    public function integrity($integ)
    {
        $this->integrity = $integ;
        return $this;
    }
    
    public function cross_origin($origin)
    {
        $this->crossorigin = $origin;
        return $this;
    }
}
