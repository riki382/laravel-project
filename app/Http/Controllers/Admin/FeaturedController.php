<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Featured;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $featured = Featured::leftJoin('product', 'product.id', '=', 'featured.product_id')
            ->select('featured.*', 'product.title as ptitle')
            ->get();

        return view('admin/featured/list', compact('featured'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/featured/add', compact('categories'));
    }

    public function ajaxProduct($category_id)
    {
        // echo $category_id;
        // \DB::enableQueryLog();
        $product = Product::where('category_id', $category_id)->get();
        // dd(\DB::getQueryLog());
        return response()->json($product);
        // header('content-type: application/json');
        // echo json_encode($product, JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $featured = new Featured();

        $featured->product_id = $request->product_id;
        $featured->discount = $request->discount;
        $featured->start_date = $request->start_date;
        $featured->end_date = $request->end_date;
        $featured->type = $request->type;

        $featured->save();

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
        $row = Featured::find($id);
        $products = Product::leftJoin('category', 'category.id', '=', 'product.category_id')
            ->select('product.id as pid','product.title as ptitle','category.id as cid', 'category.title as ctitle')
            ->where('product.id',$row->product_id)
            ->get();

        $categories = Category::all();

        return view('admin/featured/edit', compact('row', 'products', 'categories'));
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
        $featured = Featured::find($id);
        if($featured)
        {
            $featured->product_id = $request->product_id;
            $featured->discount = $request->discount;
            $featured->start_date = $request->start_date;
            $featured->end_date = $request->end_date;
            $featured->type = $request->type;

            $featured->save();
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
        $featured = Featured::find($id);
        if($featured)
        {
            $featured->delete();
        }
        return redirect()->back();
    }
}
