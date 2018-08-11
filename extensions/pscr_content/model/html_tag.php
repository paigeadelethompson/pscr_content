<?php
/*
 * Author: Paige A. Thompson (paigeadele@gmail.com)
 * Copyright (c) 2018, Netcrave Communications
 * All rights reserved.
 *
 *
 * Author: Trevor A. Thompson (trevorat@gmail.com)
 * Copyright (c) 2007, Progressive Solutions Inc.
 * All rights reserved.
 *
 * - Redistribution and use of this software in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above
 * copyright notice, this list of conditions and the
 * following disclaimer.
 *
 * - Redistributions in binary form must reproduce the above
 * copyright notice, this list of conditions and the
 * following disclaimer in the documentation and/or other
 * materials provided with the distribution.
 *
 * - Neither the name of Progressive Solutions Inc. nor the names of its
 * contributors may be used to endorse or promote products
 * derived from this software without specific prior
 * written permission of Progressive Solutions Inc.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A
 * PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
 * TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */


namespace pscr\extensions\pscr_content\model;

use pscr\extensions\pscr_content\pscr_content_renderer_exception;
use pscr\lib\exceptions\invalid_argument_exception;

/**
 * Class html_tag
 * @package pscr\extensions\pscr_content\model
 */
abstract class html_tag
{
    /**
     * @var array
     */
    public $child_tags;

    /**
     * @var array
     */
    public $properties;

    /**
     * @var
     */
    public $innerText;

    /* 0 = no close tag
     * 1 = />
     * 2 = </tag>
     */
    protected $close_tag;

    public function get_close_tag_type() {
        return $this->close_tag;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {

        $this->properties[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->properties[$name];
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws pscr_content_renderer_exception
     */
    public function __call($name, $arguments)  {
        $class_name = "pscr\\extensions\\pscr_content\html\\" . $name;
        $class_name_attr = "pscr\\extensions\\pscr_content\html\\attributes\\" . $name;
        if(class_exists($class_name)) {
            if(empty($arguments)) {
                $new_tag = new $class_name();
                $this->child_tags[] = $new_tag;
                return($new_tag);
            }
            else {
                $new_tag = new $class_name($arguments);
                $this->child_tags[] = $new_tag;
                return($new_tag);
            }
        }
        else if(class_exists($class_name_attr)) {
            $new_attr = new $class_name_attr();
            $this->properties[] = $new_attr;
            return($new_attr);
        }
        else {
            throw new pscr_content_renderer_exception("bad tag or attribute name", $name);
        }
    }

    /**
     * html_tag constructor.
     * @param null $arguments
     * @throws invalid_argument_exception
     * The default is to assume that if arguments is not null, when calling the constructor
     * that it will be an array, and the first element is intended to be the id attribute of the html element.
     * Otherwise, the constructor should be overidden in a subclass and will need to handle the same initialization
     * as in this one. Look at the stylesheet class or the a class for an example. There's literally no reason
     * an exception should ever get thrown from this class, but just in case.
     */
    function __construct($arguments = null)
    {
        // default close tag type
        $this->close_tag = 2;
        $this->child_tags = array();
        $this->properties = array();

        if($arguments != null)
            if(is_array($arguments))
                $this->id = $arguments[0];
            else
                throw new invalid_argument_exception('default html_tag constructor expects an array with one string for id');
    }

    public function class($class) {
        $this->class = $class;
        return $this;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function id($id) {
        $this->id = $id;
        return $this;
    }

    public function inner_text($value) {
        $this->innerText = $value;
        return $this;
    }

    public function value($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function __toString()
    {
        return (new \ReflectionClass(get_called_class()))->getShortName();
    }
}
