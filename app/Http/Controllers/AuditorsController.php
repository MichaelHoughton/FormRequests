<?php

namespace App\Http\Controllers;

use App\Auditor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuditorsRequest;

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
    public function store(AuditorsRequest $request)
    {
        $request->addAuditor();

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
    public function update(AuditorsRequest $request, Auditor $auditor)
    {
        $request->updateAuditor($auditor);

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
