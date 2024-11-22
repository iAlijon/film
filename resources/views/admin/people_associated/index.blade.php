@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('people_film.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Film</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-users"></i></h3>
                <div class="text-right">
                    <a href="{{route('people_film.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Rasm</th>
                            <th>F.I.O</th>
                            <th>Qisqacha ma'lumot</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>
                                <input type="text" name="name_oz" class="form-control form-control-sm">
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($models as $k => $model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td><img src="{{getInFolder($model->images, 'people_associated')}}" alt="errors"></td>
                                <td>{{$model->full_name_oz}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>

                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
