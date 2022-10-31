<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Country;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class ProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('My Profile', '');
        return view('office.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        $qualifications = Qualification::pluck('name', 'id');

        // If the user's profile is not complete, the middleware redirects the user to Create Page
        $this->setPageTitle('Complete your Profile', '');
        return view('office.profile.create', compact('qualifications', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'nid' => ['required', 'string'],
            'nid_expiry' => ['required', 'date'],
            'dob' => ['required', 'date'],
            'sex' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'building_name' => ['required', 'string'],
            'city_id' => ['required', 'not_in:0'],
            'area' => ['required', 'string'],
            'street' => ['required', 'string'],
            'qualification_id' => ['required', 'not_in:0'],
            'years_of_exp' => ['required', 'numeric'],
        ]);

        $referral_code = 'DIT-' . mt_rand(1111, 9999) . Str::upper(Str::random(4));
        $validated['referral_code'] = $referral_code;

        $created = Auth::user()->user_detail()->create($validated);

        if (!$created) {
            return $this->responseRedirectBack('something went wrong, please try later', 'warning', true, true);
        }

        Auth::user()->profile_completed = 1;
        Auth::user()->save();

        return $this->responseRedirect('my-profile.index', 'Profile Updated', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::id() != $id) {
            abort(401);
        }
        $countries = Country::pluck('name', 'id');
        $qualifications = Qualification::pluck('name', 'id');

        $this->setPageTitle('Edit Profile', '');
        return view('office.profile.edit', compact('qualifications', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = request()->validate([
            'name' => ['required', 'string'],
            'mobile' => ['required', 'unique:users,mobile,' . $id],
            'email' => ['required', 'unique:users,email,' . $id],
            'nid' => ['required', 'string'],
            'nid_expiry' => ['required', 'date'],
            'dob' => ['required', 'date'],
            'sex' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'building_name' => ['required', 'string'],
            'city_id' => ['required', 'not_in:0'],
            'area' => ['required', 'string'],
            'street' => ['nullable', 'string'],
            'qualification_id' => ['required', 'not_in:0'],
            'years_of_exp' => ['required', 'numeric'],
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);
        $updated = Auth::user()->user_detail()->update([
            'nid' => $validated['nid'],
            'nid_expiry' => $validated['nid_expiry'],
            'dob' => $validated['dob'],
            'sex' => $validated['sex'],
            'country_id' => $validated['country_id'],
            'building_name' => $validated['building_name'],
            'city_id' => $validated['city_id'],
            'area' => $validated['area'],
            'street' => $validated['street'],
            'qualification_id' => $validated['qualification_id'],
            'years_of_exp' => $validated['years_of_exp'],
        ]);

        if (!$updated) {
            return $this->responseRedirectBack('something went wrong, please try later', 'warning', true, true);
        }

        return $this->responseRedirect('my-profile.index', 'Profile Updated', 'success');
    }
}
