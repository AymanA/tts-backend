<?php


namespace App\Services\Interfaces;

interface ReviewServiceInterface
{
    public function getHotelReview($hotel, $from, $to);
}
