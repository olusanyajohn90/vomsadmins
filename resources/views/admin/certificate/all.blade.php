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
                        <h2 class="content-header-title float-start mb-0">Certificates</h2>
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
                            Register Certificate
                        </button>

                           <!-- Modal -->
                           <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Certificate </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>


                                    <form class="form" method="POST" action="{{ route('pay') }}" id="paymentForm" class="addcert" id="paymentForm">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="modal-body">






                                    <label>Vehicle Id : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="vehicle_id" class="form-control" name="vehicle_id" required/>
                                    </div>








                                                   <!-- Basic Select -->
                                                   <div class="form-group">
                                                    <label> State Of Issuance: </label>
                                                    <select class="form-control"  id="state" name="registration_state_id" required>



                                                        <option value="">Select State</option>
                                                        @foreach ($states as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary"  id="btnpay" value="22" >
                                                Pay
                                            </button>
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

                <form method="get" action="{{ route('find.certificate') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">
                    <div class="demo-inline-spacing">

                        <div class=" ">
                            <input type="text" placeholder="Certificate Id" class="form-control" name="cert_id" />
                        </div>
                        <div class=" ">
                            <input type="text" placeholder="Vehicle Id" class="form-control" name="vehicle_id" />
                        </div>









                        <div class="btn-group">


                            <select class="form-control btn-primary select2 form-select select2-size-lg "  id="statefind" name="issue_state_id" aria-placeholder="Select State">



                                <option value="">Select State</option>
                                @foreach ($states as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach

                            </select>



                        </div>








                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Find Certificates</button>
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
            <h4 class="card-title">Certificate Analytics</h4>
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
                            <p class="card-text font-small-3 mb-0">Certificates</p>
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
                <h4 class="card-title">Certificates</h4>
            </div>
            <div class="card-body">

            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>


                            <th>Certificate ID </th>
                            <th>Vedicle ID </th>
                            <th>Start Date </th>
                            <th>End Date </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificate as $key=>$row)
                        <tr>


                            <td>{{ $row->cert_id }}</td>
                            <td>{{ $row->vehicle_id }}</td>
                            <td>{{ $row->start_date }}</td>
                            <td>{{ $row->end_date }}</td>




                            <td>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('view/certificate/'.$row->id) }}">  <i data-feather="circle" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>




                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="pagination pagination-lg justify-content-center mt-2" >{!! $certificate->onEachSide(1)->links() !!}</div>

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
