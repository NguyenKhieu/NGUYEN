<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Hocsinh;

class HocSinhController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $hocsinh = HocSinh::all();
        return view('restful.list',compact('hocsinh'));
    }
    /**
     * Show the form for creating a new resource.[GET]
     *
     * @return Response
     */
    public function create()
    {
        return view('restful.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $hocsinh = new HocSinh;
        $hocsinh->hoten = $request->txtHoTen;
        $hocsinh->toan = $request->txtToan;
        $hocsinh->ly = $request->txtLy;
        $hocsinh->hoa = $request->txtHoa;
        $hocsinh->save();
        return redirect()->route('hocsinh.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        echo "Đây là dòng dữ liệu thứ $id";
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = HocSinh::find($id);
        return view('restful.edit',compact('data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        $hocsinh = HocSinh::find($id);
        $hocsinh->hoten = $request->txtHoTen;
        $hocsinh->toan = $request->txtToan;
        $hocsinh->ly = $request->txtLy;
        $hocsinh->hoa = $request->txtHoa;
        $hocsinh->save();
        return redirect()->route('hocsinh.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $hocsinh = HocSinh::findOrFail($id);
        $hocsinh->delete();
        return redirect()->route('hocsinh.index');
    }
}
