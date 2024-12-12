@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Badiiy Filmlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('artistic_film.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">artistic</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('artistic_film.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Qisqacha ma'lumoti</th>
                            <th>status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th>
                                    <input type="text" class="form-control" name="name_oz" value="{{request('name_oz')}}" placeholder="Search">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $k=>$model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$model->name_oz}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td>{{$model->status}}</td>
                                <td>{{$model->created_at}}</td>
                                <td>
                                    <a href="{{route('artistic_film.edit', $model->id)}}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('actor.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
                                        @csrf
                                        @method('delete')

                                    </form>
                                    <a type="submit" class="btn btn-danger btn-sm"
                                       onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                                           document.getElementById('deleteItem-<?= $model->id ?>').submit();
                                           }">
                                        <span class="fa fa-trash-alt"></span>
                                    </a>
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
                <div class="text-right">
                    {{$models->links('vendor.pagination.bootstrap-5')}}
                </div>
            </div>
        </div>
    </section>
@endsection
