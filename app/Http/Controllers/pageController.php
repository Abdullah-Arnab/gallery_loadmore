<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;

class pageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myProduct(Request $request) {
        $products = Product::paginate(24);

        if ($request->ajax()) {
            $view = view('data', compact('products'))->render();
            return response()->json(['html' => $view]);
        }

        return view('my-product', compact('products'));
    }

    public function index() {
        $data['products'] = Product::get();
        return view('welcome', ['data' => $data]);
    }

    public function home() {

        $data['products'] = Product::get();
        return view('home', ['data' => $data]);
    }

    public function addView(Request $request) {

        //$views = $request->view+1;
        //DB::table('products')->where([ ['product_row_id', $request->product_row_id],])->update([ 'product_views' => $views]);
        $hello = Product::where('product_row_id',$request->post('dataString'))->increment('product_views');
//        dd($views);
        $views = Product::where('product_row_id',$request->post('dataString'))->first()->product_views;
        
        return $views;
    }
    
    public function addLike(Request $request) {

        //$views = $request->view+1;
        //DB::table('products')->where([ ['product_row_id', $request->product_row_id],])->update([ 'product_views' => $views]);
        $hello = Product::where('product_row_id',$request->post('dataString'))->increment('product_likes');
//        dd($views);
        $likes = Product::where('product_row_id',$request->post('dataString'))->first()->product_likes;
        
        return $likes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
