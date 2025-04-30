<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoiceFilter;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $filer = new InvoiceFilter();
        $query = $filer->transform($request);

        if(count($query) == 0){
            return new InvoiceCollection(Invoice::paginate(5));
        }else{
            $invoices = Invoice::where($query)->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }

    }

    public function store(StoreInvoiceRequest $request)
    {   
        $invoice = Invoice::create([
            'amount' => $request->amount,
            'status' => $request->status,
            'billed_date' => $request->billedDate,
            'paid_date' => $request->paidDate,
            'customer_id' => $request->customerId
        ]);

        return response()->json([
            'message' => 'Added Successful',
            'data' => new InvoiceResource($invoice)
        ]);
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update([
            'amount' => $request->amount ?? $invoice->amount,
            'status' => $request->status ?? $invoice->status,
            'billed_date' => $request->billedDate ?? $invoice->billed_date,
            'paid_date' => $request->paidDate ?? $invoice->paid_date,
            'customer_id' => $request->customerId ?? $invoice->customerId
        ]);

        return response()->json([
            'message' => 'Update Successful',
            'data' => new InvoiceResource($invoice)
        ]);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json([
            'message' => 'Delete Successful',
            'data' => new InvoiceResource($invoice)
        ]);
    }
}
