<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Vehicle;
use Illuminate\Support\Carbon;
use App\Models\Admin\Certificate;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


Use Spatie\QueryBuilder\QueryBuilder;
Use Spatie\QueryBuilder\AllowedFilter;

use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;

class CertificateController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:certificate-list|certificate-create|certificate-edit|certificate-delete', ['only' => ['index','certificateview', 'Findcertificate']]);
         $this->middleware('permission:certificate-create', ['only' => ['storecertificate']]);
         $this->middleware('permission:certificate-edit', ['only' => ['Editcertificate','Updatecertificate']]);
         $this->middleware('permission:certificate-delete', ['only' => ['Deletecertificate']]);
         $this->middleware('permission:certificate-license', ['only' => ['assignlicense']]);
    }








    public function index()
    {





        $states = DB::table('states')->get();
        


        // $certificate = DB::table('certificates')
        //     ->join('states', 'certificates.state_id', 'states.id')
        //     ->join('local_governments', 'certificates.local_government_id', 'local_governments.id')
        //     ->join('wards', 'certificates.ward_id', 'wards.id')
        //     ->select('certificates.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        //     ->get();

        $certificate = QueryBuilder::for(Certificate::class)
        ->allowedFilters([
            AllowedFilter::exact('vehicle_id','cert_id')
            ])



        ->join('states', 'certificates.issue_state_id', 'states.id')

        ->select('certificates.*',  'states.name')
        // ->get()
        ->paginate(5)
        ;



                    $totalcount = QueryBuilder::for(Certificate::class)
                    ->allowedFilters([
                        AllowedFilter::exact('vehicle_id','cert_id')
                        ])

                    ->count()
                    ;









            // $result = QueryBuilder::for(Certificate::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.certificate.all', compact('certificate',  'states','totalcount'));
    }






    public function Findcertificate(Request $request)
    {




        // $data = array();
        // $data['first_name'] = $request->last_name;
        // $data['last_name'] = $request->last_name;
        // $data['state_id'] = $request->state_id;
        // $data['local_government_id'] = $request->localgovernment_id;
        // $data['ward_id'] = $request->ward_id;



        $states = DB::table('states')->get();





        $filter = [['cert_id', 'like', $request->cert_id . "%"], ['vehicle_id', 'like', $request->vehicle_id . "%"],  ['certificates.issue_state_id', 'like', $request->issue_state_id . "%"]];
       // dd($filter);




        $certificate = QueryBuilder::for(Certificate::class)
        ->allowedFilters([
            AllowedFilter::exact('vehicle_id','cert_id')
            ])

        ->where($filter)
        ->join('states', 'certificates.issue_state_id', 'states.id')

        ->select('certificates.*',  'states.name')
        // ->get()
        ->paginate(5)
        ;




        // $certificate = QueryBuilder::for(Certificate::class)
        // ->allowedFilters([
        //     AllowedFilter::exact('last_name'),
        //     'first_name'])



        // ->join('states', 'certificates.state_id', 'states.id')
        // ->join('local_governments', 'certificates.local_government_id', 'local_governments.id')
        // ->join('wards', 'certificates.ward_id', 'wards.id')
        // ->select('certificates.*', 'wards.ward_name', 'local_governments.localgovernment_name', 'states.state_name')
        // // ->get()
        // ->paginate(1)
        // ;




                    $totalcount = QueryBuilder::for(Certificate::class)
                    ->allowedFilters([
                        AllowedFilter::exact('vehicle_id','cert_id')
                        ])
                        ->where($filter)

                    ->count()
                    ;





                    // $avvo = Carbon::createFromTimestamp($avgage)->toTimeString();




            // $result = QueryBuilder::for(Certificate::class)
            // ->allowedFilters([
            //     AllowedFilter::exact('last_name'),
            //     'first_name'])
            // ->get();
            // return $result;



        // dd($localgovernment);
        return view('admin.certificate.all', compact('certificate',  'states','totalcount'));
    }




    public function certificateView($id)
    {
        $state = DB::table('states')->get();


        $certificate = DB::table('certificates')
        ->join('states', 'certificates.issue_state_id', 'states.id')
        ->join('payment_statuses', 'certificates.payment_status_id', 'payment_statuses.id')

            ->select('certificates.*', 'states.name as state', 'payment_statuses.name as payment_status')
            ->where('certificates.id', $id)
            ->first();

// dd($certificate);

            $certid = $certificate->cert_id ;
            $certowned = DB::table('certificates')
            ->join('states', 'certificates.issue_state_id', 'states.id')
            ->join('payment_statuses', 'certificates.payment_status_id', 'payment_statuses.id')
            ->select('certificates.*', 'states.name' , 'payment_statuses.name')
            ->where('certificates.cert_id', $certid)
            ->get();

            //  dd($certowned);
            //  Log::info($certowned);





        return view('admin.certificate.show', compact('certificate', 'state','certowned'));
    }


    public function storecertificate(Request $request)
    {
        $vehicle = Vehicle::wherevehicle_id($request->vehicle_id)->first();
        if(!$vehicle)
        {
            return redirect()->back()->with('error', 'Vin is on our database');
        }

        $rando = random_int(1000, 9999);
        $certificateid = "V" . $rando . $request->vin;
        $data = array();
        $data['vehicle_id'] = $request->vehicle_id;
        $data['cert_id'] = $certificateid;
        $data['certificate_owner_id'] = $vehicle->owner_voms_id;
        $data['issue_state_id'] = $vehicle->registration_state_id;


        DB::table('certificates')->insert($data);

// dd($data);

        $notification = array(
            'message' => 'certificate added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }





    public function assignlicense(Request $request)
    {




        $certid = $request->cert_id;
        $vehicleid = $request->vehicle_id;


        $data['license_plate'] = $request->license_plate;


        // dd($data);

        DB::table('certificates')->where('cert_id', $certid)->update($data);
        DB::table('vehicles')->where('vehicle_id', $vehicleid)->update($data);


// dd($data);

        $notification = array(
            'message' => 'certificate added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }




    public function Deletecertificate($id)
    {
        DB::table('certificates')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ward deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Editcertificate($id)
    {

        $state = DB::table('states')->get();
        $stato = DB::table('states')->pluck("name", "id");
        $certificate = DB::table('certificates')->where('id', $id)->first();




        return view('admin.certificate.edit', compact('certificate', 'state'));
    }
    public function Updatecertificate(Request $request, $id)
    {
        $data = array();


        $data['owner_voms_id'] = $request->owner_voms_id;

        $data['colour'] = $request->colour;





        $update = DB::table('certificates')->where('id', $id)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'Certificate Records Successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('certificates')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'success'
            );
            return Redirect()->route('certificates')->with($notification);
        }
    }




















}
