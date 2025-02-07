@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Premyera</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('premiere.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Premiere</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Premyera  <i class="fa fa-film"></i></h3>
                    <div class="text-right">
                        <a href="{{route('premiere.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Kategoriya</th>
                            <th>Qisqacha malumot</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="form-filter" value="true">
                                <button class="d-none" type="submit"></button>
                                <th></th>
                                <th>
                                    <input type="text" name="name_oz" class="form-control" value="{{request()->is('name_oz')}}">
                                </th>
                                <th>
                                    <select name="category_id" id="" onchange="this.form.submit()" class="form-control">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
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
                                <td>{{$model->name_oz}}</td>
                                <td>{{$model->category->name_oz}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td>{{$model->status == 1?'Active':'No Active'}}</td>
                                <td>{{$model->created_at}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('premiere.edit', $model->id)}}" class="btn btn-info mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('premiere.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
            </div>
        </div>
    </section>
@endsection
