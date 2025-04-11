<?php

namespace App\Http\Controllers;

use App\models\Categories;
use App\models\Products;
use App\models\Orders;
use App\models\orderDetails;
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
        //kode unik ORD-100425001
        $qOrderCode = Orders::max('id');
        $qOrderCode++ ;
        $orderCode = "ORD". date("dmY") . sprintf("%03d", $qOrderCode);
        $data = [
            'order_code'=> $orderCode,
            'order_date'=> date("Y-m-d"),
            'order_amount'=> $request->grandtotal,
            'order_change'=> 1,
            'order_status'=> 1,

        ];
        $order = Orders::create($data);

        $qty = $request->qty;
        foreach ($qty as $key => $data) {
            orderDetails::create([

                'order_id' => $order->id,
                'product_id' => $request->product_id[$key],
                'qty' => $request->qty[$key],
                'order_price'=> $request->order_price[$key],
                'order_subtotal'=> $request->order_subtotal[$key],
            ]);

        }
        toast('Data Added Successfully!','success');
        return redirect()->to('pos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Orders::findOrFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        $title = "Order Details Of " . $order->order_code;
        return view('pos.show', compact('order','orderDetails','title'));

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
    public function print($id)
    {
        $order = Orders::with('orderDetails')->FindOrFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        return view('pos.print-struk', compact('order','orderDetails'));
    }
}
