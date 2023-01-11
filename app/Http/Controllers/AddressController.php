<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $result  = $request->user()->addresses()->create($request->all());

        if ($result) {
            return Redirect::back()->with(['success'=>true, 'message', 'Created successfully']);
        } else {
            return Redirect::back()->with(['success'=>false, 'message', 'You are not permitted.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAddressRequest  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $result = $address->update($request->all());
        if ($result) {
            return Redirect::back()->with(['success' => true, 'message', 'Updated successfully.']);
        } else {
            return Redirect::back()->with(['success'=>false, 'message', 'Updated failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $result = $address->delete();
        if ($result) {
            return Redirect::back()->with(['success'=>true, 'message', 'Address Deleted']);
        } else {
            return Redirect::back()->with(['success'=>false, 'message', 'Deleted failed']);
        }
    }
}
