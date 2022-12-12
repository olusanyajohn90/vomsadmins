<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Use Spatie\QueryBuilder\QueryBuilder;
Use Spatie\QueryBuilder\AllowedFilter;
Use App\Models\Voter;
use Illuminate\Support\Carbon;


class VoterController extends Controller
{







    public function index()
    {





        $states = DB::table('states')->get();
        $stato = DB::table('states')->pluck("state_name", "id");
        $localgovernment = DB::table('local_governments')->get();
        $loco = DB::table('local_governments')->pluck("localgovernment_name", "id");
        $ward = DB::table('wards')->get();
        $vorganization = DB::table('volunteer_organizations')->get();
        // $voter = DB::table('voters')
        //     ->join('states', 'voters.state_id', 'states.id')
        //     ->join('local_governments', 'voters.local_government_id', 'local_governments.id')
        //     ->join('wards', 'voters.ward_id', 'wards.id')
        //     ->select('voters.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        //     ->get();

        $voter = QueryBuilder::for(Voter::class)
        ->allowedFilters([
            AllowedFilter::exact('last_name'),
            'first_name'])



        ->join('states', 'voters.state_id', 'states.id')
        ->join('local_governments', 'voters.local_government_id', 'local_governments.id')
        ->join('wards', 'voters.ward_id', 'wards.id')
        ->select('voters.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // ->get()
        ->paginate(1)
        ;


        $localcount = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name'),
                        'first_name'])
                    ->distinct()
                    ->count('local_government_id');

                    $malecount = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name'),
                        'first_name'])
                    ->where('sex_id','1')
                    ->count()
                    ;
                    $femcount = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name'),
                        'first_name'])
                    ->where('sex_id','2')
                    ->count()
                    ;




         $avgage = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name'),
                        'first_name'])
                    ->selectRaw('
                                (AVG(DATEDIFF(NOW(), date_of_birth)) / 365) as a
                               ')->cursor()
                    ;
                    // $avvo = Carbon::createFromTimestamp($avgage)->toTimeString();




            // $result = QueryBuilder::for(Voter::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.voter.all', compact('voter', 'ward', 'localgovernment','loco', 'states', 'stato','vorganization','localcount', 'avgage','malecount','femcount'));
    }






    public function Findvoter(Request $request)
    {




        // $data = array();
        // $data['first_name'] = $request->last_name;
        // $data['last_name'] = $request->last_name;
        // $data['state_id'] = $request->state_id;
        // $data['local_government_id'] = $request->localgovernment_id;
        // $data['ward_id'] = $request->ward_id;



        $states = DB::table('states')->get();
        $stato = DB::table('states')->pluck("state_name", "id");
        $localgovernment = DB::table('local_governments')->get();
        $loco = DB::table('local_governments')->pluck("localgovernment_name", "id");
        $ward = DB::table('wards')->get();
        $vorganization = DB::table('volunteer_organizations')->get();
        // $voter = DB::table('voters')
        //     ->join('states', 'voters.state_id', 'states.id')
        //     ->join('local_governments', 'voters.local_government_id', 'local_governments.id')
        //     ->join('wards', 'voters.ward_id', 'wards.id')
        //     ->select('voters.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        //     ->get();




        $filter = [['first_name', 'like', $request->first_name . "%"], ['last_name', 'like', $request->last_name . "%"] , ['voters.state_id', 'like', $request->state_id . "%"]];
       // dd($filter);




        $voter = QueryBuilder::for(Voter::class)
        ->allowedFilters([
            AllowedFilter::exact('last_name'),
            'first_name', 'voters.state_id'])

        ->where($filter)
        ->join('states', 'voters.state_id', 'states.id')
        ->join('local_governments', 'voters.local_government_id', 'local_governments.id')
        ->join('wards', 'voters.ward_id', 'wards.id')
        ->select('voters.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // ->get()
        ->paginate(1)
        ;




        // $voter = QueryBuilder::for(Voter::class)
        // ->allowedFilters([
        //     AllowedFilter::exact('last_name'),
        //     'first_name'])



        // ->join('states', 'voters.state_id', 'states.id')
        // ->join('local_governments', 'voters.local_government_id', 'local_governments.id')
        // ->join('wards', 'voters.ward_id', 'wards.id')
        // ->select('voters.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // // ->get()
        // ->paginate(1)
        // ;


        $localcount = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','state_id'),
            'first_name',])
                        ->where($filter)
                    ->distinct()
                    ->count('local_government_id');

                    $malecount = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','state_id'),
                        'first_name',])
                        ->where($filter)
                    ->where('sex_id','1')
                    ->count()
                    ;
                    $femcount = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','state_id'),
                        'first_name',])
                        ->where($filter)
                    ->where('sex_id','2')
                    ->count()
                    ;




         $avgage = QueryBuilder::for(Voter::class)
                    ->allowedFilters([
                        AllowedFilter::exact('last_name','state_id'),
                        'first_name',])
                        ->where($filter)
                    ->selectRaw('
                                (AVG(DATEDIFF(NOW(), date_of_birth)) / 365) as a
                               ')->cursor()
                    ;
                    // $avvo = Carbon::createFromTimestamp($avgage)->toTimeString();




            // $result = QueryBuilder::for(Voter::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.voter.all', compact('voter', 'ward', 'localgovernment','loco', 'states', 'stato','vorganization','localcount', 'avgage','malecount','femcount'));
    }




    public function voterView($id)
    {
        $state = DB::table('states')->get();
        $localgovernment = DB::table('local_governments')->get();
        $ward = DB::table('wards')->get();
        $voter = DB::table('voters')
            ->join('states', 'voters.state_id', 'states.id')
            ->join('local_governments', 'voters.local_government_id', 'local_governments.id')
            ->join('wards', 'voters.ward_id', 'wards.id')
            ->select('voters.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
            ->where('voters.id', $id)
            ->first();



        return view('admin.voter.show', compact('voter', 'ward', 'localgovernment', 'state'));
    }


    public function storevoter(Request $request)
    {


        $data = array();
        $data['first_name'] = $request->last_name;
        $data['last_name'] = $request->last_name;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['address'] = $request->address;
        $data['phone_number'] = $request->phone_number;
        $data['highestacademic_qualification_id'] = $request->highestacademic_qualification_id;
        $data['level_id'] = $request->level_id;
        $data['skill_id'] = $request->skill_id;
        $data['phone_number'] = $request->phone_number;
        $data['state_id'] = $request->state_id;
        $data['local_government_id'] = $request->localgovernment_id;
        $data['ward_id'] = $request->ward_id;
        $data['polling_id'] = $request->polling_id;
        $data['vorganization_id'] = $request->vorganization_id;

        DB::table('voters')->insert($data);



        $notification = array(
            'message' => 'voter added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }



    public function getLocal(Request $request)
    {
        $localgovernment = DB::table("local_governments")
            ->where("state_id", $request->state_id)
            ->pluck("localgovernment_name", "id", "state_id");
        return \response()->json($localgovernment);
    }



    public function getWard(Request $request)
    {
        $ward = DB::table("wards")
            ->where("local_government_id", $request->localgovernment_id)
            ->pluck("ward_name", "id", "localgovernment_id")->toArray();


        // Log::info([$ward]);
        // Log::useDailyFiles(storage_path() . '/logs/mad.log');
        return \response()->json($ward);
    }



    public function getPolling(Request $request)
    {
        $ward = DB::table("pollings")
            ->where("ward_id", $request->ward_id)
            ->pluck("name", "id", "ward_id")->toArray();


        // Log::info([$ward]);
        // Log::useDailyFiles(storage_path() . '/logs/mad.log');
        return \response()->json($ward);
    }




    public function Deletevoter($id)
    {
        DB::table('voters')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ward deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Editvoter($id)
    {
        $voter = DB::table('voters')->where('id', $id)->first();
        $ward = DB::table('wards')->get();
        $state = DB::table('states')->get();
        $stato = DB::table('states')->pluck("state_name", "id");
        $localgovernment = DB::table('local_governments')->get();




        return view('admin.voter.edit', compact('voter','ward', 'localgovernment', 'state'));
    }
    public function Updatevoter(Request $request, $id)
    {
        $data = array();
        $data['first_name'] = $request->last_name;
        $data['last_name'] = $request->last_name;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['address'] = $request->address;
        $data['phone_number'] = $request->phone_number;
        $data['highestacademic_qualification_id'] = $request->highestacademic_qualification_id;
        $data['level_id'] = $request->level_id;
        $data['skill_id'] = $request->skill_id;
        $data['phone_number'] = $request->phone_number;
        $data['state_id'] = $request->state_id;
        $data['local_government_id'] = $request->localgovernment_id;
        $data['ward_id'] = $request->ward_id;
        $data['polling_id'] = $request->polling_id;
        $data['vorganization_id'] = $request->vorganization_id;






        $update = DB::table('voters')->where('id', $id)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'localgovernment Successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('voters')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'success'
            );
            return Redirect()->route('voters')->with($notification);
        }
    }




}
