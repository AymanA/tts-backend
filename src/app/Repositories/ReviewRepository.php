<?php


namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Review();
    }

    public function getHotelReviews($hotel_id, $from, $to, $format)
    {

        return $this->model
            ->join('hotels', 'hotels.id', 'reviews.hotel_id')
            ->whereBetween('created_date', [$from, $to])
            ->where('hotel_id', $hotel_id)
            ->get()
            ->groupBy(function ($val) use (&$results, $format) {
                return Carbon::parse($val->created_date)->format($format);
            })->map(function (Collection $rows) use ($format) {
                return [
                    'average-score' => $rows->avg('score'),
                    'review-count' => $rows->count(),
                    'date-group' => Carbon::parse($rows[0]->created_date)->format($format)
                ];
            });
    }
}
