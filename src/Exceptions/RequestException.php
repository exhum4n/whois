<?php

declare(strict_types=1);

namespace Exhum4n\Whois\Exceptions;

use Exception;
use Throwable;

class RequestException extends Exception
{
    /**
     * @param $message
     * @param Throwable|null $previous
     */
    public function __construct($message, Throwable $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }
}