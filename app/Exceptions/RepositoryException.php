<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/17/2016
 * Time: 12:02 AM
 */

namespace app\Exceptions;

use Exception;

class RepositoryException extends Exception
{
    public function __construct($message, $code = 666, Exception $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}