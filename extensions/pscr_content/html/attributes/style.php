<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/8/2018
 * Time: 10:25 PM
 */

namespace pscr\extensions\pscr_content\html\attributes;


use pscr\extensions\pscr_content\model\html_tag_attributes;

class style extends html_tag_attributes
{
    public function GetAttributeValueString()
    {
        $ret = '';
        foreach($this->data as $key => $value) {
            $ret .= $key . ":" . $value . ";";
        }
        return $ret;
    }

    public function __set($name, $value)
    {
        // we have to use underscores in php but css names are all hyphens:
        $name = str_replace('_', '-', $name);
        parent::__set($name, $value);
    }

    public function __get($name)
    {
        return parent::__get($name);
    }
}