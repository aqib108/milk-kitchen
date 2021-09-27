@extends('admin.layouts.admin')
@section('title', 'List Of Product')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('product.create') }}" class="btn btn-primary pull-right"><i
                                    class="fas fa-fw fa-plus"></i>Add Product</a>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Product's List (Total Product's : <span id="countTotal">{{App\Models\Product::count();}}</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sku</th>
                                        <th>Name </th>
                                        <th>Pack Size</th>
                                        <th>New</th>
                                        <th>Active</th>
                                        <th>Status</th>
                                        @foreach($groups as $group)
                                          <th>{{$group}}</th>
                                        @endforeach
                                       
                                        <th class="no-sort" style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                             @foreach($data as $key=>$data)
                                 <tr>
                                     <td>
                                      {{++$key}}
                                     </td>
                                     <td>
                                         {{$data->sku}}
                                     </td>
                                     <td>
                                         {{$data->name}}
                                     </td>
                                     <td>
                                         {{$data->pack_size}}
                                     </td>
                                     <td>
                                         @if($data->new)
                                         <i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>
                                         @else
                                         <i class="fa fa-times" style="color:red;" aria-hidden="true"></i>   
                                         @endif
                                     </td>
                                     <td>
                                         @if($data->active)
                                         <i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>
                                         @else
                                         <i class="fa fa-times" style="color:red;" aria-hidden="true"></i>   
                                         @endif
                                     </td>
                                     <td>
                                         @if($data->status)
                                         <i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>
                                         @else
                                         <i class="fa fa-times" style="color:red;" aria-hidden="true"></i>   
                                         @endif
                                     </td>
                                     
                                     <?php 
                                        $other =$groups->count()-$data->services->count();
                                     foreach ($data->services as $key => $value) {
                                           if($value->saleable)
                                           { 
                                           ?>
                                         <td><i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i></td>
                                         <?php }else{ ?>
                                         <td><i class="fa fa-times" style="color:red;" aria-hidden="true"></i>  </td> 
                                         
                                         <?php } } 
                                          for ($i=0; $i <$other ; $i++) { ?>
                                            <td><i class="fa fa-times" style="color:red;" aria-hidden="true"></i>  </td> 
                                          <?php }
                                         ?>
                                         
                                       
       
                                     </td>
                                     <td>
                                    <a onclick='deleteProduct({{$data->id}})' href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>
                   <a href="{{route('product.edit', $data->id)}}" class="btn btn-sm btn-primary" >Edit</a>
                  <a href="{{route('product.detail', $data->id)}}" class="btn btn-primary btn-sm"> Detail </a>
                    @if($data->status == 1)
                      <a onclick="changeStatus({{$data->id}},0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>
                    @else
                      <a onclick="changeStatus({{$data->id}},1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>
                    @endif
                                     </td>
                                 </tr>
                             @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        var table;
        // $(document).ready(function() {

        //     table = $('#products').DataTable({
        //         responsive: true,
        //         processing: true,
        //         serverSide: true,
        //         ajax: "",
        //         columns: [{
        //                 data: 'DT_RowIndex',
        //                 name: 'DT_RowIndex',
        //                 orderable: false,
        //                 searchable: false
        //             },
        //             {
        //                 data: 'sku',
        //                 name: 'sku'
        //             },
        //             {
        //                 data: 'name',
        //                 name: 'name'
        //             },
        //             {
        //                 data: 'pack_size',
        //                 name: 'pack_size'
        //             },
        //             {
        //                 data: 'new',
        //                 name: 'new'
        //             },
        //             {
        //                 data: 'active',
        //                 name: 'active'
        //             },
        //             // {
        //             //     data: 'f_saleable',
        //             //     name: 'f_saleable'
        //             // },
        //             // {
        //             //     data: 'r_saleable',
        //             //     name: 'r_saleable'
        //             // },
        //             // {
        //             //     data: 'c_saleable',
        //             //     name: 'c_saleable'
        //             // },
        //             {
        //                 data: 'status',
        //                 name: 'status'
        //             },
        //             {
        //                 data: 'action',
        //                 name: 'action',
        //                 orderable: false,
        //                 searchable: false
        //             },
        //         ],
        //         render : function(data) {
        //             if(data){ $columns[] = [ 'data' => 'Ali', 'name' => 'Ali',]; } return $columns;
        //         }
        //         drawCallback: function(response) {
        //             $('#countTotal').empty();
        //             $('#countTotal').append(response['json'].recordsTotal);
        //         }
        //     });
        // });
        // Change Status Product
        function changeStatus(id, status) {
            var result =
                Swal.fire({
                    title: "Are you sure change this Status?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Change it!"
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: '{{ route('product.status') }}',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id,
                                'status': status
                            },
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                            position: 'top-end',
                                            toast: true,
                                            showConfirmButton: false,
                                            timer: 2000,
                                            icon: 'success',
                                            title: response.message,
                                        });
                                    window.location.reload();
                                } else {
                                    Swal.fire({
                                            position: 'top-end',
                                            toast: true,
                                            showConfirmButton: false,
                                            timer: 2000,
                                            icon: 'error',
                                            title: response.success,
                                        });
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
        };
        // Destory Product
        function deleteProduct(id, event) {
            var result =
                Swal.fire({
                    title: "Are you sure delete this product?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Delete it!"
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('product.destroy') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                            position: 'top-end',
                                            toast: true,
                                            showConfirmButton: false,
                                            timer: 4000,
                                            icon: 'success',
                                            title: 'Deleted Successfully',
                                        });
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
        };
    </script>
@endsection
