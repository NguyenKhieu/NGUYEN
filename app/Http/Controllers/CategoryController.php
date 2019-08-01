<?php

namespace App\Http\Controllers;

//use App\Category;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ProductType;
use App\Http\Requests\StoreCategoryRequest;
use Validator;


class CategoryController extends Controller
{
    public function showView()
    {
        $category = Categories::paginate(5);

        return response()->json($category);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::paginate(5);
        return view('admin.pages.category.list', compact("category"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Categories::create([
            'name' => $request->name,
            'slug' => utf8tourl($request->name),
            'status' => $request->status,
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::find($id);
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => utf8tourl($request->name),
            'status' => $request->status,
        ]);

        return response()->json([$category, 'message' => 'Edit success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $this->category->deleteCategory($id);

        $category = Categories::find($id);
        $category->delete();

        return response()->json(['success' => 'Delete success']);
    }
    public function timkiem(Request $requets)
    {
        $tukhoa = $requets->tukhoa;
        $producttype = ProductType::where('name','like',"%$tukhoa%")
            ->take(5)->get();
        return view('admin.search',['producttype'=>$producttype,'tukhoa'=>$tukhoa]);
    }
}
