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
                        <h2 class="content-header-title float-start mb-0">States</h2>
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
                            Add New State
                        </button>

                           <!-- Modal -->
                           <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">State </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="{{ route('store.state') }}">
                                        @csrf
                                        <div class="modal-body">





                                            <label>State Name: </label>
                                            <div class="mb-1">
                                                <input type="text" placeholder="User Type" class="form-control" name="name" />
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" >Add State</button>
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




  <!-- Hoverable rows start -->
  <div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">States</h4>
            </div>
            <div class="card-body">

            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            {{-- <th>State ID</th> --}}
                            <th>State Name</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($state as $key=>$row)
                        <tr>
                            <td>

                                <span class="fw-bold">{{ $key +1 }}</span>
                            </td>
                            {{-- <td>{{ $row->state_id }}</td> --}}
                            <td>{{ $row->name }}</td>



                            <td>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('view/state/'.$row->id) }}">  <i data-feather="view" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>

                                    <div class="avatar bg-primary">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('edit/state/'.$row->id) }}">  <i data-feather="edit" class="avatar-icon"></i> </a>
                                        </div>
                                    </div>


                                    <div class="avatar bg-danger">
                                        <div class="avatar-content">
                                            <a href="{{ URL::to('delete/state/'.$row->id) }}"> <i data-feather="delete" class="avatar-icon"></i></a>
                                        </div>
                                    </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Hoverable rows end -->










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
