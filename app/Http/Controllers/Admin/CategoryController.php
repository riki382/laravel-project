<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pg = 1;

        // echo $request->pg;

        $offset = 0;
        $limit =  10;// no of data per page2
        if($request->limit) {
            $limit = $request->limit;
        }


        if($request->pg) {
            $pg = $request->pg;

            // pg: 1, offset: 0
            // pg: 2, offset: 5,
            //
            $offset = ($pg - 1) * $limit;
        }


        
        $sql = "SELECT * FROM category LIMIT $offset, $limit";

        $sql_total = "SELECT * FROM category";
        $cat_total = \DB::select($sql_total);
        $categories = \DB::select($sql);
        $total = count($cat_total);


        $no_of_pages = $total / $limit;
        $nop = ceil($no_of_pages);

        $sn = 1;
        foreach($categories as $category)
        {
            
            echo '<li>' . $sn++ . ' ' . $category->title . '</li>';
            
        }

        $prev = 1;
        if($pg > 1) {
            $prev = $pg - 1;
        }
        
        $next = $pg + 1;
        if ($pg == $nop) { 
            $next = false;    
        } 
        
        $start = 1;
        if($pg >= 3) {
            $start = $pg - 2;    
        }
        
        if($pg < $nop - 2) {
            $end = $pg + 2;    
        } else {
            $end = $nop;
        }
        




        // dd($category);
        ?>

        <a href="/admin/category"> |< </a>

        &nbsp;&nbsp;&nbsp;

        <?php if($prev >= 1) { ?>
        <a href="/admin/category?pg=<?php echo $prev;?>"> << </a>
        <?php } else {  ?>
            <<
        <?php } ?>

        &nbsp;&nbsp;&nbsp;

        <?php for($i = $start; $i <= $end; $i++) { ?>

        <?php if($pg == $i) { ?>
        <strong style="font-size: 20px; color: green"><?php echo $i; ?></strong>
        <?php } else {  ?>
        <a href="/admin/category?pg=<?php echo $i ?>"><?php echo $i;?></a>

        <?php } ?>

        
        &nbsp;&nbsp;&nbsp;


        <?php } ?>


<!--         &nbsp;&nbsp;&nbsp;

        <a href="/admin/category?pg=1">1</a>

        &nbsp;&nbsp;&nbsp;

        <a href="/admin/category?pg=2">2</a>

        &nbsp;&nbsp;&nbsp;

        <a href="/admin/category?pg=3">3</a>

        &nbsp;&nbsp;&nbsp;

        <a href="/admin/category?pg=4">4</a>

        &nbsp;&nbsp;&nbsp;

        <a href="/admin/category?pg=5">5</a>

        &nbsp;&nbsp;&nbsp;
 -->
        <?php if($next) { ?>
            <a href="/admin/category?pg=<?php echo $next;?>"> >> </a>
        <?php } else { ?>
            >>
        <?php } ?>

        

        &nbsp;&nbsp;&nbsp;

        <a href="/admin/category?pg=<?php echo $nop ?>"> >| </a>

        <br><br>
        No of rows1: 
        <select name="nor" onchange="window.location.href='/admin/category?limit=' + this.value">
            <option <?php if($limit == 2) { echo 'selected'; } ?>>2</option>
            <option <?php if($limit == 5) { echo 'selected'; } ?>>5</option>
            <option <?php if($limit == 10) { echo 'selected'; } ?>>10</option>
            <option <?php if($limit == 20) { echo 'selected'; } ?>>20</option>
            <option <?php if($limit == 25) { echo 'selected'; } ?>>25</option>    
        </select>

        <?php



        die;
        $category = Category::all();
        $parentCategory = Category::where('parent_id','>',0)->get();

        return view('admin/category/list', compact('category', 'parentCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        return view('admin/category/add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->slug = str_replace(' ', '-', strtolower($category->title));
        $category->parent_id = $request->parent_id;
        $category->save();
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
        $row = Category::find($id);
        $categories = Category::where('parent_id',0)->get();

        return view('admin/category/edit', compact('row', 'categories'));
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
        $row = Category::find($id);
        if($row) {
            $row->title = $request->title;
            $row->slug = str_replace(' ', '-', strtolower($row->title));
            $row->parent_id = $request->parent_id;
        }
        $row->save();
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
        $category = Category::find($id);
        if($category) {
            $category->delete();
        }
        return redirect()->back();
    }
}
