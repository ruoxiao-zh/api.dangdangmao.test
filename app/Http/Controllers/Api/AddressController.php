<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AddressRequest;
use App\Models\Address;
use App\Transformers\AddressTransformer;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('Id', $this->user()->ID)->paginate();

        return $this->response->paginator($addresses, new AddressTransformer());
    }

    public function store(AddressRequest $request, Address $address)
    {
        $address->fill($request->all());
        $address->UserId = $this->user()->UserId;
        $address->save();

        return $this->response->item($address, new AddressTransformer())->setStatusCode(201);
    }

    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return $this->response->item($address, new AddressTransformer());
    }

    public function show(Address $address)
    {
        return $this->response->item($address, new AddressTransformer());
    }

    public function destory(Address $address)
    {
        $address->delete();

        return $this->response->noContent();
    }
}
