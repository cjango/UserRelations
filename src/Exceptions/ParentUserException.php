<?php

namespace Jason\UserAccount\Exceptions;

use RuntimeException;

class ParentUserException extends RuntimeException
{

    public function __construct($message)
    {
        parent::__construct($message);
    }
}
