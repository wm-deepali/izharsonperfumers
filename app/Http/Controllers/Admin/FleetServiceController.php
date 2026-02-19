<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\FleetService;
use Illuminate\Http\Request;

class FleetServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fleets = FleetService::first();
        return view('admin.fleetservice.index')->with([
            'fleets' => $fleets
        ]);
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
        $request->validate([
            'title' => 'required|max:255',
            'title_ar' => 'max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);
        try {
            // $data = array(
            //     'title' => $request->title,
            //     'title_ar' => $request->title_ar,
            //     'content' => $request->content,
            //     'content_ar' => $request->content_ar,
            // );
            $data = $request->all();
            if($request->hasFile('image')) {
                $data['image'] = $request->image->store('fllet-service');
            }
            FleetService::updateOrCreate(['id' => 1],$data);
            return redirect(route('admin.manage-service-fleets.index'))->with('success','Add Successfull');
        } catch (\Exception $ex) {
            return redirect(route('admin.manage-service-fleets.index'))->with('error','Error Encountered '.$ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FleetService  $fleetService
     * @return \Illuminate\Http\Response
     */
    public function show(FleetService $fleetService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FleetService  $fleetService
     * @return \Illuminate\Http\Response
     */
    public function edit(FleetService $fleetService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FleetService  $fleetService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FleetService $fleetService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FleetService  $fleetService
     * @return \Illuminate\Http\Response
     */
    public function destroy(FleetService $fleetService)
    {
        //
    }
}
