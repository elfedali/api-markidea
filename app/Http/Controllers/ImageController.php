<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{

    public function show(Request $request, Image $image): ImageResource
    {
        return new ImageResource($image);
    }


    public function destroy(Request $request, Image $image): Response
    {
        $image->delete();

        return response()->noContent();
    }
}
