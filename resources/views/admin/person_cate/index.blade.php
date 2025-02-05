@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shaxsiyatlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('person_category.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Person Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Shaxsiyatlar Kategoriyasi
                        <i class="fas fa-users"></i>
                    </h3>
                    <div class="text-right">
                        <a href="{{route('person_category.create')}}" class="btn btn-success text-white">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Status</th>
                            <th>Qo'shilgan sanasi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $k=>$model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$model->name_oz}}</td>
                                <td>{{$model->status == 1?'Active':'No Active'}}</td>
                                <td>{{$model->created_at}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('interview_category.edit', $model->id)}}" class="btn btn-info mr-1"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('interview_category.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
