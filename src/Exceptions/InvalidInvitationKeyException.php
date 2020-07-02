<?php
namespace RichardAbear\Syndicate\Exceptions;

use Exception;

class InvalidInvitationKeyException extends Exception
{
    protected $message = "The invitation key is not valid";
}
