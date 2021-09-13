<?php

namespace App\Services;

use App\Repositories\Interfaces\HotelRepositoryInterface;
use App\Services\Interfaces\HotelServiceInterface;

class HotelService implements HotelServiceInterface
{
    private $hotelRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function getHotels()
    {
        return $this->hotelRepository->getHotels();
    }
}
