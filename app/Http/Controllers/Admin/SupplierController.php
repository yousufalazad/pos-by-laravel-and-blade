<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $profile_img_path = '';

        if ($request->hasFile('profile_img')) {
            $profile_img_path = $request->file('profile_img')->store('suppliers', 'public');
        }

        $supplier = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'profile_img' => $profile_img_path,
            'user_id' => $request->user()->id,
        ]);
        
        if (!$supplier) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.suppliers.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);

        // Supplier::create($request->validated());
        // return redirect()->route('admin.suppliers.index')->with([
        //     'message' => 'successfully created !',
        //     'alert-type' => 'success'
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $profile_img_path = '';

        if ($request->hasFile('profile_img')) {
            // Delete old profile_img
            if ($supplier->profile_img) {
                Storage::delete($supplier->profile_img);
            }
            // Store profile_img
            $profile_img_path = $request->file('profile_img')->store('suppliers', 'public');
            // Save to Database
            $supplier->profile_img = $profile_img_path;
        }
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'user_id' => $request->user()->id,
        ]);
        
        if (!$supplier) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.suppliers.index')->with([
            'message' => 'successfully update !',
            'alert-type' => 'info'
        ]);

        // $supplier->update($request->validated());
        // return redirect()->route('admin.suppliers.index')->with([
        //     'message' => 'successfully updated !',
        //     'alert-type' => 'info'
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    // table select destroy
    public function massDestroy()
    {
        Supplier::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
