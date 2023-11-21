<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public static function getInventoryCount() : int
    {
        $counts = DB::table('products')->get('inventory_count');
        
        $total = 0;
        foreach($counts as $count) {
            $total = $total + $count->inventory_count; 
        }
        return $total;
    }

    public function getInventory(Request $request)
    {
        
        
        if(isset($request->productCategory)){
            $products = DB::table('products')
            ->where('category', '=', $request->productCategory)
            ->orderBy('name', 'ASC')->paginate(50);
        }
        
        
        if(isset($request->search)) {
            $products = DB::table('products')
                ->where('name', 'LIKE', '%' . $request->search. '%')->paginate(50); 
        }

        if(!isset($request->search) && !isset($request->productCategory) || $request->productCategory === 'ALL-PRODUCTS') {
            $products = DB::table('products')
                ->orderBy('name', 'ASC')
                ->paginate(9);
        }
        
            $categories = self::getDistinctCategories();


        return view('product-inventory', [
            'products' => $products, 
            'categories' => $categories
        ]);
    }

    public function editProduct($id) 
    {
        $product = Product::find($id);
        
        return view('edit-product', [
            'product' => $product, 
            'categories' => self::getDistinctCategories(),
        ]);
    }

    public function updateProduct(int $id, Request $request)
    {
       
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description; 
        $product->item_number = $request->item_number; 
        $product->inventory_count = $request->inventory_count;
        $product->price = $request->price; 
        
        if(!empty($request->category)){
            $product->category = $request->category;
        }

        if(!empty($request->file('image_url'))){
            $path = Storage::disk('local')->put('dbImages', $request->file('image_url'));
            $product->image_url = $path; 
        }

        $product->save(); 

        return redirect('/edit-product/' . $product->id . '?status=success');
    }

    public function deactivate($id) {
        $product = Product::find($id); 
        $product->active = 0; 
        $product->save(); 

        return redirect('/product-inventory' . '?notActive=' . $product->name); 
    }

    public function add() {
       
        return view('add-product', [ 
            'categories' => self::getDistinctCategories(),
        ]); 
    }

    public function addNewProduct(Request $request) {
        $product = new Product(); 
        $product->name = $request->name;
        $product->description = $request->description; 
        $product->item_number = $request->item_number; 
        $product->category = $request->category; 
        $product->inventory_count = $request->inventory_count;
        $product->price = $request->price; 

        if(!empty($request->file('image_url'))){
            $path = Storage::disk('local')->put('dbImages', $request->file('image_url'));
            $product->image_url = $path; 
        }

        $product->save();
        return redirect('/edit-product/' . $product->id . '?status=success');
    }



    public static function getDistinctCategories() {
        return DB::table('products')->select('category')->distinct()->get(); 
    }
}
