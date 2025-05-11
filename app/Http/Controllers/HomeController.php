<?php
//devbanban.com 2025 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    public function index(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $products = DB::table('tbl_product')
        ->orderBy('id', 'desc')
        ->paginate(8); //8 produc/page 
        //->get();
        return view('home.product_index', compact('products'));
    }


    public function detail($id) {
        $product = DB::table('tbl_product')->where('id', $id)->first();
        if(isset($product)){
                $id = $product->id;
                $product_name = $product->product_name;
                $product_detail = $product->product_detail;
                $product_price = $product->product_price;
                $product_img = $product->product_img;
                return view('home.product_detail', compact('id', 'product_name', 'product_detail', 'product_price', 'product_img'));
        }else{
            return redirect('/'); //if can't query 
        }
    }


    public function searchProduct(Request $request) {
        // print_r($_GET);
        // exit;
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $keyword = $request->keyword;
        if(strlen($keyword) > 0){
            $products = DB::table('tbl_product') 
            ->where('product_name', 'like', '%' .$keyword .'%')
           ->paginate(8);
           //->get();
        }else{
            $products = DB::table('tbl_product')
            ->orderBy('id', 'desc')
            ->paginate(8); //8 produc/page 
        }
        return view('home.product_index', compact('products', 'keyword'));
        
    }





} //class
