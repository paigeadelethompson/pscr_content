<?php
/**
 * Created by PhpStorm.
 * User: erratic
 * Date: 7/31/2018
 * Time: 3:02 PM
 */

namespace pscr\extensions\pscr_content\html;

use pscr\extensions\pscr_content\model\html_tag;
use pscr\lib\exceptions\not_implemented_exception;

class objekt extends html_tag
{
  public function __toString()
  {
    throw new not_implemented_exception();
  }
}
