<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $profile_img_path = '';

        if ($request->hasFile('profile_img')) {
            $profile_img_path = $request->file('profile_img')->store('customers', 'public');
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'profile_img' => $profile_img_path,
            'user_id' => $request->user()->id,
        ]);
        
        if (!$customer) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.customers.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $profile_img_path = '';

        if ($request->hasFile('profile_img')) {
            // Delete old profile_img
            if ($customer->profile_img) {
                Storage::delete($customer->profile_img);
            }
            // Store profile_img
            $profile_img_path = $request->file('profile_img')->store('customers', 'public');
            // Save to Database
            $customer->profile_img = $profile_img_path;
        }
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'user_id' => $request->user()->id,
        ]);
        
        if (!$customer) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem.');
        }
        return redirect()->route('admin.customers.index')->with([
            'message' => 'successfully update !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    // table select destroy
    public function massDestroy()
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
