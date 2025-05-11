<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;




class ProductController extends Controller
{

 

    public function index(){

        Paginator::useBootstrap(); // ใช้ Bootstrap pagination

        $products = DB::table('tbl_product')
        ->orderBy('id', 'desc')
        ->paginate(5); //5 produc/page 
        //->get();
        return view('products.list', compact('products'));
    }


    public function list(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $products = DB::table('tbl_product')
        ->orderBy('id', 'desc')
        ->paginate(5); //5 produc/page 
        //->get();
        return view('products.list', compact('products'));
    }

    public function adding() {
        $id = null;
        $product_name = null;
        $product_detail = null;
        $product_price = null;
        $product_img = null;
        
        return view('products.create', compact('id', 'product_name', 'product_detail', 'product_price', 'product_img'));
    }

    public function create(Request $request) {

         // Validate input
         $request->validate([
            'product_name' => 'required|min:3',
            'product_detail' => 'required|min:3',
            'product_price' => 'required|numeric|min:0',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload image (ถ้ามี)
        $imagePath = null;
        if ($request->hasFile('product_img')) {
            $imagePath = $request->file('product_img')->store('uploads/product/', 'public');
        }

        // Insert into DB using Query Builder
        //strip_tags prevent xxs naja
        DB::table('tbl_product')->insert([
            'product_name' => strip_tags($request->product_name),
            'product_detail' => strip_tags($request->product_detail),
            'product_price' => $request->product_price,
            'product_img' => $imagePath,
        ]);


        Alert::success('Insert Successfully');
        //Alert::success('สำเร็จ', 'บันทึกข้อมูลเรียบร้อยแล้ว!');
        return redirect('/product');
    }


    public function edit($id){
        $product = DB::table('tbl_product')->where('id', $id)->first();
        if(isset($product)){
            $id = $product->id;
            $product_name = $product->product_name;
            $product_detail = $product->product_detail;
            $product_price = $product->product_price;
            $product_img = $product->product_img;
            return view('products.edit', compact('id', 'product_name', 'product_detail', 'product_price', 'product_img'));
        }else{
            return redirect('/product'); //if can't query 
         }
    } //func

    public function update($id, Request $request) {

        // print_r($_POST);
        // exit;

        $validator = Validator::make($request->all(),
        [
            'product_name' => 'required|min:3',
            'product_detail' => 'required|min:3',
            'product_price' => 'required|numeric|min:0',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails()){
            return redirect('product/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        // Upload image (ถ้ามี)
        $imagePath = null;
        if ($request->hasFile('product_img')) {

            //delete old img
            if(isset($request->oldImg)){
                 Storage::disk('public')->delete($request->oldImg);
            }

        //upload new image file
            $imagePath = $request->file('product_img')->store('uploads/product/', 'public');

        }else{
            $imagePath = $_POST['oldImg'];
        }

        //strip_tags prevent xxs naja
        $product = DB::table('tbl_product')->where('id', $id)->update([
            'product_name' => strip_tags($request->product_name),
            'product_detail' => strip_tags($request->product_detail),
            'product_price' => $request->product_price,
            'product_img' => $imagePath
        ]);
       Alert::success('Update Successfully');
       //Alert::success('สำเร็จ', 'บันทึกข้อมูลเรียบร้อยแล้ว!');

        return redirect('/product');
    }



//delete data and image file naja 
public function remove($id)
{
    // ดึงข้อมูลจาก DB
    $product = DB::table('tbl_product')->where('id', $id)->first();

    if (!$product) {
        //return redirect()->back()->with('error', 'Product not found.');
        Alert::error('Product not found.');
        return redirect('product');
    }

    // ลบไฟล์ภาพ (ถ้ามี)
    if ($product->product_img && Storage::disk('public')->exists($product->product_img)) {
        Storage::disk('public')->delete($product->product_img);
    }

    // ลบข้อมูลจาก DB
    DB::table('tbl_product')->where('id', $id)->delete();
    Alert::success('Delete Successfully');
    return redirect('product');
    //return redirect()->back()->with('success', 'Product deleted successfully!');
}




} //class
