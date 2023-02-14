<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\InertiaApplicationController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContactController extends InertiaApplicationController
{
    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheHelper::getContactCacheKey($currentPage);

        if (! empty($request->search)) {
            $q = $request->search;
            $contacts = Contact::where('name', 'LIKE', '%'.$q.'%')
            ->orWhere('email', 'LIKE', '%'.$q.'%')
            ->orWhere('phone', 'LIKE', '%'.$q.'%')
            ->orWhere('subject', 'LIKE', '%'.$q.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

            return Inertia::render('Dashboard/Contact/Index', ['contacts' => $contacts]);
        }

        $contacts = Cache::remember($key, 10, function () {
            return Contact::orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_contact_url', $request->fullUrl());

        return Inertia::render('Dashboard/Contact/Index')->with(['contacts' => $contacts]);
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

        if (session('last_visited_contact_url')) {
            return Redirect::to(session('last_visited_contact_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
