<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Image;

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
        $hello = Product::where('product_row_id', $request->post('dataString'))->increment('product_views');
//        dd($views);
        $views = Product::where('product_row_id', $request->post('dataString'))->first()->product_views;

        return $views;
    }

    public function addLike(Request $request) {

        //$views = $request->view+1;
        //DB::table('products')->where([ ['product_row_id', $request->product_row_id],])->update([ 'product_views' => $views]);
        $hello = Product::where('product_row_id', $request->post('dataString'))->increment('product_likes');
//        dd($views);
        $likes = Product::where('product_row_id', $request->post('dataString'))->first()->product_likes;

        return $likes;
    }

    public function imageUpload()
    {
    	return view('image-upload');
    }

    /**
    * Manage Post Request
    *
    * @return void
    */
    public function imageUploadPost(Request $request)
    {
    	$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('thumbs'), $imageName);
        
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_image = $imageName;
        $product->save();
        
    	return back()
    		->with('success','Image Uploaded successfully.')
    		->with('path',$imageName);
    }

    /*Intervention*/
    
    public function resizeImage()
    {
    	return view('resizeImage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
	    $this->validate($request, [
	    	'product_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
     
   
        $destinationPat = public_path('/thumbs');
        $img = Image::make($image->getRealPath());
        $img->resize(201, 266, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPat.'/'.$input['imagename']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_image = $input['imagename'];
        $product->save();
       
        return back()
        	->with('success','Image Upload successful')
        	->with('imageName',$input['imagename']);
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
