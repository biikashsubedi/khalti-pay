<?php

namespace App\Payment\Abstracts;


abstract class BasePayment
{
    public function setViewPath($path)
    {
        $this->viewPath = $path;
        return $this;
    }

    public function setViewName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getViewName()
    {
        return $this->viewPath.$this->name;
    }
}
