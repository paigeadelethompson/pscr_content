<?php

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
        
        if($class_name == "object") { 
            $class_name = "objekt";
        }
        
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
