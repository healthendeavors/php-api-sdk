<?php

namespace Hendeavors\Model;

class User
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function id()
    {
        return (int)$this->user->id;
    }

    public function name()
    {
        return $this->user->name ?? "";
    }

    public function username()
    {
        return $this->user->email ?? "";
    }
}
