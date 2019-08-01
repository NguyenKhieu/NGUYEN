<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Categories;
use App\Http\Requests\StoreProductTypeRequest;
use Validator;
class ProductTypeController extends Controller
{
    public function showView()
    {
        $producttype = ProductType::all();
        $category = Categories::all();
        return response()->json(['producttype'=>$producttype,'category'=>$category]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.pages.producttype.list');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::where('status',1)->get();
        return view('admin.pages.producttype.add',compact('category'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        $data =$request->all();
        $data['slug'] = utf8tourl($request->name);
        if(ProductType::create($data)){
            return redirect()->route('producttype.index')->with('thongbao','Add success ProductType');
        }else{
            return back()->with('thongbao','Eror occurred, check again');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  $id
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
        $producttype = ProductType::find($id);
        $category = Categories::where('status',1)->get();
        return response()->json(['category' => $category, 'producttype' => $producttype],200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $producttype = ProductType::find($id);
        $data = $request -> all();
        $producttype->update([
            'name' => $request->name,
            'slug' => utf8tourl($request->name),
            'category' => $request->nameCategory,
            'status' => $request->status,
        ]);

        return response()->json([$producttype, 'message' => 'Edit success']);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $this->producttype->deleteProductType($id);

        $producttype = ProductType::find($id);
        $producttype->delete();

        return response()->json(['success' => 'Delete success']);
    }
    function timkiem(Requets $requets)
    {
        $tukhoa = $requets->tukhoa;
        $productype = ProducType::where('name','like',"%$tukhoa%")
            ->take(5);
        return view('admin.search',['productype'=>$productype,'tukhoa'=>$tukhoa]);
    }
}
