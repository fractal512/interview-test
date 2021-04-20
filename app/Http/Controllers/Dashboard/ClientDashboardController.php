<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\RequestAfterCreateJob;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{

    /**
     * ClientDashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('clientthrottle:3,1440')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasRole('client')) {
            abort(403);
        }

        return view('dashboard.client');
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
        if(!auth()->user()->hasRole('client')) {
            return back()
                ->withErrors(['msg' => "No client role! Store failed."]);
        }

        $request->validate([
            'subject' => 'required|min:5|max:200',
            'message' => 'required|min:5|max:5000',
            'file' => 'required|max:2048',
        ]);


        $requestModel = new \App\Models\Request();
        $requestModel->user_id = auth()->user()->id;
        $data = $request->all();
        $requestModel->subject = $data['subject'];
        $requestModel->message = $data['message'];
        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        $requestModel->file_path = '/storage/' . $filePath;
        $requestModel->checked = false;
        $requestModel->save();

        $job = new RequestAfterCreateJob($requestModel);
        $this->dispatch($job);

        return back()
            ->with('success','Request has been created successfully.')
            ->with('file', $fileName);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
