<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::get();
        return $images;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // if ($request->hasFile('image_file'))
            $image_file = $request->file('image_file');

            if($image_file){
                $imageFile    = $image_file;
                $filename         = $request->image_name;
                $fileExt          = $imageFile->getClientOriginalExtension();
                $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp', 'img'];
                $destinationPath  = public_path('assets/gallery/');

                if (!in_array($fileExt, $allowedExtensions)) return response(['status' => 500, 'message' => "Kindly upload a valid image"], 500);
                
                $filename = $filename . '.' . $fileExt;
                $imageFile->move($destinationPath, $filename);
            }

            $image_url = 'assets/gallery/';

            $image = Image::create([
                "image_name" => $request -> image_name,
                "image_file" => $image_file ? $image_url . $filename : null,
            ]);

            return([
                $image,
                "message" => "Image Uploaded"
            ]);
        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $image)
    {
        $image_file = $request->file('image_file');

        // check if file is available;
        if ($image_file) {

            $imageFile    = $image_file;
            $filename         = $request->image_name;
            $fileExt          = $imageFile->getClientOriginalExtension();
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp', 'img'];
            $destinationPath  = public_path('/assets/gallery/');

            if (!in_array($fileExt, $allowedExtensions)) return response(['status' => 500, 'message' => "Kindly upload a valid image format"], 500);
            
            $filename = $filename . '.' . $fileExt;
            $imageFile->move($destinationPath, $filename);
        }

        $image_url = "/assets/gallery/";
        
        $image = Image::find($image);
        $image->update([
            "image_name" => $request -> file_name,
            "image_file" => $image_file ? $image_url . $filename : null,
        ]);

        return $image;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $image = Image::find($id);

            $image->delete();

            return response([
                "message" => "Image deleted"

            ], 204);

        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        };
        
    }
}
