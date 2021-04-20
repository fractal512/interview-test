<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasRole('manager')) {
            abort(403);
        }

        $paginator = \App\Models\Request::paginate(10);
        return view('dashboard.manager', compact('paginator'));

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
        if(!auth()->user()->hasRole('manager')) {
            return back()
                ->withErrors(['msg' => "No manager role! Store failed."]);
        }

        $data = $request->all();

        foreach($data as $key => $value){
            $keyArr = explode('-', $key);
            if($keyArr[0] === 'checked'){
                $request = \App\Models\Request::find( (int) $keyArr[1] );
                if($request){
                    if ($request->checked) continue;
                    if ((boolean) $value) $request->checked = true;
                    $request->save();
                }
            }
        }

        return back()
            ->with('success','Operation performed successfully.');
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
