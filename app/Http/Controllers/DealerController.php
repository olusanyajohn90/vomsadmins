<?php

namespace App\Http\Controllers;

use App\Models\Admin\Dealer;
use App\Http\Requests\StoreDealerRequest;
use App\Http\Requests\UpdateDealerRequest;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


Use Spatie\QueryBuilder\QueryBuilder;
Use Spatie\QueryBuilder\AllowedFilter;

use Illuminate\Support\Carbon;




class DealerController extends Controller
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
     * @param  \App\Http\Requests\StoreDealerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDealerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function show(Dealer $dealer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function edit(Dealer $dealer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDealerRequest  $request
     * @param  \App\Models\Admin\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDealerRequest $request, Dealer $dealer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dealer $dealer)
    {
        //
    }




    public function index()
    {





        $states = DB::table('states')->get();


        // $dealer = DB::table('dealers')
        //     ->join('states', 'dealers.state_id', 'states.id')
        //     ->join('local_governments', 'dealers.local_government_id', 'local_governments.id')
        //     ->join('wards', 'dealers.ward_id', 'wards.id')
        //     ->select('dealers.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        //     ->get();

        $dealer = QueryBuilder::for(Dealer::class)
        ->allowedFilters([
            AllowedFilter::exact('last_name','voms_id'),
            'first_name'])



        ->join('states', 'dealers.origin_state_id', 'states.id')

        ->select('dealers.*',  'states.name')
        // ->get()
        ->paginate(1)
        ;



                    $totalcount = QueryBuilder::for(Dealer::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','voms_id'),
                        'first_name'])

                    ->count()
                    ;





         $avgage = QueryBuilder::for(Dealer::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','voms_id'),
                        'first_name'])
                    ->selectRaw('
                                (AVG(DATEDIFF(NOW(), date_of_birth)) / 365) as a
                               ')->cursor()
                    ;





            // $result = QueryBuilder::for(Dealer::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.dealer.all', compact('dealer',  'states', 'avgage','totalcount'));
    }






    public function Finddealer(Request $request)
    {




        // $data = array();
        // $data['first_name'] = $request->last_name;
        // $data['last_name'] = $request->last_name;
        // $data['state_id'] = $request->state_id;
        // $data['local_government_id'] = $request->localgovernment_id;
        // $data['ward_id'] = $request->ward_id;



        $states = DB::table('states')->get();





        $filter = [['voms_id', 'like', $request->voms_id . "%"], ['first_name', 'like', $request->first_name . "%"], ['last_name', 'like', $request->last_name . "%"] , ['dealers.origin_state_id', 'like', $request->origin_state_id . "%"]];
       // dd($filter);




        $dealer = QueryBuilder::for(Dealer::class)
        ->allowedFilters([
            AllowedFilter::exact('last_name'),
            'first_name', 'dealers.origin_state_id'])

        ->where($filter)
        ->join('states', 'dealers.origin_state_id', 'states.id')

        ->select('dealers.*',  'states.name')
        // ->get()
        ->paginate(5)
        ;




        // $dealer = QueryBuilder::for(Dealer::class)
        // ->allowedFilters([
        //     AllowedFilter::exact('last_name'),
        //     'first_name'])



        // ->join('states', 'dealers.state_id', 'states.id')
        // ->join('local_governments', 'dealers.local_government_id', 'local_governments.id')
        // ->join('wards', 'dealers.ward_id', 'wards.id')
        // ->select('dealers.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // // ->get()
        // ->paginate(1)
        // ;




                    $totalcount = QueryBuilder::for(Dealer::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','origin_state_id','voms_id'),
                        'first_name',])
                        ->where($filter)

                    ->count()
                    ;





         $avgage = QueryBuilder::for(Dealer::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','origin_state_id'),
                        'first_name',])
                        ->where($filter)
                    ->selectRaw('
                                (AVG(DATEDIFF(NOW(), date_of_birth)) / 365) as a
                               ')->cursor()
                    ;
                    // $avvo = Carbon::createFromTimestamp($avgage)->toTimeString();




            // $result = QueryBuilder::for(Dealer::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.dealer.all', compact('dealer',  'states','avgage','totalcount'));
    }




    public function dealerView($id)
    {
        $state = DB::table('states')->get();


        $dealer = DB::table('dealers')
            ->join('states', 'dealers.origin_state_id', 'states.id')

            ->select('dealers.*', 'states.name')
            ->where('dealers.id', $id)
            ->first();



            $vsid = $dealer->voms_id ;
            $vowned = DB::table('vehicles')
            ->join('states', 'vehicles.registration_state_id', 'states.id')

            ->select('vehicles.*', 'states.name')
            ->where('vehicles.dealer_voms_id', $vsid)
            ->get();

            // dd($vowned);
            // Log::info($vowned);





        return view('admin.dealer.show', compact('dealer', 'state', 'vowned'));
    }


    public function storedealer(Request $request)
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


        DB::table('dealers')->insert($data);



        $notification = array(
            'message' => 'dealer added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }








    public function Deletedealer($id)
    {
        DB::table('dealers')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ward deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Editdealer($id)
    {

        $state = DB::table('states')->get();
        $stato = DB::table('states')->pluck("name", "id");
        $dealer = DB::table('dealers')->where('id', $id)->first();




        return view('admin.dealer.edit', compact('dealer', 'state'));
    }
    public function Updatedealer(Request $request, $id)
    {
        $data = array();


        $data['first_name'] = $request->last_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['address1'] = $request->address1;
        $data['address2'] = $request->address2;
        $data['phone_number'] = $request->phone_number;





        $update = DB::table('dealers')->where('id', $id)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'Dealer Records Successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('dealers')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'success'
            );
            return Redirect()->route('dealers')->with($notification);
        }
    }







}
