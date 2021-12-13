@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')

<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ml-5">
                <div class="col-sm-12">
                    <h1>Allocate Customer Payment of Week({{$start}} -- {{$end}})</h1>
                </div>
            </div>
             <div class="row-md-12">
                <form action="{{route('saveAllocatePayment')}}" method="POST">
                    @csrf
                <div class="col-4 allign-centre">
                      <label for="">Name</label>
                      <input type="text" value="{{$name}}" class="form-control" disabled>
                  <label for="" class="control-label">Total Payment</label>
                  <input type="text" value="{{$price}}"  class="form-control" disabled>
                  <label for="" class="control-label">Allocate Payment</label>
                  <input type="hidden" name="start" value="{{$start}}">
                  <input type="hidden" name="end" value="{{$end}}">
                  <input type="hidden" name="customerId" value="{{$id}}">
                  <input type="text"  name="amount" class="form-control">
                   <input type="submit" value="submit" class="form-control button btn-success">
                  </div>
                </form>
             </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
