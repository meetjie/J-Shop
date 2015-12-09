<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response就
     */
    public function index()
    {
        $brands = Brand::orderBy('sort_order')->paginate(config('j_shop.page_size'));
        return view('admin.brand.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.brand.create');
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => '品牌名称不能为空！',
            'url.required' => '品牌网址不能为空！',
            'url.url' => '品牌网址格式不正确！'
        ];

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
        ], $messages);

        Brand::create($request->all());
        return redirect(route('admin.brand.index'))->with('info', '新增品牌成功~');
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
        $brand = Brand::find($id);
        return view( 'admin.brand.edit',['brand' =>$brand]);
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
        $messages = [
            'name.required' => '品牌名称不能为空！',
            'url.required' => '品牌网址不能为空！',
            'url.url' => '品牌网址格式不正确！'
        ];
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
        ], $messages);

        $brand = Brand::find($id);
        $brand->update($request->all());
        return redirect(route('admin.brand.index'))->with('info', '编辑成功~');
    }

    public function sort(Request $request){
        Brand::where('id', $request->id)->update(['sort_order' => $request->sort_order]);
    }

    public function is_show(Request $request){
        Brand::where('id', $request->id)->update(['is_show' => !($request->is_show)]);
    }

    public function search(Request $request){
        $keyword = "%" . $request->keyword . "%";
        $brands = Brand::orderBy('sort_order')->where('name', 'like', $keyword)->paginate(config('p_shop.page_size'));

        return view('admin.brand.index', ['brands' => $brands]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        return back()->with('info', '删除品牌成功~');
    }
}
