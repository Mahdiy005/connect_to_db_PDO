<?php

namespace App\Exceptions;


use Exception;

/**
 * Undefined class
 */
class ViewException extends Exception
{
  public static function ViewNotExists()
  {
    throw new self("The requested view does not exist.");
  }
}
