@extends('admin.admin_layouts')


@section('admin_content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Vehicles</h2>
                        <div class="breadcrumb-wrapper">

                        </div>
                    </div>
                </div>
            </div>


            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                         <!-- Button trigger modal -->
                         <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                            Add New Vehicle
                        </button>

                           <!-- Modal -->
                           <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Vehicle </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>


                                    <form method="post" action="{{ route('store.vehicle') }}">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="modal-body">






                                    <label>VIN : </label>
                                    <div class="mb-1">
                                        <input type="number" placeholder="vin" class="form-control" name="vin" required/>
                                    </div>


                                    <label>Owner VOMS ID : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="VOMS....." class="form-control" name="owner_voms_id" required/>
                                    </div>


                                    <label>Dealer VOMS ID : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="VOMSD......." class="form-control" name="dealer_voms_id" />
                                    </div>

                                    <label>Colour : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="xxx@gmail.com" class="form-control" name="colour" required/>
                                    </div>


                                    <label>Manufacturer : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="e.g toyota" class="form-control" name="manufacturer"  required/>
                                    </div>


                                    <label>Year : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="3024" class="form-control" name="year"  required/>
                                    </div>





                                                   <!-- Basic Select -->
                                                   <div class="form-group">
                                                    <label> State Of Registration: </label>
                                                    <select class="form-control"  id="state" name="registration_state_id" required>



                                                        <option value="">Select State</option>
                                                        @foreach ($states as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" >Add Vehicle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- End Modal -->


                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">




  <!-- Basic Dropdowns Start -->
  <section id="basic-dropdown">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter</h4>
                </div>

                <form method="get" action="{{ route('find.vehicle') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">
                    <div class="demo-inline-spacing">

                        <div class=" ">
                            <input type="text" placeholder="VIN" class="form-control" name="vin" />
                        </div>
                        <div class=" ">
                            <input type="text" placeholder="Certificate Id" class="form-control" name="certificate_id" />
                        </div>




                            <div class=" ">
                                <input type="text" placeholder="Manufacturer" class="form-control" name="manufacturer" />
                            </div>




                        <div class="btn-group">


                            <select class="form-control btn-primary select2 form-select select2-size-lg "  id="statefind" name="origin_state_id" aria-placeholder="Select State">



                                <option value="">Select State</option>
                                @foreach ($states as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach

                            </select>



                        </div>








                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Find Vehicles</button>
                        </div>
                    </div>
                </div>

            </form>



            </div>
        </div>
    </div>
</section>
<!-- Basic Dropdown End -->







 <!--/ Line Chart -->
 <div class="col-lg-12 col-12">
    <div class="card card-statistics">
        <div class="card-header">
            <h4 class="card-title">Vehicle Analytics</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="card-body statistics-body">
            <div class="row">



                <div class="col-md-3 col-sm-6 col-12">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-success me-2">
                            <div class="avatar-content">
                                <i data-feather="user" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{$totalcount}}</h4>
                            <p class="card-text font-small-3 mb-0">Vehicles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




  <!-- Hoverable rows start -->
  <div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Vehicles</h4>
            </div>
            <div class="card-body">

            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>


                            <th>VIN </th>
                            <th>Current Certificate </th>
                            <th>Manufacturer </th>
                            <th>State </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicle as $key=>$row)
                        <tr>


                            <td>{{ $row->vin }}</td>
                            <td>{{ $row->certificate_id }}</td>
                            <td>{{ $row->manufacturer }}</td>
                            <td>{{ $row->name }}</td>




                            <td>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('view/vehicle/'.$row->id) }}">  <i data-feather="view" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('edit/vehicle/'.$row->id) }}">  <i data-feather="edit" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>


                                    <div class="avatar bg-danger">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('delete/vehicle/'.$row->id) }}"> <i data-feather="delete" class="avatar-icon"></i></a>
                                        </div>
                                    </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="pagination pagination-lg justify-content-center mt-2" >{!! $vehicle->onEachSide(1)->links() !!}</div>

        </div>

    </div>

</div>
<!-- Hoverable rows end -->









        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>












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
