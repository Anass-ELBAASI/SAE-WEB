<?php

namespace Romai\SaeWeb\Exceptions;
class AuthentificationException extends \Exception
{
    protected $type;
    public function getType()
    {
        return $this->type;
    }

    public function __construct($messageAlerte, $type1){
        parent::__construct($messageAlerte);
        $this->type = $type1;
    }
}