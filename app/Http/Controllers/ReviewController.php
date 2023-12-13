<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return $review;
    }
    // update 
    public function update(ReviewUpdateRequest $request, Review $review)
    {

        $review->update($request->validated());

        return response()->json($review, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if ($review->delete()) {
            return response()->json([
                'message' => 'Review deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Review not deleted'
            ], 400);
        }
    }
}
