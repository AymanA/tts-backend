<?php

namespace App\Services;

use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Services\Interfaces\ReviewServiceInterface;
use App\Models\Review;
use Carbon\Carbon;

class ReviewService implements ReviewServiceInterface
{
    private $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getHotelReview($hotel, $from, $to)
    {
        $days = $this->calculateDateRange($from, $to);
        $format = $this->getGroupFormat($days);
        //todo get from repository
        $result = Review::selectRaw('count(score) review_count, ROUND(AVG(score),2) average_score, created_date, name ')
            ->join('hotels', 'hotels.id', 'reviews.hotel_id')
            ->whereBetween('created_date', [$from, $to])
            ->where('hotel_id', $hotel->id)
            ->groupBy(['created_date','hotels.id'])
            ->get()
            ->groupBy(function ($val) use($format){
                return Carbon::parse($val->created_date)->format($format);
            });
        return $result;
    }

    public function calculateDateRange($from, $to) {
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
