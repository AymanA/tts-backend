<?php

namespace App\Services;

use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Services\Interfaces\ReviewServiceInterface;

class ReviewService implements ReviewServiceInterface
{
    private $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getHotelReview($hotel, $from, $to)
    {
        $reviews = [];
        $days = $this->calculateDateRange($from, $to);
        $format = $this->getGroupFormat($days);
        $result = $this->reviewRepository->getHotelReviews($hotel->id, $from, $to, $format);
        foreach ($result as $key => $value) {
            $reviews[] = $value;
        };
        return $reviews;
    }

    public function calculateDateRange($from, $to)
    {
        return (int)((strtotime($to) - strtotime($from)) / (3600 * 24));
    }

    private function getGroupFormat($days)
    {
        $format = null;
        switch ($days) {
            case ($days >= 1 && $days <= 29):
                $format = 'Y-m-d';
                break;
            case ($days >= 30 && $days <= 89):
                $format = 'WS';
                break;
            case $days >= 90:
                $format = 'Y-m';
                break;
            default:
                break;
        }
        return $format;
    }
}
