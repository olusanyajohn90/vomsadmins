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
                        <h2 class="content-header-title float-start mb-0">Dealers</h2>
                        <div class="breadcrumb-wrapper">

                        </div>
                    </div>
                </div>
            </div>


            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                         <!-- Button trigger modal -->
                         {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                            Add New Dealer
                        </button> --}}

                           <!-- Modal -->
                           <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Dealer </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>


                                    <form method="post" action="{{ route('store.dealer') }}">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="modal-body">






                                    <label>NIN : </label>
                                    <div class="mb-1">
                                        <input type="number" placeholder="NIN" class="form-control" name="nin" required/>
                                    </div>


                                    <label>First Name : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="" class="form-control" name="first_name" required/>
                                    </div>


                                    <label>Last Name : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="" class="form-control" name="last_name" required/>
                                    </div>

                                    <label>Email : </label>
                                    <div class="mb-1">
                                        <input type="email" placeholder="xxx@gmail.com" class="form-control" name="email" required/>
                                    </div>


                                    <label>Address 1 : </label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="" class="form-control" name="address1"  required/>
                                    </div>




                                    <label>Address 2:  (Optional)</label>
                                    <div class="mb-1">
                                        <input type="text" placeholder="" class="form-control" name="address2" />
                                    </div>

                                    <label>Phone Number : </label>
                                    <div class="mb-1">
                                        <input type="number" placeholder="" class="form-control" name="phone_number" />
                                    </div>

                                    <label for="fp-default">Date Of Birth </label>
                                    <div class="mb-1">

                                        <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="date_of_birth" />
                                    </div>

                                                   <!-- Basic Select -->
                                                   <div class="form-group">
                                                    <label> State: </label>
                                                    <select class="form-control"  id="state" name="origin_state_id" required>



                                                        <option value="">Select State</option>
                                                        @foreach ($states as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" >Add Dealer</button>
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

                <form method="get" action="{{ route('find.dealer') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">
                    <div class="demo-inline-spacing">

                        <div class=" ">
                            <input type="text" placeholder="Voms Id" class="form-control" name="voms_id" />
                        </div>
                        <div class=" ">
                            <input type="text" placeholder="First Name" class="form-control" name="first_name" />
                        </div>




                            <div class=" ">
                                <input type="text" placeholder="Last Name" class="form-control" name="last_name" />
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
                            <button type="submit" class="btn btn-primary" >Find Dealers</button>
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
            <h4 class="card-title">Dealer Analytics</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="card-body statistics-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-primary me-2">
                            <div class="avatar-content">
                                <i data-feather="trending-up" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">

                            @foreach ($avgage as $row)
                            <h4 class="fw-bolder mb-0">{{ $row->a }}</h4>
                            @endforeach
                            <p class="card-text font-small-3 mb-0">Avg Age</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 col-12">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-success me-2">
                            <div class="avatar-content">
                                <i data-feather="user" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{$totalcount}}</h4>
                            <p class="card-text font-small-3 mb-0">Dealers</p>
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
                <h4 class="card-title">Dealers</h4>
            </div>
            <div class="card-body">

            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>


                            <th>Voms ID </th>
                            <th>First Name </th>
                            <th>Last Name </th>
                            <th>State </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dealer as $key=>$row)
                        <tr>


                            <td>{{ $row->voms_id }}</td>
                            <td>{{ $row->first_name }}</td>
                            <td>{{ $row->last_name }}</td>
                            <td>{{ $row->name }}</td>




                            <td>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('view/dealer/'.$row->id) }}">  <i data-feather="view" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('edit/dealer/'.$row->id) }}">  <i data-feather="edit" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>


                                    <div class="avatar bg-danger">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('delete/dealer/'.$row->id) }}"> <i data-feather="delete" class="avatar-icon"></i></a>
                                        </div>
                                    </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="pagination pagination-lg justify-content-center mt-2" >{!! $dealer->onEachSide(1)->links() !!}</div>

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
