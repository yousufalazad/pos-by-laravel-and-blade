<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Http\Requests\ProductOutRequest;

class ProductOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_out = Stock::join('products', 'products.id', '=', 'stocks.product_id')
        ->join('customers', 'customers.id', '=', 'stocks.customer_id')
        ->select('stocks.id','stocks.out_quantity', 'stocks.out_unit_price', 'stocks.out_ws_unit_price', 'stocks.date', 'products.name as product_name', 'customers.name as customer_name')
        ->where('type', '=', 2)
        ->get();

        return view('admin.products_out.index', compact('products_out'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.products_out.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductOutRequest $request)
    {
        $stock = Stock::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'out_quantity' => $request->out_quantity,
            'out_unit_price' => $request->out_unit_price,
            'out_ws_unit_price' => $request->out_ws_unit_price,
            'out_total_amount' => $request->out_total_amount,
            'out_discount_amount' => $request->out_discount_amount,
            'date' => $request->date,
            'user_id' => $request->user()->id,
            'type' => 2,
        ]);

        if (!$stock) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.products_out.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
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
        $stock = Stock::select('id','quantity','per_unit_price','date')->find($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.products_out.edit', compact('stock', 'customers', 'products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductOutRequest $request, $id)
    {
        $stock = Stock::find($id);
        $stock->update([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'out_quantity' => $request->out_quantity,
            'out_unit_price' => $request->out_unit_price,
            'out_ws_unit_price' => $request->out_ws_unit_price,
            'out_total_amount' => $request->out_total_amount,
            'out_discount_amount' => $request->out_discount_amount,
            'date' => $request->date,
            'user_id' => $request->user()->id,
            'type' => 2,
        ]);
        if (!$stock) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.products_out.index')->with([
            'message' => 'successfully update !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);

        $stock->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    // table select destroy
    public function massDestroy()
    {
        Stock::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
