<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index(Request $request)
    {
        return response(Image::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $data = Image::create(['url' => $imagePath]);
        return response($data, Response::HTTP_CREATED);
    }
    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $data = Image::find($id);
        return response($data, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response(Image::destroy($id), Response::HTTP_NO_CONTENT);
    }
}