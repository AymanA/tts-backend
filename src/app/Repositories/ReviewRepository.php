<?php


namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Review();
    }

    public function getHotelReviews($hotel_id, $from, $to, $format)
    {
        return $this->model->selectRaw('count(score) review_count, ROUND(AVG(score),2) average_score, created_date, name ')
            ->join('hotels', 'hotels.id', 'reviews.hotel_id')
            ->whereBetween('created_date', [$from, $to])
            ->where('hotel_id', $hotel_id)
            ->groupBy(['created_date', 'hotels.id'])
            ->get()
            ->groupBy(function ($val) use ($format) {
                return Carbon::parse($val->created_date)->format($format);
            });
    }
}
