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
                        <h2 class="content-header-title float-start mb-0">Edit Role</h2>
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
                <div class="card-header">

                </div>
                <div class="card-body">

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                         @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                         @endforeach
                      </ul>
                    </div>
                  @endif

                  {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Name:</strong>
                              {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Permission:</strong>
                              <br/>
                              @foreach($permission as $value)
                                  <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                  {{ $value->name }}</label>
                              <br/>
                              @endforeach
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </div>
                  {!! Form::close() !!}


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
