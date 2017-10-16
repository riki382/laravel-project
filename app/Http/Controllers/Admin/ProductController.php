<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Events\ImageEvent;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $user = \Auth::user();

        // if(!$user) {
        //     return redirect('/login');
        // }

        // dd($user);

        $products = Product::leftjoin('category', 'category.id', '=', 'product.category_id')
            ->leftJoin('brand', 'brand.id', '=', 'product.brand_id')
            ->select('product.*', 'category.title as ctitle', 'brand.title as btitle')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin/product/list', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '>', 0)->get();
        $brands = Brand::all();

        return view('admin/product/add', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();

        $request->validate([
            'title' =>  'required|unique:product|max:255',
            'price' =>  'required',
            'image' =>  'image|mimes:jpg,png,jpeg'
        ]);


        // $validation = Validator::make([])->validate();

        // if($validation) {
        //     // redirect 
        //     return redirect
        // }

        // automatic redirection


        $product->title = $request->title;
        $product->slug = str_replace(' ', '-', strtolower($request->title));
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->content = $request->content;
        $product->image = '';

        if($_FILES['image']['error'] == 0) {
            $filename = time() . '_' . $_FILES['image']['name'];
            $image = 'uploads/' . $filename;
            $destination = public_path($image) ;
            $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if($is_uploaded) {
                $product->image = '/' . $image;
            }
        }


        $product->save();

        session('dummymessage', 'Successfully inserted');

        session([
            'key'   =>  '',

        ]);

        

        // \SESSION::

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
        echo 'show to display detail';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin/product/edit', compact('row','categories','brands'));
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
        $row = Product::find($id);
        if($row) {
            $oldimage = $row->image;
            $row->title = $request->title;
            $row->slug = str_replace(' ', '-', strtolower($request->title));
            $row->category_id = $request->category_id;
            $row->brand_id  = $request->brand_id;
            $row->price = $request->price;
            $row->content = $request->content;
            $row->image = $oldimage;

            if($request->image){
                if($_FILES['image']['error'] == 0) {
                    $filename = time() . '_' . $_FILES['image']['name'];

                    $image = 'uploads/' . $filename;

                    $destination = public_path($image) ;

                    $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    if($is_uploaded) {
                        if(is_file(public_path($oldimage))) {
                            unlink(public_path($oldimage));
                        }
                        $row->image = '/' . $image;
                    }
                }
            }

            $row->save();
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



         // event(new OrderShipped($order));
//         event(new \App\Events\Event());

// die;


        $product = Product::find($id);

//         event(new ImageEvent($product));
// die;


        if($product) {
            $productDelete = $product->delete();
            $uploadPath = $product->image;
            if($productDelete) {
                event(new ImageEvent($uploadPath));
                // unlink(public_path($uploadPath));
            }
        } 



        // /// get admin info
        // // 'Ram has deleted product abc'
        // $logmessage = "Ra has delfsldfjsdent(new ImageEvent($uploadPath));lkfj";

        // $log = new Log();
        // $log->message = $logmessage;
        // $log->save();
        return redirect()->back();
    }
}
