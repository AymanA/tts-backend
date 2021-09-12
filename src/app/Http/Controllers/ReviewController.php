<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HotelReviewsRequest;
use App\Services\Interfaces\ReviewServiceInterface;
use App\Services\ReviewService;
use App\Models\Hotel;
use App\Models\Review;
use Carbon\Carbon;

class ReviewController extends BaseController
{
    private $reviewService;

    public function __construct(ReviewServiceInterface $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function getHotelReview(HotelReviewsRequest $request, Hotel $hotel)
    {
        $reviews = $this->reviewService->getHotelReview($hotel, $request->from, $request->to);
        if($reviews){
            return $this->successResponse([
                'data' =>
//                AppointmentResource::collection($appointments)
                    $reviews
            ]);
        } else {
            return $this->errorResponse(500, 'Failed to get hotel reviews please try again later');
        }
    }

}
