@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kitoblar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('book.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Books</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Kitoblar <i class="fas fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('book.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategoriya</th>
                            <th>Nomi</th>
                            <th>Qisqacha ma'lumoti</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th>Fayillar</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" value="true" name="form_filter">
                                <button class="d-none" type="submit"></button>
                                <th></th>
                                <th>
                                    <select name="book_category" id="book_category" onchange="this.form.submit()" class="form-control">
                                        <option value="">----</option>
                                        <option value="1" {{request('book_category') == 1?'selected':''}}>Badiiy</option>
                                        <option value="2" {{request('book_category') == 2?'selected':''}}>Xorijiiy</option>
                                        <option value="3" {{request('book_category') == 3?'selected':''}}>Animatsiya</option>
                                        <option value="4" {{request('book_category') == 4?'selected':''}}>Dessertatsiya</option>
                                    </select>
                                </th>
                                <th>
                                    <input type="text" name="name_oz" class="form-control" value="{{request('name_oz')}}">
                                </th>
                                <th></th>
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
                            @if($model->book_category == 1)
                                <td>Badiiy kino</td>
                            @elseif($model->book_category == 2)
                                <td>Xorijiiy kino</td>
                            @elseif($model->book_category == 3)
                                <td>Animatsion</td>
                            @elseif($model->book_category == 4)
                                <td>Desertatsiya</td>
                            @endif
                            <td>{{$model->name_oz}}</td>
                            <td>{{$model->description_oz}}</td>
                            <td>{{$model->status == 1?'Active':'No Active'}}</td>
                            <td>{{$model->created_at}}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{getFile($model->files)}}" class="btn btn-info mr-2" target="_blank"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('download', $model->id)}}" class="btn btn-primary"><i class="fas fa-download"></i></a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{route('book.edit', $model->id)}}" class="btn btn-info mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('book.destroy', $model->id) }}" method="post"
                                          id="deleteItem-{{$model->id}}">
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
                            </td>
                        </tr>
                        @empty
                            <tr>

                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
