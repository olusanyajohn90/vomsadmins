<?php

namespace App\Http\Controllers;

use App\Models\Admin\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;





use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


Use Spatie\QueryBuilder\QueryBuilder;
Use Spatie\QueryBuilder\AllowedFilter;

use Illuminate\Support\Carbon;



class VehicleController extends Controller
{


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
     * @param  \App\Http\Requests\StoreVehicleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleRequest  $request
     * @param  \App\Models\Admin\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }





    public function index()
    {





        $states = DB::table('states')->get();


 

        $vehicle = QueryBuilder::for(Vehicle::class)
        ->allowedFilters([
            AllowedFilter::exact('vin','certificate_id'),
            'manufacturer'])



        ->join('states', 'vehicles.registration_state_id', 'states.id')

        ->select('vehicles.*',  'states.name')
        // ->get()
        ->paginate(1)
        ;



                    $totalcount = QueryBuilder::for(Vehicle::class)
                    ->allowedFilters([
                        AllowedFilter::exact('vin','certificate_id'),
                        'manufacturer'])

                    ->count()
                    ;









            // $result = QueryBuilder::for(Vehicle::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.vehicle.all', compact('vehicle',  'states','totalcount'));
    }






    public function Findvehicle(Request $request)
    {




        // $data = array();
        // $data['first_name'] = $request->last_name;
        // $data['last_name'] = $request->last_name;
        // $data['state_id'] = $request->state_id;
        // $data['local_government_id'] = $request->localgovernment_id;
        // $data['ward_id'] = $request->ward_id;



        $states = DB::table('states')->get();





        $filter = [['vin', 'like', $request->vin . "%"], ['vehicle_id', 'like', $request->vehicle_id . "%"], ['manufacturer', 'like', $request->manufacturer . "%"] , ['vehicles.registration_state_id', 'like', $request->registration_state_id . "%"]];
       // dd($filter);




        $vehicle = QueryBuilder::for(Vehicle::class)
        ->allowedFilters([
            AllowedFilter::exact('vin','vehicle_id'),
            'manufacturer', 'vehicles.registration_state_id'])

        ->where($filter)
        ->join('states', 'vehicles.registration_state_id', 'states.id')

        ->select('vehicles.*',  'states.name')
        // ->get()
        ->paginate(5)
        ;




        // $vehicle = QueryBuilder::for(Vehicle::class)
        // ->allowedFilters([
        //     AllowedFilter::exact('last_name'),
        //     'first_name'])



        // ->join('states', 'vehicles.state_id', 'states.id')
        // ->join('local_governments', 'vehicles.local_government_id', 'local_governments.id')
        // ->join('wards', 'vehicles.ward_id', 'wards.id')
        // ->select('vehicles.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // // ->get()
        // ->paginate(1)
        // ;




                    $totalcount = QueryBuilder::for(Vehicle::class)
                    ->allowedFilters([
                        AllowedFilter::exact('vin','vehicle_id'),
                        'manufacturer', 'vehicles.registration_state_id'])
                        ->where($filter)

                    ->count()
                    ;





                    // $avvo = Carbon::createFromTimestamp($avgage)->toTimeString();




            // $result = QueryBuilder::for(Vehicle::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.vehicle.all', compact('vehicle',  'states','totalcount'));
    }




    public function vehicleView($id)
    {
        $state = DB::table('states')->get();


        $vehicle = DB::table('vehicles')
            ->join('states', 'vehicles.registration_state_id', 'states.id')

            ->select('vehicles.*', 'states.name')
            ->where('vehicles.id', $id)
            ->first();



            $certid = $vehicle->vehicle_id ;
            $certowned = DB::table('certificates')
            ->join('states', 'certificates.issue_state_id', 'states.id')

            ->select('certificates.*', 'states.name')
            ->where('certificates.vehicle_id', $certid)
            ->get();

            //  dd($certowned);
            //  Log::info($certowned);





        return view('admin.vehicle.show', compact('vehicle', 'state','certowned'));
    }


    public function storevehicle(Request $request)
    {


        $rando = random_int(1000, 9999);
        $vehicleid = "V" . $rando . $request->vin;
        $data = array();
        $data['vin'] = $request->vin;
        $data['vehicle_id'] = $vehicleid;
        $data['owner_voms_id'] = $request->owner_voms_id;
        $data['dealer_voms_id'] = $request->dealer_voms_id;
        $data['colour'] = $request->colour;
        $data['manufacturer'] = $request->manufacturer;
        $data['year'] = $request->year;
        $data['registration_state_id'] = $request->registration_state_id;


        DB::table('vehicles')->insert($data);

// dd($data);

        $notification = array(
            'message' => 'vehicle added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }








    public function Deletevehicle($id)
    {
        DB::table('vehicles')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ward deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Editvehicle($id)
    {

        $state = DB::table('states')->get();
        $stato = DB::table('states')->pluck("name", "id");
        $vehicle = DB::table('vehicles')->where('id', $id)->first();




        return view('admin.vehicle.edit', compact('vehicle', 'state'));
    }
    public function Updatevehicle(Request $request, $id)
    {
        $data = array();


        $data['owner_voms_id'] = $request->owner_voms_id;

        $data['colour'] = $request->colour;





        $update = DB::table('vehicles')->where('id', $id)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'Vehicle Records Successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('vehicles')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'success'
            );
            return Redirect()->route('vehicles')->with($notification);
        }
    }












}
