<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('admin/slider/list', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/slider/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();

        $slider->title = $request->title;
        $slider->status = $request->status;
        $slider->caption = $request->caption;
        $slider->image = '';

        if($_FILES['image']['error'] == 0)
        {
            $filename = time() . '_' . $_FILES['image']['name'];
            $image = 'uploads/slider/' . $filename;
            $destination = public_path($image);
            $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if($is_uploaded)
            {
                $slider->image = '/' . $image;
            }
        }

        $slider->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Slider::find($id);
        return view('admin/slider/edit', compact('row'));
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
        $slider = Slider::find($id);
        if($slider)
        {
            $oldImage = $slider->image;
            $slider->title = $request->title;
            $slider->status = $request->status;
            $slider->caption = $request->caption;
            $slider->image = $oldImage;

            if($request->image)
            {
                if($_FILES['image']['error'] == 0)
                {
                    $filename = time() . '_' . $_FILES['image']['name'];
                    $image = 'upload/slider/' .  $filename;
                    $destination = public_path($image);
                    $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    if($is_uploaded)
                    {
                        if(is_file(public_path(($oldImage))))
                        {
                            unlink(public_path($oldImage));
                        }
                        $slider->image = '/' . $image;
                    }
                }
            }
            $slider->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if($slider)
        {
            $deleted = $slider->delete();
            if($deleted)
            {
                unlink(public_path($slider->image));
            }
        }
        return redirect()->back();
    }
}
