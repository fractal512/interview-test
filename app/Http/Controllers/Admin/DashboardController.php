<?php

namespace App\Http\Controllers\Admin;

use App\Dashboard\Client\ClientDashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('client')) {
            return view('dashboard.client');
        }
        if(auth()->user()->hasRole('manager')) {
            $paginator = \App\Models\Request::paginate(10);
            return view('dashboard.manager', compact('paginator'));
        }
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
        if(auth()->user()->hasRole('client')) {
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

            return back()
                ->with('success','Request has been created successfully.')
                ->with('file', $fileName);
        }

        if(auth()->user()->hasRole('manager')) {

            $data = $request->all();

            foreach($data as $key => $value){
                $keyArr = explode('-', $key);
                if($keyArr[0] === 'checked'){
                    $request = \App\Models\Request::find( (int) $keyArr[1] );
                    if($request){
                        $request->checked = (boolean) $value;
                        $request->save();
                    }
                }
            }

            return back()
                ->with('success','Operation performed successfully.');
        }
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
