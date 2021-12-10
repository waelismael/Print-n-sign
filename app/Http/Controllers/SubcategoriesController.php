<?php

namespace App\Http\Controllers;
use App\Models\Subcategories;
use App\Models\Categories;
use App\DataTables\SubcategoriesDatatables;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubcategoriesDatatables $subcategories, $id)
    {
        //
        // $subcategories = Subcategories::where('category_id',$id)->get();
        $page_title = Categories::find($id);
        return $subcategories->with('id', $id)->render('admin.categories.subcategories.index',['page_title'=>'Sub Categories '.$page_title['name']]);

        // echo $subcategories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $page_title='Create a new subCategory';
        return view('admin.categories.subcategories.create',compact('page_title','id'));
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
        $request->validate([
            'name'=>"required|min:3|max:190|unique:subcategories",
            'category_id'=>"required",
        ]);
        Subcategories::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id
        ]);
        notify()->success('Successful Operation','SubCategory Added Successfully');
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
        //
        $Subcategories = Subcategories::find($id);
        $page_title = 'Edit SubCategory';
        return view('admin.categories.subcategories.edit', compact(['Subcategories','page_title']));
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
        $request->validate([
            'name'=>"required|min:3|max:190",
            'category_id'=>"required",
        ]);
        Subcategories::where('id', $id)->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id
        ]);
        notify()->success('Successful Operation','SubCategory Added Successfully');
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

        // return $id;
        //
        Subcategories::find($id)->delete();
        notify()->success('Successful Operation','Operation Deleted Successfully');
        return redirect()->back();
    }
    public function multiple(Request $request)
    {
        // return $request;
        if(is_array(request('item')))
        {
            Subcategories::destroy(request('item'));
        }else
        {
            Subcategories::find(request('item'))->delete();
        }
        notify()->success('Successful Operation','Operation Deleted Successfully');
        return redirect()->back();
    }
}
