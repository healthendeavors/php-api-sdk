<?php

namespace Hendeavors\Http\Request;

class Headers
{
    private $headers = [];



    public function add(string $key, string $value)
    {
        $this->headers[] = [$key => $value];
    }

    public function get($key)
    {

    }

    public function toArray()
    {
        
    }
}
