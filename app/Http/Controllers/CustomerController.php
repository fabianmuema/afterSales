<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return View|JsonResponse
     * @throws Exception
     */
    public function show(Customer $customer)
    {
        if (\request()->ajax()) {
            return DataTables::eloquent($customer->query())
                ->addIndexColumn()
                ->addColumn('edit', function ($customer) {
                    return '<a href="' . route('customers.edit', ['customer' => $customer->id]) . '" class="border-b-2 text-blue-500">Edit<a>';
                })
                ->addColumn('delete', function ($customer) {
                    return '<a href="' . route('customers.destroy', ['customer' => $customer->id]) . '" class="border-b-2 text-red-500">Delete<a>';
                })
                ->addColumn('total_transactions', function ($customer) {
                    return Payment::where('customer_email', $customer->email)->count();
                })
                ->addColumn('lifetime_revenue', function ($customer) {
                    return Payment::where('customer_email', $customer->email)->sum('amount');
                })
                ->addColumn('created_at', function ($customer) {
                    return $customer->created_at->format('d/m/Y h:i A');
                })
                ->rawColumns(['edit', 'delete'])
                ->make();
        }

        return view('customers.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return \view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return back()->with('success', 'Customer deleted successfully');
    }
}
