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

use pscr\extensions\pscr_content\html\doctype;
use pscr\lib\exceptions\not_implemented_exception;

/**
 * Class pscr_content
 * @package pscr\extensions\pscr_content\model
 */
abstract class pscr_content implements i_pscr_content {
    /**
     * @var html
     */
    public $doctype;
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $response;

    /**
     * pscr_content constructor.
     * @param $request
     * @param $response
     */

    protected $html;

    function __construct() {
        $this->doctype = new doctype();
        $this->html = $this->doctype->html();
    }

    function set_request_instance($request) {
        $this->request = $request;
    }

    function set_response_instance($response) {
        $this->response = $response;
        $this->response->set_header("content-type", "text/html");
    }

    function set_settings_instance($settings) {
        $this->settings = $settings;
    }

    function process_post() {
        throw new not_implemented_exception("pscr_content object doesn't implement an override for process_post");
    }

    function process_put() {
        throw new not_implemented_exception("pscr_content object doesn't implement an override for process_put");
    }

    function process_delete() {
        throw new not_implemented_exception("pscr_content object doesn't implement an override for process_delete");
    }
}
