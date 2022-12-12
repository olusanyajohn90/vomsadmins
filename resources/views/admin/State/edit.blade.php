@extends('admin.admin_layouts')


@section('admin_content')


@php

// $state = DB::table('states')->get()->first();



@endphp



<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Edit STATE</h2>
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
                            Add STATE
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

                                            <label>State id: </label>
                                            <div class="mb-1">
                                                <input type="text" placeholder="User Type" class="form-control" name="id" />
                                            </div>



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




 <!-- Basic multiple Column Form section start -->
 <section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST"  action="{{ url('update/state/'.$state->id)}}">
                        @csrf
                        <div class="row">
                            {{-- <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-column">State ID</label>
                                    <input type="text" id="first-name-column" class="form-control"  name="state_id" value="{{ $state->id }}" />
                                </div>
                            </div> --}}


                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-column">State name</label>
                                    <input type="text" id="first-name-column" class="form-control"  name="name" value="{{ $state->name }}" />
                                </div>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Floating Label Form section end -->












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
