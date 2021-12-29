<?php

namespace App\UrlShortener\Url\Service;

use App\UrlShortener\Url\Interface\IUrlShortener;
use Hashids\Hashids;

class UrlShortener implements IUrlShortener
{
    /**
     * const SALT
     */
    private const SALT = 'this is the salt';

    /**
     * @var Hashids
     */
    protected Hashids $hashIdObj;

    /**
     * UrlShortener constructor
     */
    public function __construct()
    {
        $this->hashIdObj = new Hashids($salt = self::SALT, $minLength = 6);
    }

    /**
     * generate unique key
     *
     * @param int $id
     * @return string
     */
    public function generateKey(int $id): string
    {
        return $this->hashIdObj->encode($id);
    }

    /**
     * decode unique key
     *
     * @param string $key
     * @return array
     */
    public function decodeKey(string $key): array
    {
        return $this->hashIdObj->decode($key);
    }
}
