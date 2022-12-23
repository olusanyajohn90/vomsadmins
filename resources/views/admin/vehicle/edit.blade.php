@extends('admin.admin_layouts')


@section('admin_content')




@php



@endphp




<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Edit Vehicle</h2>
                        <div class="breadcrumb-wrapper">

                        </div>
                    </div>
                </div>
            </div>







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
                    <form method="POST"  action="{{ url('update/vehicle/'.$vehicle->id)}}">
                        @csrf
                        <div class="row">









                            <label>Vehicle Owner Id : </label>
                            <div class="mb-1">
                                <input type="text" value="{{ $vehicle->owner_voms_id }}" class="form-control" name="owner_voms_id" />
                            </div>


                            <label>Vehicle Last Name : </label>
                            <div class="mb-1">
                                <input type="text" value="{{ $vehicle->colour }}" class="form-control" name="colour" />
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
