{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                <td>
                                    <button type="button" class="btn btn-block btn-default">Add User</button>
                                </td>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Business Name</th>
                                        <th>Mobile</th>
                                        <th>Type</th>
                                        <th>Created</th>
                                        <th>Status</th>

                                        {{--                                        <th>Last Login</th>--}}
                                        {{--                                        <th>Last Updated</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->user_id}} </td>
                                            <td>{{$user->email}} </td>
                                            <td>{{$user->firstname}} </td>
                                            <td>{{$user->lastname}} </td>
                                            <td>{{$user->business_id}} </td>
                                            <td>{{$user->msisdn}} </td>
                                            <td>{{$user->role}} </td>
                                            <td>{{$user->created_at}} </td>
                                            <td class="text-center">
                                                @if ($user->status == 'active')
                                                    <span class='badge badge-success'>active</span>
                                                @elseif ($user->status == 'inactive')
                                                    <span class='badge badge-warning'>inactive</span>
                                                @elseif ($user->status == 'banned')
                                                    <span class='badge badge-danger'>banned</span>
                                                @elseif ($user->status == 'processing')
                                                    <span class='badge badge-info'>processing</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="col "><a href="{{ route('Index', $user->id) }}" class="btn btn-primary">VIEW</a></div>
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        @stop

        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
        @stop

        @section('js')
            <script> console.log('Hi!'); </script>
@stop
