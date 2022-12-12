<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DonationController extends Controller
{




    public function index()
    {
        $states = DB::table('states')->get();
        $stato = DB::table('states')->pluck("state_name", "id");
        $localgovernment = DB::table('local_governments')->get();
        $ward = DB::table('wards')->get();
        $vorganization = DB::table('volunteer_organizations')->get();
        $usertype = DB::table('user_types')->get();
        $donation = DB::table('donations')
            ->join('states', 'donations.state_id', 'states.id')
            ->join('local_governments', 'donations.local_government_id', 'local_governments.id')
            ->join('wards', 'donations.ward_id', 'wards.id')
            ->select('donations.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
            ->get();



        // dd($localgovernment);
        return view('admin.donation.all', compact('donation', 'ward', 'localgovernment', 'states', 'stato','vorganization','usertype'));
    }



    public function donationView($id)
    {
        $state = DB::table('states')->get();
        $localgovernment = DB::table('local_governments')->get();
        $ward = DB::table('wards')->get();
        $donation = DB::table('donations')
            ->join('states', 'donations.state_id', 'states.id')
            ->join('local_governments', 'donations.local_government_id', 'local_governments.id')
            ->join('wards', 'donations.ward_id', 'wards.id')
            ->select('donations.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
            ->where('donations.id', $id)
            ->first();



        return view('admin.donation.show', compact('donation', 'ward', 'localgovernment', 'state'));
    }


    public function storedonation(Request $request)
    {


        $data = array();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['usertype_id'] = $request->usertype_id;
        $data['email'] = $request->email;
        $data['amount'] = $request->amount;
        $data['phone_number'] = $request->phone_number;
        $data['state_id'] = $request->state_id;
        $data['local_government_id'] = $request->localgovernment_id;
        $data['ward_id'] = $request->ward_id;

        DB::table('donations')->insert($data);



        $notification = array(
            'message' => 'donation added successfully',
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




    public function Deletedonation($id)
    {
        DB::table('donations')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ward deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Editdonation($id)
    {
        $donation = DB::table('donations')->where('id', $id)->first();
        $ward = DB::table('wards')->get();
        $state = DB::table('states')->get();
        $stato = DB::table('states')->pluck("state_name", "id");
        $localgovernment = DB::table('local_governments')->get();




        return view('admin.donation.edit', compact('donation','ward', 'localgovernment', 'state'));
    }
    public function Updatedonation(Request $request, $id)
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






        $update = DB::table('donations')->where('id', $id)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'localgovernment Successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('donations')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'success'
            );
            return Redirect()->route('donations')->with($notification);
        }
    }






}
