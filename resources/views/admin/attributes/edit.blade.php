@extends('admin.layouts.admin')
@section('title','Edit Attribute')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attribute's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('attribute.index')}}" class="btn btn-dark">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Attribute</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('attribute.update',$attribute->id)}}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label for="product_id">Product's<span class="required-star">*</span></label>
                                        <select name="product_id" id="product_id"
                                            class="form-control @error('product_id') is-invalid @enderror" required>
                                            <option value="" disabled selected>Select Product</option>
                                            @foreach ($products as $product)
                                            <option @if ($attribute->product_id == $product->id) selected @endif
                                                value="{{$product->id}}">{{ $product->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                        @error('product_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Size <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control @error('size') is-invalid @enderror" name="size"
                                            value="{{$attribute->size}}" placeholder="Enter Size liter" required>
                                        @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Quantity <span class="required-star">*</span></label>
                                        <input type="number" maxlength="50" class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                            value="{{$attribute->quantity}}" placeholder="Enter Quantity" required>
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>SKU </label>
                                        <input type="text" maxlength="50" class="form-control @error('sku') is-invalid @enderror" name="sku"
                                            value="{{$attribute->sku}}" placeholder="Enter SKU 11-22-33-444-555">
                                        @error('sku')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6">
                                        <label>Descriptions <span class="required-star">*</span></label>
                                        <textarea name="description" id="description" cols="15" rows="2"
                                            class="form-control text-area"
                                            >{{$attribute->description}}</textarea>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection