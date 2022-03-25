<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Customer;
use App\Models\Payment;
use Cassandra\Custom;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|View
     */
    public function index()
    {
        if (\request()->ajax()) {
            return datatables()->eloquent(Payment::query())
                ->addColumn('action', function ($payment) {
                    $button = '<a href="' . route('payments.edit', ['payment' => $payment->id]) . '" class="border-b border-blue-500">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="' . route('payments.destroy', ['payment' => $payment->id]) . '" class="text-red-500 border-b border-blue-400">Delete</button>';
                    return $button;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('d/m/Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('payment.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $customers = Customer::latest()->get();
        return view('payment.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(PaymentRequest $request)
    {
        Payment::create($request->all());

        return redirect()->route('payments.show')->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     * @return Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Payment $payment
     * @return Application|Factory|View
     */
    public function edit(Payment $payment)
    {
        $customers = Customer::latest()->get();
        return view('payment.edit', compact('payment', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentRequest $request
     * @param Payment $payment
     * @return RedirectResponse
     */
    public function update(PaymentRequest $request, Payment $payment): RedirectResponse
    {
        $payment->update($request->all());

        return  redirect(route('payments.show'))->with('success', 'Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Payment $payment
     * @return RedirectResponse
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return back()->with('success', 'Payment deleted successfully');
    }
}
