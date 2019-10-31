<?php

namespace App\Helpers;

class HashHelper
{
    /**
     * Crea un Hash ID.
     *
     * @return string
     */
    public static function hashId()
    {
        return uniqid();
    }
}