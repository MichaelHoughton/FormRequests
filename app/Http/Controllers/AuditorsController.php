<?php

namespace App\Http\Controllers;

use App\Auditor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditors = Auditor::orderBy('name')
            ->paginate(50);

        return view('auditors.index', compact('auditors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auditors.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'address.suburb' => 'required_with:address.address_1',
            'address.post_code' => 'required_with:address.address_1|max:10',
            'address.state' => 'required_with:address.address_1',
            'address.country' => 'required_with:address.address_1',
        ], [
            'address.suburb.required_with' => 'The suburb field is required.',
            'address.post_code.required_with' => 'The post code field is required.',
            'address.post_code.max' => 'The post code may not be greater than 10 characters.',
            'address.state.required_with' => 'The state is required.',
            'address.country.required_with' => 'The country is required.',
        ]);

        $auditor = Auditor::create($request->all());

        if ($request->address['address_1']) {
            $auditor->address()
                ->create($request->address);
        }

        session()->flash('success', 'The auditor was successfully created.');
        return redirect()->route('auditors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auditor
     * @return \Illuminate\Http\Response
     */
    public function show(Auditor $auditor)
    {
        $auditor->load('address');

        return view('auditors.show', compact('auditor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auditor
     * @return \Illuminate\Http\Response
     */
    public function edit(Auditor $auditor)
    {
        $auditor->load('address');

        return view('auditors.form', compact('auditor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auditor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auditor $auditor)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'address.suburb' => 'required_with:address.address_1',
            'address.post_code' => 'required_with:address.address_1|max:10',
            'address.state' => 'required_with:address.address_1',
            'address.country' => 'required_with:address.address_1',
        ], [
            'address.suburb.required_with' => 'The suburb field is required.',
            'address.post_code.required_with' => 'The post code field is required.',
            'address.post_code.max' => 'The post code may not be greater than 10 characters.',
            'address.state.required_with' => 'The state is required.',
            'address.country.required_with' => 'The country is required.',
        ]);

        $auditor->update($request->all());

        // lets see if there is an address
        if ($request->address['address_1']) {
            $auditor->address()
                ->create($request->address);
        } else {
            // lets delete any previously saved addresses
            $auditor->address()
                ->delete();
        }

        session()->flash('success', 'The auditor was successfully updated.');
        return redirect()->route('auditors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auditor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auditor $auditor)
    {
        $auditor->delete();

        session()->flash('success', 'The auditor was successfully deleted.');
        return redirect()->route('auditors.index');
    }
}
