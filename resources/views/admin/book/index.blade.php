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
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
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
                                    <select name="category_id" id="category_id" onchange="this.form.submit()" class="form-control">
                                        <option value="">----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <input type="text" name="name_oz" class="form-control" value="{{request('name_oz')}}">
                                </th>
                                <th></th>
                                <th>
                                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                                        <option value="">---</option>
                                        <option value="1" {{request('status') == 1?'selected':''}}>Active</option>
                                        <option value="2" {{request('status') == 2?'selected':''}}>No Active</option>
                                    </select>
                                </th>
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
                            <td>{{$model->category->name_oz}}</td>
                            <td>{{$model->name_oz}}</td>
                            <td>{{$model->description_oz}}</td>
                            <td>{{$model->status == 1?'Active':'No Active'}}</td>
                            <td>{{$model->created_at}}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{$model->files}}" class="btn btn-info mr-2" target="_blank"><i class="fas fa-eye"></i></a>
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
                <div class="text-right">{{$models->links('vendor.pagination.bootstrap-5')}}</div>
            </div>
        </div>
    </section>
@endsection
