<?php


namespace App\Repositories\Interfaces;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function getHotelReviews($hotel_id, $from, $to, $format);
}
