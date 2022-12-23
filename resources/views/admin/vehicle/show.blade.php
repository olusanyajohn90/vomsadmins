@extends('admin.admin_layouts')


@section('admin_content')


@php

$state = DB::table('states')->get()->first();

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
                        <h2 class="content-header-title float-start mb-0">Vehicle Details</h2>
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
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-column">State</label>
                                    <br> <strong> {{ $vehicle->name }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Vehicle ID</label>
                                    <br> <strong> {{ $vehicle->vehicle_id }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">VIN</label>
                                    <br> <strong> {{ $vehicle->vin }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Owner Id</label>
                                    <br> <strong> {{ $vehicle->owner_voms_id }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Colour</label>
                                    <br> <strong> {{ $vehicle->colour }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Year</label>
                                    <br> <strong> {{ $vehicle->year }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Manufacturer</label>
                                    <br> <strong> {{ $vehicle->manufacturer }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Vehicle Qr</label>
                                    <br>
                                    {!! QrCode::size(50)->generate($vehicle->vehicle_id) !!}
                                </div>
                            </div>










                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Floating Label Form section end -->





<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Certificate History</h2>
            <div class="breadcrumb-wrapper">

            </div>
        </div>
    </div>
</div>

@foreach($certowned as $key => $con)
 <!--Certificates -->
 <section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-column">Certificate Issued State</label>
                                    <br> <strong> {{ $state->name }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate_id</label>
                                    <br> <strong> {{ $con->cert_id }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate Start Date</label>
                                    <br> <strong> {{ $con->start_date }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate Expiry Date</label>
                                    <br> <strong> {{ $con->end_date }} </strong>
                                </div>
                            </div>




                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate Qr</label>
                                    <br>
                                    {!! QrCode::size(50)->generate('https://www.voms.ng/'.$con->cert_id) !!}
                                </div>
                            </div>

























                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Certificates end -->


@endforeach









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
@endsection
