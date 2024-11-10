@extends('admin.layouts.admin')

@section('title', 'Rejissor')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rejissorlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('director.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Rejissor</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Rejissorlar List</h3>
                <div class="text-right">
                    <a href="{{route('director.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Qo'shish</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="form-filter" value="true">
                                <th></th>
                                <th>
                                    <input type="text" name="name_oz" class="form-control form-control-sm" value="{{request('name_oz')}}">
                                </th>
                                <th>
                                    <input type="text" name="description_oz" class="form-control form-control-sm" value="{{request('description_oz')}}">
                                </th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse((array)$models as $k => $item)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$item->name_oz}}</td>
                                <td>{{$item->description_oz}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <a href="{{'director.edit'}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('director.destroy',  $model->id) }}" method="post"
                                          onsubmit="return confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')">
                                        @csrf
                                        @method('delete')
                                        <a type="submit" class="btn btn-danger btn-sm">
                                            <span class="fa fa-trash-alt"></span>
                                            Delete
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="alert alert-default-warning">
                                        Ma'lumot mavjud emas
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
