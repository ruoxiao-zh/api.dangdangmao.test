<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProvinceAndCity;
use App\Http\Requests\Api\AddressRequest;
use App\Transformers\AddressTransformer;
use App\Transformers\ProvinceAndCityTransformer;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('UserId', $this->user()->UserId)->recent()->paginate();

        return $this->response->paginator($addresses, new AddressTransformer());
    }

    public function store(AddressRequest $request, Address $address)
    {
        if ((int)$request->IsDefault === 1) {
            Address::where('UserId', $this->user()->UserId)->update(['IsDefault' => 0]);
        }

        $address->fill($request->all());
        $address->UserId = $this->user()->UserId;
        $address->AddDate = Carbon::now()->toDateTimeString();
        $address->save();

        return $this->response->item($address, new AddressTransformer())->setStatusCode(201);
    }

    public function update(AddressRequest $request, Address $address)
    {
        if ((int)$request->IsDefault === 1) {
            Address::where('UserId', $this->user()->UserId)->update(['IsDefault' => 0]);
        }

        $address->update($request->all());

        return $this->response->item($address, new AddressTransformer());
    }

    public function show(Address $address)
    {
        return $this->response->item($address, new AddressTransformer());
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return $this->response->noContent();
    }

    public function getProvinceAndCityInfo(Request $request)
    {
        $results = ProvinceAndCity::filter($request->all())->get();

        return $this->response->collection($results, new ProvinceAndCityTransformer());
    }
}
