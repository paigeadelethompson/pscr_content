<?php

namespace pscr\extensions\pscr_content;

use pscr\lib\exceptions\invalid_argument_exception;
use pscr\lib\logging\logger;
use pscr\lib\model\pscr_settings;

class app_settings extends pscr_settings {

    public function __construct($app_path) {
        $this->data = array();
        $this->data = parse_ini_file($app_path . 'settings/settings.ini', true);
    }
}

?>
