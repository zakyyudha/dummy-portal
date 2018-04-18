<?php

namespace Zaky\Contracts\Auth;

/**
 * Interface Login
 * @package Zaky\Contracts\Auth
 */
interface Login
{
    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function authenticate($username, $password);
}