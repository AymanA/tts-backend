<?php


namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Review();
    }

}
