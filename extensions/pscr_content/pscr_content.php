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

namespace pscr\extensions\pscr_content;

use pscr\lib\exceptions\invalid_argument_exception;
use pscr\lib\exceptions\not_implemented_exception;
use pscr\lib\http\response;
use pscr\lib\logging\logger;
use pscr\lib\model\i_content_renderer;

/**
 * Class pscr_content
 * @package pscr\extensions\pscr_content
 */
final class pscr_content implements i_content_renderer
{
    /**
     * @var
     */
    private $request;
    /**
     * @var
     */
    private $response;

    /**
     * @return mixed
     * @throws invalid_argument_exception
     */
    function render()
    {
        $module_filename = $this->request->get_selected_route_entry_file_name();
        $module_classname = $this->request->get_selected_route_entry_class_name();

        logger::_()->info($this, "trying to instantiate ", $module_classname, $module_filename);
        require_once($module_filename);

        if (class_exists($module_classname)) {
            if (is_a(new $module_classname(), 'pscr\extensions\pscr_content\model\pscr_content')) {
                $module = (new $module_classname());

                $module->set_request_instance($this->request);
                $module->set_response_instance($this->response);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $module->process_post($_REQUEST);
                }
                else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                    $module->process_put($_REQUEST);
                }
                else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                    parse_str(file_get_contents("php://input"), $_DELETE);
                    $module->process_delete($_REQUEST);
                }
                else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $module->generate();
                }
                else {
                    throw new invalid_argument_exception('Specified HTTP method not supported for pscr_content');
                }
                return $module;
            }
            else {
                throw new invalid_argument_exception("found class but class does not extend pscr_content class or implement the i_pscr_content interface.");
            }
        }
        else {
            throw new invalid_argument_exception("class does not exist in module file");
        }
    }

    /**
     * @return response
     * @throws invalid_argument_exception
     */
    function render_to_response() {
        $this->response = new response($this->request);
        $module = $this->render();
        if($this->response->get_header("Location")) {
            if(is_array($this->response->get_header("Location")))
                return $this->response;
        }
        $content = $this->generate_document($module->doctype);
        $this->response->set_response_body($content);
        return $this->response;
    }

    /**
     * @param $html_obj
     * @param int $indent
     * @return string
     */
    private function generate_document($html_obj, $indent = 0) {
        $doc_string = str_repeat(" ", $indent);

        $tag_name = $html_obj->__toString();
        $doc_string .= "<" . $tag_name;

        // tag properties
        if(count($html_obj->properties) > 0) {
            $doc_string .= ' ';
            $iter = new \CachingIterator(new \ArrayIterator($html_obj->properties));
            foreach($iter as $key => $value) {
                if(is_object($value)) {
                    // A subclass of html_tag_attributes overrides GetAttributeString, throws exception
                    // if not; it's meant for attributes that have more than one property within their
                    // string value like style attribute or the class attribute.
                    //$attr_name_split = explode("\\", get_class($value));
                    //$attr_name = end($attr_name_split);
                    $attr_name = $value->__toString();
                    $doc_string .= $attr_name . "=\"" . $value->GetAttributeValueString() . "\"";
                }
                else if($value == "") {
                    // just append the property without a value (eg <option disabled selected)
                    $doc_string .= $key;
                }
                else {
                    // attribute is just a key value pair
                    $doc_string .=  $key . "=" . "\"" . $value . "\"";
                }
                if($iter->hasNext())
                    $doc_string .= " ";
            }
        }

        // close tag type
        if($html_obj->get_close_tag_type() == 0) {
            // some tags like link, DOCTYPE, input, meta, etc are not terminated tags:
            if($tag_name == "!DOCTYPE html") {
                $doc_string .=">\n";
            }
            else {
                $doc_string .= ">\n";
                //return as this tag is already considered terminated and has no children
                return $doc_string;
            }
        }
        else if($html_obj->get_close_tag_type() == 2) {
            // A closing tag will be provided after child tags/innerText
            $doc_string .= ">";
        }
        else if($html_obj->get_close_tag_type() == 1) {
            // tags like <hr /> and <br />
            $doc_string .= " />\n";
        }

        //innerText
        if(!empty($html_obj->innerText)) {
            $doc_string .= ltrim(rtrim($html_obj->innerText));
        }

        //child tags
        if(count($html_obj->child_tags) > 0) {
            if($html_obj->get_close_tag_type() == 2)
                $doc_string .= "\n";
            foreach($html_obj->child_tags as $key => $value) {
                if($html_obj->get_close_tag_type() != 2) {
                    // don't indent child tags more after a terminated tag
                    $doc_string .= $this->generate_document($value, ($indent));
                }
                else {
                    $doc_string .= $this->generate_document($value, ($indent + 2));
                }
            }
        }

        if($html_obj->get_close_tag_type() == 2) {
            if(empty($html_obj->innerText)) {
                if(count($html_obj->child_tags) == 0)
                    $doc_string .= "\n";
                $doc_string .= str_repeat(" ", $indent);
            }
            $doc_string .= '</'.$tag_name.">\n";
        }
        return $doc_string;
    }

    /**
     * @param $request
     */
    function set_request($request)
    {
        $this->request = $request;
    }
}
