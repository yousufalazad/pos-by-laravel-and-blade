<?php

namespace App\Http\Controllers\Admin;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Http\Requests\ProductInRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_in = Stock::join('products', 'products.id', '=', 'stocks.product_id')
        ->join('suppliers', 'suppliers.id', '=', 'stocks.supplier_id')
        ->select('stocks.id','stocks.in_quantity', 'stocks.in_unit_price', 'stocks.in_total_amount', 'stocks.date', 'products.name as product_name', 'suppliers.name as supplier_name')
        ->where('type', '=', 1)
        ->get();

        return view('admin.products_in.index', compact('products_in'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.products_in.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductInRequest $request)
    {
        $stock = Stock::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'in_quantity' => $request->in_quantity,
            'in_unit_price' => $request->in_unit_price,
            'in_total_amount' => $request->in_total_amount,
            'in_discount_amount' => $request->in_discount_amount,
            'date' => $request->date,
            'user_id' => $request->user()->id,
            'type' => 1,
        ]);

        if (!$stock) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.products_in.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);

        // Stock::create($request->validated());
        // return redirect()->route('admin.products_in.index')->with([
        //     'message' => 'successfully created !',
        //     'alert-type' => 'success'
        // ]);
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
        $suppliers = Supplier::all();
        $products = Product::all();

        // dd($stock);
        return view('admin.products_in.edit', compact('stock', 'suppliers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductInRequest $request,  $id)
    {
        $stock = Stock::find($id);
        $stock->update([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'in_quantity' => $request->in_quantity,
            'in_unit_price' => $request->in_unit_price,
            'in_total_amount' => $request->in_total_amount,
            'in_discount_amount' => $request->in_discount_amount,
            'date' => $request->date,
            'user_id' => $request->user()->id,
            'type' => 1,
        ]);
        if (!$stock) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.products_in.index')->with([
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

    public function massDestroy()
    {
        Stock::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
