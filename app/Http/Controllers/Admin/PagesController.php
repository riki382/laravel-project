<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::all();

        return view('admin/pages/list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pages/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pages = new Pages();


        $request->validate([
            'title' =>  'required'
        ]);

        $pages->title = $request->title;
        $pages->slug = str_replace(' ', '-', $pages->title);
        $pages->content = $request->content;
        $pages->meta_keyword = $request->meta_keyword;
        $pages->meta_description = $request->meta_description;

        $pages->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Pages::find($id);

        return view('admin/pages/edit', compact('row'));
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
        $pages = Pages::find($id);
        if($pages)
        {
            $oldImage = $pages->image;
            $pages->title = $request->title;
            $pages->slug = str_replace(' ', '-', $pages->title);
            $pages->content = $request->content;
            $pages->image = $oldImage;

            if($request->image)
            {
                if($_FILES['image']['error'] == 0)
                {
                    $filename = time() . '-' . $_FILES['image']['name'];
                    $image = "/uploads/pages/" . $filename;
                    $destination = public_path($image);
                    $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    if($is_uploaded)
                    {
                        if(is_file(public_path($oldImage)))
                        {
                            unlink(public_path($oldImage));
                        }
                        $pages->image = '/' . $image;
                    }
                }
            }
            $pages->save();
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
        $pages = Pages::find($id);
        if($pages)
        {
            $pages->delete();
        }
        return redirect()->back();
    }
}
