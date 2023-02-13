<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
    * Filter role and permission
    */
    public function __construct()
    {
        $this->authorizeResource(Address::class, 'address');
    }
  
    
    public function store(StoreAddressRequest $request)
    {
        $result = $request->user()->addresses()->create($request->all());

        if ($result) {
            return Redirect::back()->with(['success' => true, 'message', 'Created successfully']);
        } else {
            return Redirect::back()->with(['success' => false, 'message', 'You are not permitted.']);
        }
    }

    
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $result = $address->update($request->all());

        if ($result) {
            return Redirect::back()->with(['success' => true, 'message', 'Updated successfully.']);
        } else {
            return Redirect::back()->with(['success' => false, 'message', 'Updated failed']);
        }
    }

  
    public function destroy(Address $address)
    {
        $result = $address->delete();

        if ($result) {
            return Redirect::back()->with(['success' => true, 'message', 'Address Deleted']);
        } else {
            return Redirect::back()->with(['success' => false, 'message', 'Deleted failed']);
        }
    }
}
