<?php

namespace App\UrlShortener\Infrastructure\Interface;

use Illuminate\Database\Eloquent\Model;

interface IRepository
{
    /**
     * get resources - collection
     *
     * @param string $orderBy
     * @param string $orderMethod
     * @return mixed
     */
    public function getAll(
        string $orderBy = 'id',
        string $orderMethod = 'desc'
    );

    /**
     * get resource by url
     *
     * @param string $url
     * @return Model|null
     */
    public function findByUrl(string $url): Model|null;

    /**
     * get resource by id
     *
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null;

    /**
     * create new resource
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;
}
