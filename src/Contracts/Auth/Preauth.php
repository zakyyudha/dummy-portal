<?php

namespace Zaky\Contracts\Auth;

/**
 * Interface Preauth
 * @package Zaky\Contracts\Auth
 */
interface Preauth
{
    /**
     * @param string $sateliteName
     * @return mixed
     */
    public function preauthentication(string $sateliteName);
}