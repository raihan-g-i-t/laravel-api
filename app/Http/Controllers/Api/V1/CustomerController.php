<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $filter = new CustomerFilter();
        $query = $filter->transform($request);

        if(count($query) == 0){
            return new CustomerCollection(Customer::paginate());
        }else{
            $customers = Customer::where($query)->paginate();
            return new CustomerCollection($customers->appends($request->query()));
        }

    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'address'=> $request->address,
            'state'=> $request->state,
            'type'=> $request->type,
            'postal_code'=> $request->postalCode
        ]);

        return response()->json([
            'message' => 'Customer created successfully!',
            'data' => new CustomerResource($customer)
        ], 201);
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update([
            'name' => $request->name ?? $customer->name,
            'email' => $request->email ?? $customer->email,
            'city' => $request->city ?? $customer->city,
            'address'=> $request->address ?? $customer->address,
            'state'=> $request->state ?? $customer->state,
            'type'=> $request->type ?? $customer->type,
            'postal_code'=> $request->postalCode ?? $customer->postal_code
        ]);

        return response()->json([
            'Message' => 'Successful',
            'data' => new CustomerResource($customer)
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            "message" => 'Delete Successful',
            "data" => new CustomerResource($customer)
        ]);
    }
}
