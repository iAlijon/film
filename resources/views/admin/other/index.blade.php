@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Boshqa kino ijodkorlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dramaturgy.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">other_filmmarkers </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Boshqa kino ijodkorlar  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('other.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>F.I.O</th>
                            <th>Suxbat nomi</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th>
                                    <input type="text" name="full_name_oz" class="form-control">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $k => $model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$model->people_film_category_dramaturgy->full_name_oz}}</td>
                                <td>{{$model->name_oz}}</td>
                                <th>{{$model->description_oz}}</th>
                                <td>{{$model->created_at}}</td>
                                <th>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('other.edit', $model->id)}}" class="btn btn-info mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('other.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
                                            @csrf
                                            @method('delete')

                                        </form>
                                        <a type="submit" class="btn btn-danger"
                                           onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                                               document.getElementById('deleteItem-<?= $model->id ?>').submit();
                                               }">
                                            <span class="fa fa-trash-alt"></span>
                                        </a>
                                    </div>
                                </th>
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
                        <div class="text-right">
                            {{$models->links()}}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
