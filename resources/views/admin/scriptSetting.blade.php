@extends('admin.layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
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
                            <h3 class="card-title"> Admin Settings</h3>
                        </div>
                        <!-- /.card-header -->

                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- form start -->
                        <form action="{{ route('update-scriptSetting') }}" method="POST">
                            @csrf
                            <div class="card-body">
                               @foreach($result as $res)
                               <div class="row">
                                    <div class="form-group col-md-4">
                                        <!-- <label>Name <span class="required-star">*</span></label> -->
                                        <!-- <input type="hidden"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="{{$res->name }}" value="{{$res->value }}" placeholder="Cutt of time Name" required> -->
                                            <input type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                             value="{{$res->name }}" placeholder="Cutt of time Name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <!-- <label>Value<span class="required-star">*</span></label> -->
                                         @if($res->name == "Cutt_Off_Time")
                                          <input type="time" class="form-control" name="{{$res->name }}" value="{{$res->value}}"
                                            placeholder="{{$res->name}}" required>
                                          @else
                                          <input type="text" class="form-control" name="{{$res->name }}" value="{{$res->value}}"
                                            placeholder="{{$res->name}}" required>
                                          @endif 
                                    </div>
                                </div>
                               @endforeach
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#current_password').keyup(function(e) {
                var current_password = $('#current_password').val();
                $.ajax({
                    method: "Post",
                    url: '{{ route('admin.check-password') }}',
                    dataType: 'html',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'current_password': current_password,
                    },
                    success: function(response) {
                        if (response == "false") {
                            $("#check_current_password").html(
                                "<font color=red>Current Password is Incorrect</font>");
                        } else if (response == "true") {
                            $("#check_current_password").html(
                                "<font color=green>Current Password is Correct</font>");
                        }
                    }
                });
            });
        });
    </script>
@endsection
