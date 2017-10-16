<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::all();

        return view('admin/brand/list', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/brand/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand();

        $brand->title = $request->title;
        $brand->logo = "";
        $brand->content = $request->content;

        if($_FILES['image']['error'] == 0) {
            $filename = time() . '_' . $_FILES['image']['name'];

            $image = 'uploads/logo/' . $filename;

            $destination = public_path($image) ;

            $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if($is_uploaded) {
                $brand->logo = '/' . $image;
            }
        }

        $brand->save();

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
        $row = Brand::find($id);

        return view('admin/brand/edit', compact('row'));
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
        $brand = Brand::find($id);
        if($brand) {
            $oldBrand = $brand->logo;
            $brand->title = $request->title;
            $brand->content = $request->content;
            $brand->logo = $oldBrand;

            if($request->logo) {
                if($_FILES['image']['error'] == 0) {
                    $filename = time() . '_' . $_FILES['image']['name'];

                    $image = 'uploads/logo/' . $filename;

                    $destination = public_path($image) ;

                    $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    if($is_uploaded) {
                        if(is_file(public_path($oldBrand))) {
                            unlink(public_path($oldBrand));
                        }
                        $brand->logo = '/' . $image;
                    }
                }
            }
            $brand->save();
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
        $brand = Brand::find($id);
        if($brand) {
            $brand->delete();
        }

        return redirect()->back();
    }
}
