<?php

namespace App\UrlShortener\Url\Repository\Mysql;

use App\Models\Url;
use App\UrlShortener\Infrastructure\Interface\IRepository;
use Illuminate\Database\Eloquent\Model;

class UrlShortenerRepository implements IRepository
{
    /**
     * UrlShortenerRepository constructor
     *
     * @param Url $model
     */
    public function __construct(protected Url $model)
    {
    }

    /**
     * get resources - collection
     *
     * @param string $orderBy
     * @param string $orderMethod
     * @return mixed
     */
    public function getAll(string $orderBy = 'id', string $orderMethod = 'desc')
    {
        return $this->model
            ->orderBy($orderBy, $orderMethod)
            ->get();
    }

    /**
     * get resource by url
     *
     * @param string $url
     * @return Model|null
     */
    public function findByUrl(string $url): Model|null
    {
        return $this->model
            ->where('original_url', $url)
            ->first();
    }

    /**
     * get resource by id
     *
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null
    {
        return $this->model->find($id);
    }

    /**
     * create new resource
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
}
