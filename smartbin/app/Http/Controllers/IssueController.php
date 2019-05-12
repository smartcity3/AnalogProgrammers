<?php

namespace App\Http\Controllers;

use App\issue;
use App\bin;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $issue = new issue;
        $issue->bin_id=$request->input('id');
        $issue->type=$request->input('issueop');
        $issue->hide=0;
        $issue->save();
        $bins = bin::with('issue')->get();
        return view('map',['bins'=>$bins]);
        
    }

    public function hide($id)
    {
        $issue= issue::find($id);
        $issue->hide=1;
        $issue->save();
        return redirect('/map');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(issue $issue)
    {
        //
    }
}
