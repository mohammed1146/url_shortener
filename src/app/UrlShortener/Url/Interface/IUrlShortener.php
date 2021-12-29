<?php

namespace App\UrlShortener\Url\Interface;

interface IUrlShortener
{
    /**
     * generate unique key
     *
     * @param int $id
     * @return string
     */
    public function generateKey(int $id): string;

    /**
     * decode unique key
     *
     * @param string $key
     * @return array
     */
    public function decodeKey(string $key): array;
}
