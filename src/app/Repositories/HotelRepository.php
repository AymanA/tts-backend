<?php


namespace App\Repositories;

use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;

class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Hotel();
    }


    public function getHotels()
    {
        return $this->model->all();
    }
}
