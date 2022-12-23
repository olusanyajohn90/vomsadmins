@extends('admin.admin_layouts')


@section('admin_content')


@php

$state = DB::table('states')->get()->first();

Log::info($vowned);

@endphp



<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Owner Details</h2>
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
                                    <br> <strong> {{ $state->name }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">VOMS ID</label>
                                    <br> <strong> {{ $owner->voms_id }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">NIN</label>
                                    <br> <strong> {{ $owner->nin }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">First Name</label>
                                    <br> <strong> {{ $owner->first_name }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Last Name</label>
                                    <br> <strong> {{ $owner->last_name }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Email</label>
                                    <br> <strong> {{ $owner->email }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Date Of Birth</label>
                                    <br> <strong> {{ $owner->date_of_birth }} </strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Address 1</label>
                                    <br> <strong> {{ $owner->address1 }} </strong>
                                </div>
                            </div>



                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Address 2</label>
                                    <br> <strong> {{ $owner->address2 }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Phone Number</label>
                                    <br> <strong> {{ $owner->phone_number }} </strong>
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
            <h2 class="content-header-title float-start mb-0">Vehicles Owned</h2>
            <div class="breadcrumb-wrapper">

            </div>
        </div>
    </div>
</div>

@foreach($vowned as $key => $von)
 <!--Vehicles -->
 <section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-column">State Registered</label>
                                    <br> <strong> {{ $state->name }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">VIN</label>
                                    <br> <strong> {{ $von->vin }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Certificate ID</label>
                                    <br> <strong> {{ $von->certificate_id }} </strong>
                                </div>
                            </div>




                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Colour</label>
                                    <br> <strong> {{ $von->colour }} </strong>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Manufacturer</label>
                                    <br> <strong> {{ $von->manufacturer }} </strong>
                                </div>
                            </div>















                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Vehicles end -->


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
