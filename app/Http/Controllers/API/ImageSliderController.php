<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ImageSlider;
use Illuminate\Http\Request;

class ImageSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageSliders = ImageSlider::select(['group', 'image_path', 'title', 'position', 'action_link', 'open_in_new_tab'])->active();

        if (request()->get('group')) {
            $imageSliders = $imageSliders->where('group', request()->get('group'));
        }

        $imageSliders = $imageSliders->positioned()->get();

        $imageSliders->each(function ($imageSlider) {
            return $imageSlider['image_url'] = $imageSlider->image_url;
        });

        return $imageSliders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
