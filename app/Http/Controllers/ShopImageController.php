<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Shop $shop)
    {
        $images = $shop->images;
        return response()->json($images, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Shop $shop, Request $request)
    {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $shop->images()->create([
            'image' => $imageName,
        ]);
        return response()->json([
            'message' => 'Image created',
        ], 201);
    }
}
