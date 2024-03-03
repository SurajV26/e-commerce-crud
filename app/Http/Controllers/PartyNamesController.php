<?php

namespace App\Http\Controllers;

use App\Models\Party_names;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PartyNamesController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Party_names::latest();

        $search = $request->input('search');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('party_name', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%")
                ->orWhere('billing_name', 'like', "%$search%")
                ->orWhere('contact_person', 'like', "%$search%")
                ->orWhere('contact_number', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        $party_names = $query->paginate(5);

        return view('customer_names.index', compact('party_names', 'search'))
            ->with('i', ($party_names->currentPage() - 1) * $party_names->perPage());
    }

    public function create()
    {
        return view('customer_names.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'party_name' => 'required',
            'location' => 'required',
            'billing_name' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required|numeric|digits:10',
            'email' => 'nullable|email|ends_with:gmail.com',
            'executive_name' => 'nullable',
            'no_of_licenses' => 'required',
            'amc_start_date' => 'required|date',
            'amc_expiry_date' => 'required|date|after:amc_start_date',
            'past_amc_charge' => 'nullable',
            'new_quoted_amc_charge' => 'required',
            'payment_status' => 'required',
            'address' => 'nullable',
        ]);


        $amcStartDate = Carbon::parse($request->input('amc_start_date'));
        $amcExpiryDate = Carbon::parse($request->input('amc_expiry_date'));

        $currentDate = Carbon::now();

        $amcStatus = ($currentDate <= $amcExpiryDate) ? 'active' : 'expired';

    
        $customer_name = new Party_names([
            'party_name' => $request->get('party_name'),
            'location' => $request->get('location'),
            'billing_name' => $request->get('billing_name'),
            'contact_person' => $request->get('contact_person'),
            'contact_number' => $request->get('contact_number'),
            'email' => $request->get('email'),
            'executive_name' => $request->get('executive_name'),
            'no_of_licenses' => $request->get('no_of_licenses'),
            'amc_start_date' => $amcStartDate,
            'amc_expiry_date' => $amcExpiryDate,
            'past_amc_charge' => $request->get('past_amc_charge'),
            'new_quoted_amc_charge' => $request->get('new_quoted_amc_charge'),
            'amc_status' => $amcStatus,
            'payment_status' => $request->get('payment_status'),
            'address' => $request->get('address'),
        ]);
    
        $customer_name->save();
    
        return redirect()->route('customer_names.index')
            ->with('success', 'New Customer created successfully.');
    }

    public function show(Party_names $customer_name)
    {
        return view('customer_names.show', compact('customer_name'));
    }
    
    public function edit(Party_names $customer_name)
    {
        return view('customer_names.edit', compact('customer_name'));
    }
    
    public function update(Request $request, Party_names $customer_name)
    {
        $request->validate([
            'party_name' => 'required',
            'location' => 'required',
            'billing_name' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required|numeric|digits:10',
            'email' => 'nullable|email|ends_with:gmail.com',
            'executive_name' => 'nullable',
            'no_of_licenses' => 'required',
            'amc_start_date' => 'date',
            'amc_expiry_date' => 'date|after:amc_start_date',
            'past_amc_charge' => 'nullable',
            'new_quoted_amc_charge' => 'required',
            'payment_status' => 'required',
            'address' => 'nullable',
        ]);
        
        $amcStartDate = Carbon::parse($request->input('amc_start_date'));
        $amcExpiryDate = Carbon::parse($request->input('amc_expiry_date'));

        $currentDate = Carbon::now();

        $amcStatus = ($currentDate <= $amcExpiryDate) ? 'active' : 'expired';
    
        $customer_name->update([
            'party_name' => $request->get('party_name'),
            'location' => $request->get('location'),
            'billing_name' => $request->get('billing_name'),
            'contact_person' => $request->get('contact_person'),
            'contact_number' => $request->get('contact_number'),
            'email' => $request->get('email'),
            'executive_name' => $request->get('executive_name'),
            'no_of_licenses' => $request->get('no_of_licenses'),
            'amc_start_date' => $amcStartDate,
            'amc_expiry_date' => $amcExpiryDate,
            'past_amc_charge' => $request->get('past_amc_charge'),
            'new_quoted_amc_charge' => $request->get('new_quoted_amc_charge'),
            'amc_status' => $amcStatus,
            'payment_status' => $request->get('payment_status'),
            'address' => $request->get('address'),
        ]);
    
            $customer_name->update($request->all());

        return redirect()->route('customer_names.index')
            ->with('success', 'Customer details updated successfully.');
    }
    
    public function destroy(Party_names $customer_name)
    {
        $customer_name->delete();
    
        return redirect()->route('customer_names.index')
            ->with('success', 'Customer details deleted successfully.');
    }
    
}
