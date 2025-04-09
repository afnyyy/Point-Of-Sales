<?php

namespace App\Http\Controllers;

use App\models\Categories;
use App\models\Products;
use App\models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Orders";
        $datas = Orders::orderBy('id', 'desc')->get();
        return view('pos.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('pos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'category_id'=> $request->category_id,
            'product_name'=> $request->product_name,
            'product_price'=> $request->product_price,
            'product_description'=> $request->product_description,
            'is_active'=> $request->is_active,

        ];
        // hasfile
        // !empty()
        // $_FILES, $request->file
        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('product', 'public');
            $data['product_photo'] = $photo;
        }
        Products::create($data) ;
        toast('Data added successfully!','success');
        return redirect()->to('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Products::find($id);
        $categories = Categories::orderBy('id','desc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $category = Categories::find( $id );
        // $category->category_name = $request->category_name;
        // $category->save();

        $data = [
            'category_id'=> $request->category_id,
            'product_name'=> $request->product_name,
            'product_price'=> $request->product_price,
            'product_description'=> $request->product_description,
            'is_active'=> $request->is_active,

        ];
        $product = Products::find( $id );
        if($request->hasFile('product_photo')){
            if($product->product_photo){
                File::delete(public_path('storage/'.$product->product_photo));
            }
            $photo = $request->file('product_photo')->store('product', 'public');
            $data['product_photo'] = $photo;
        }
        $product->update($data);
        Alert::success('Success', 'Update Success');
        return redirect()->to('products');

        // Products::where('id', $id)->update([
        //     'category_name' => $request->category_name,
        // ]) ;
        // return redirect()->to('categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        toast('Data success delete!','success');
        return redirect()->to('products');
    }

    public function getProduct($category_id)
    {
        $products = Products::where('category_id', $category_id)->get();
        $response = ['status' => 'success', 'message' => 'Fetch product success', 'data' => $products];
        return response()->json($response, 200);
    }
}
