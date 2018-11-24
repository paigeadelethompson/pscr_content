<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 2:58 PM
 */

namespace pscr\extensions\pscr_content\html;
use pscr\extensions\pscr_content\model\html_tag;


class input extends html_tag
{
    function __construct($arguments = null) {
        parent::__construct($arguments);
        $this->close_tag = 1;
    }

    function text() {
        $this->type = "text";
        return $this;
    }

    function color() {
        $this->type = "color";
        return $this;
    }

    function date() {
        $this->type = "date";
        return $this;
    }

    function datetime_local() {
        $this->type = "datetime-local";
        return $this;
    }

    function month() {
        $this->type = "month";
        return $this;
    }

    function range() {
        $this->type = "range";
        return $this;
    }

    function search() {
        $this->type = "search";
        return $this;
    }

    function tel() {
        $this->type = "tel";
        return $this;
    }

    function time() {
        $this->type = "time";
        return $this;
    }

    function url() {
        $this->type = "url";
        return $this;
    }

    function week() {
        $this->type = "week";
        return $this;
    }

    function email() {
        $this->type = "email";
        return $this;
    }

    function radio() {
        $this->type = "radio";
        return $this;
    }

    function checkbox() {
        $this->type = "checkbox";
        return $this;
    }

    function submit() {
        $this->type = "submit";
        return $this;
    }

    function password() {
        $this->type = "password";
        return $this;
    }

    function type($type) {
        $this->type = $type;
        return $this;
    }

    function placeholder($name) {
        $this->placeholder = $name;
        return $this;
    }

    function value($value) {
        $this->value = $value;
        return $this;
    }

    //pattern="[0-9]{5}"
    function numeric($len) {
        $this->pattern .= "[0-9]{". $len ."}";
        return $this;
    }

    function disabled() {
        $this->disabled = null;
        return $this;
    }

    function hidden() {
        $this->hidden = null;
        return $this;
    }

    function readonly() {
        $this->readonly = null;
        return $this;
    }

    function size($size) {
        $this->size = $size;
        return $this;
    }

    function max_length($len) {
        $this->maxlength = $len;
        return $this;
    }

    function autocomplete_on() {
        $this->autocomplete = "on";
        return $this;
    }

    function autocomplete_off() {
        $this->autocomplete = "off";
        return $this;
    }

    function no_validate() {
        $this->novalidate = null;
        return $this;
    }

    function auto_focus() {
        $this->autofocus = null;
        return $this;
    }

    function checked() {
        $this->checked = null;
        return $this;
    }

    function form() {
        $this->form = null;
        return $this;
    }

    function formaction($action) {
        $this->formaction = $action;
        return $this;
    }

    function formenctype($enc) {
        $this->formenctype = $enc;
        return $this;
    }

    function form_method($method) {
        $this->formmethod = $method;
        return $this;
    }

    function form_no_validate() {
        $this->formnovalidate = null;
        return $this;
    }

    function form_target($target) {
        $this->formtarget = $target;
        return $this;
    }

    function height($height) {
        $this->height = $height;
        return $this;
    }

    function width($width) {
        $this->width = $width;
        return $this;
    }

    function list($datalist) {
        $this->list = $datalist;
        return $this;
    }

    function min($min) {
        $this->min = $min;
        return $this;
    }

    function max($max) {
        $this->max = $max;
        return $this;
    }

    function multiple() {
        $this->multiple = null;
        return $this;
    }

    function required() {
        $this->required = null;
        return $this;
    }

    function step($step) {
        $this->step = $step;
        return $this;
    }

}
