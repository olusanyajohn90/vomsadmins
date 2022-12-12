<?php

namespace App\Http\Controllers;

use App\Models\Admin\Owner;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


Use Spatie\QueryBuilder\QueryBuilder;
Use Spatie\QueryBuilder\AllowedFilter;

use Illuminate\Support\Carbon;

class OwnerController extends Controller
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
     * @param  \App\Http\Requests\StoreOwnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOwnerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOwnerRequest  $request
     * @param  \App\Models\Admin\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }


    public function index()
    {





        $states = DB::table('states')->get();


        // $owner = DB::table('owners')
        //     ->join('states', 'owners.state_id', 'states.id')
        //     ->join('local_governments', 'owners.local_government_id', 'local_governments.id')
        //     ->join('wards', 'owners.ward_id', 'wards.id')
        //     ->select('owners.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        //     ->get();

        $owner = QueryBuilder::for(Owner::class)
        ->allowedFilters([
            AllowedFilter::exact('last_name','voms_id'),
            'first_name'])



        ->join('states', 'owners.origin_state_id', 'states.id')

        ->select('owners.*',  'states.name')
        // ->get()
        ->paginate(1)
        ;



                    $totalcount = QueryBuilder::for(Owner::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','voms_id'),
                        'first_name'])

                    ->count()
                    ;





         $avgage = QueryBuilder::for(Owner::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','voms_id'),
                        'first_name'])
                    ->selectRaw('
                                (AVG(DATEDIFF(NOW(), date_of_birth)) / 365) as a
                               ')->cursor()
                    ;





            // $result = QueryBuilder::for(Owner::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.owner.all', compact('owner',  'states', 'avgage','totalcount'));
    }






    public function Findowner(Request $request)
    {




        // $data = array();
        // $data['first_name'] = $request->last_name;
        // $data['last_name'] = $request->last_name;
        // $data['state_id'] = $request->state_id;
        // $data['local_government_id'] = $request->localgovernment_id;
        // $data['ward_id'] = $request->ward_id;



        $states = DB::table('states')->get();





        $filter = [['voms_id', 'like', $request->voms_id . "%"], ['first_name', 'like', $request->first_name . "%"], ['last_name', 'like', $request->last_name . "%"] , ['owners.origin_state_id', 'like', $request->origin_state_id . "%"]];
       // dd($filter);




        $owner = QueryBuilder::for(Owner::class)
        ->allowedFilters([
            AllowedFilter::exact('last_name'),
            'first_name', 'owners.origin_state_id'])

        ->where($filter)
        ->join('states', 'owners.origin_state_id', 'states.id')

        ->select('owners.*',  'states.name')
        // ->get()
        ->paginate(5)
        ;




        // $owner = QueryBuilder::for(Owner::class)
        // ->allowedFilters([
        //     AllowedFilter::exact('last_name'),
        //     'first_name'])



        // ->join('states', 'owners.state_id', 'states.id')
        // ->join('local_governments', 'owners.local_government_id', 'local_governments.id')
        // ->join('wards', 'owners.ward_id', 'wards.id')
        // ->select('owners.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // // ->get()
        // ->paginate(1)
        // ;




                    $totalcount = QueryBuilder::for(Owner::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','origin_state_id','voms_id'),
                        'first_name',])
                        ->where($filter)

                    ->count()
                    ;





         $avgage = QueryBuilder::for(Owner::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','origin_state_id'),
                        'first_name',])
                        ->where($filter)
                    ->selectRaw('
                                (AVG(DATEDIFF(NOW(), date_of_birth)) / 365) as a
                               ')->cursor()
                    ;
                    // $avvo = Carbon::createFromTimestamp($avgage)->toTimeString();




            // $result = QueryBuilder::for(Owner::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.owner.all', compact('owner',  'states','avgage','totalcount'));
    }




    public function ownerView($id)
    {
        $state = DB::table('states')->get();


        $owner = DB::table('owners')
            ->join('states', 'owners.origin_state_id', 'states.id')

            ->select('owners.*', 'states.name')
            ->where('owners.id', $id)
            ->first();



            $vsid = $owner->voms_id ;
            $vowned = DB::table('vehicles')
            ->join('states', 'vehicles.registration_state_id', 'states.id')

            ->select('vehicles.*', 'states.name')
            ->where('vehicles.owner_voms_id', $vsid)
            ->get();

            // dd($vowned);
            // Log::info($vowned);





        return view('admin.owner.show', compact('owner', 'state', 'vowned'));
    }


    public function storeowner(Request $request)
    {


        $rando = random_int(100000, 999999);
        $vomsid = "VOMS" . $rando;
        $data = array();
        $data['nin'] = $request->nin;
        $data['voms_id'] = $vomsid;
        $data['first_name'] = $request->last_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['address1'] = $request->address1;
        $data['address2'] = $request->address2;
        $data['phone_number'] = $request->phone_number;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['origin_state_id'] = $request->origin_state_id;


        DB::table('owners')->insert($data);



        $notification = array(
            'message' => 'owner added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }








    public function Deleteowner($id)
    {
        DB::table('owners')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ward deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Editowner($id)
    {

        $state = DB::table('states')->get();
        $stato = DB::table('states')->pluck("name", "id");
        $owner = DB::table('owners')->where('id', $id)->first();




        return view('admin.owner.edit', compact('owner', 'state'));
    }
    public function Updateowner(Request $request, $id)
    {
        $data = array();


        $data['first_name'] = $request->last_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['address1'] = $request->address1;
        $data['address2'] = $request->address2;
        $data['phone_number'] = $request->phone_number;





        $update = DB::table('owners')->where('id', $id)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'Owner Records Successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('owners')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'success'
            );
            return view('admin.owner.all');
        }
    }


}
