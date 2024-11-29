@extends('admin.layouts.admin')

@push('css')
    <style>
        table td {
            vertical-align: middle !important;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kino tegishli odamlar</h1>
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
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Kino tegishli odamlar <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('people_film.create')}}" class="btn btn-success">&plus; Qo'shish</a>
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
                            <th>Kasbi</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th></th>
                                <th class="w-25">
                                    <input type="text" name="full_name_oz" class="form-control"
                                           value="{{request('full_name_oz')}}">
                                </th>
                                <th></th>
                                <th class="w-25">
                                    <select name="category_id" id="category_id" class="form-control"
                                            onchange="this.form.submit()">
                                        <option value="">----</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{request('category_id') == $category->id?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @forelse($models as $k => $model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>
                                    <img src="{{getInFolder($model->images, 'people_associated')}}"
                                         class="profile-user-img img-fluid img-circle" alt="errors">
                                </td>
                                <td>{{$model->full_name_oz}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td>{{$model->category->name_oz}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('people_film.edit', $model->id)}}"
                                           class="btn btn-info btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('people_film.destroy', $model->id) }}" method="post"
                                              id="deleteItem-{{$model->id}}">
                                            @csrf
                                            @method('delete')

                                        </form>
                                        <a type="submit" class="btn btn-danger btn-sm"
                                           onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                                               document.getElementById('deleteItem-<?= $model->id ?>').submit();
                                               }">
                                            <span class="fa fa-trash-alt"></span>
                                        </a>
                                    </div>
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
                        <div class="text-right">
                            {{$models->links('vendor.pagination.bootstrap-5')}}
                        </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
