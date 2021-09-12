<?php


namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Carbon\Carbon;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Review();
    }

    public function getHotelReviews($hotel_id, $from, $to, $format)
    {
        $results = [];
        $this->model->selectRaw('count(score) review_count, ROUND(AVG(score),2) average_score, created_date, name ')
            ->join('hotels', 'hotels.id', 'reviews.hotel_id')
            ->whereBetween('created_date', [$from, $to])
            ->where('hotel_id', $hotel_id)
            ->groupBy(['created_date', 'hotels.id'])
            ->get()
            ->groupBy(function ($val,$group) use (&$results,$format) {
                $val->date_group = Carbon::parse($val->created_date)->format($format);
                array_push($results,$val);
            });
        return $results;
    }
}
