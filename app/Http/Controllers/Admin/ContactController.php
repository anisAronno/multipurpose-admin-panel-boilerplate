<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CacheHelper;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Resources\ContactResources;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ContactController extends InertiaApplicationController
{
    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $orderBy    = in_array($request->get('orderBy'), ['created_at']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $contactCacheKey = CacheHelper::getContactCacheKey();

        $user  = auth()->user();
        $key =  $contactCacheKey.md5(serialize([$orderBy, $order,  $page, $search, $startDate, $endDate,  ]));

        $contacts = CacheHelper::init($contactCacheKey)->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $search,
            $startDate,
            $endDate,
            $user,
        ) {
            $contacts = new Contact();

            if (! $user->haveAdministrativeRole()) {
                $contacts->where('user_id', $user->id);
            }

            if (! empty($search)) {
                $contacts->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%')
                ->orWhere('subject', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $contacts->where('created_at', '>=', new \DateTime($startDate));
                $contacts->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $contacts->orderBy($orderBy, $order);
            }

            return $contacts->paginate(10);
        });


        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/Contact/Index')->with(['contacts' => ContactResources::collection($contacts)]);
    }

      /**
       * Summary of show
       * @param Request $request
       * @param Contact $contact
       * @return \Inertia\Response
       */
    public function show(Contact $contact)
    {
        return Inertia::render('Dashboard/Contact/Show')->with(['contact' => $contact]);
    }

    /**
     * Summary of destroy
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
