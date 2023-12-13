<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Shop $shop)
    {
        return $shop->reviews;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Shop $shop, ReviewStoreRequest $request)
    {
        // add review to shop
        $review = new Review($request->validated());
        $shop->reviews()->save($review);
        return response(
            [
                'message' => 'Review created',
                'review' => $review,
            ],
            201
        );
    }
}
