@extends('admin.admin_layouts')


@section('admin_content')


@php

$state = DB::table('states')->get()->first();
$payment_status = DB::table('payment_statuses')->get();
$userstateid = Auth::user()->state_id;
        $userstate = DB::table('states')
        ->where('id', '=', $userstateid)
        ->get()->first();

// Log::info($vowned);

@endphp



<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Certificate Details</h2>






                        <div class="breadcrumb-wrapper">

                        </div>
                    </div>
                </div>
            </div>




        </div>



        <div class="content-body">




 <!-- Basic multiple Column Form section start -->
 <section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form class="form" method="POST" action="{{ route('pay') }}" id="paymentForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-column">State</label>
                                    <br> <strong> {{ $state->name }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate ID</label>
                                    <br> <strong> {{ $certificate->cert_id }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Registered Date</label>
                                    <br> <strong> {{ $certificate->start_date }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Vehicle Id</label>
                                    <br> <strong> {{ $certificate->vehicle_id }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1 payment-status"  >
                                    <label class="form-label" for="last-name-column">Payment Status </label>
                                    <br> <strong > {{ $certificate->payment_status}} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1 payment-status"  >
                                    <label class="form-label" for="last-name-column">License Plate </label>
                                    <br> <strong > {{ $certificate->license_plate}} </strong>
                                </div>
                            </div>

                            <div class="mb-1">
                                <input type="text" value="{{ $certificate->id }}" class="form-control" name="id" hidden />
                                <input type="text" value="{{ $certificate->license_plate }}" id="licenseplate" class="form-control"  hidden />
                                <input type="text" value="{{ $certificate->payment_status}}" class="form-control" id="payment-status" hidden />
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate Qr</label>
                                    <br>
                                    {!! QrCode::size(50)->generate('Cetificate ID:   '.$certificate->cert_id. '    Payment Status:   '.$certificate->payment_status) !!}
                                </div>
                            </div>
                            {{-- @if ($certificate->payment_status == 'unpaid')
                            <button type="submit" class="btn btn-outline-primary"  id="btnpay" value="22" >
                                Pay
                            </button>
                            @endif --}}
                            {{-- @if ($certificate->payment_status == 'paid' && $certificate->license_plate == 'Not Yet Assigned')
                            <button type="button" id="btnlicence" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm" value="craze">
                                Assign Licence plate
                            </button>
                            @endif --}}

                                 @can('certificate-license')
                                 @if($userstateid == $certificate->issue_state_id)


                            @if ($certificate->license_plate == 'Not Yet Assigned')
                            <button type="button" id="btnlicence" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm" value="craze">
                                Assign Licence plate
                            </button>
                            @endif

                            @endif

                            @endcan





 <!-- Button trigger modal -->











                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Floating Label Form section end -->









    <!-- Modal -->
    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Assign License </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form method="post" action="{{ route('assign.plate') }}" class="addcert">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">




                        <input type="text" class="form-control" name="cert_id" value="{{$certificate->cert_id}}" hidden/>
                        <input type="text"  class="form-control" name="vehicle_id" value="{{ $certificate->vehicle_id }}" hidden/>

                <label>Plate Nummber  : </label>
                <div class="mb-1">
                    <input type="text" placeholder="license plate" class="form-control" name="license_plate" required/>
                </div>











                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Assign Licence</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Modal -->






        </div>
    </div>
</div>





<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>


<script type="text/javascript">



        var btnpay = document.getElementById("btnpay");
        var addlicence = document.getElementById("btnlicence");
        var pays = document.getElementById("payment-status");

        var plate = document.getElementById("licenseplate");
        console.log(pays.value);
        console.log(btnpay.value);
        console.log(plate.value);




        if (pays.value == "unpaid") {


            btnpay.hidden= false;
            addlicence.hidden= true;

        }
        elseif (plate.value == "Not Yet Assigned"){

            btnpay.hidden= true;
            addlicence.hidden= false;
        }








</script>



{{--

<script type="text/javascript">



    var addlicence = document.getElementById("btnlicence");
    var pays = document.getElementById("payment-status");
    console.log(pays.value);
    console.log(addlicence.value);

    if (pays.value == "paid") {


        addlicence.hidden= false;

    } else {

        addlicence.hidden= true;
    }
;
</script> --}}
@endsection
