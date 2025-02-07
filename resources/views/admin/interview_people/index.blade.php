@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yulduzlar Bilan Intervyu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('interview_peoples.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Stars With Interview</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Yulduzlar Bilan Intervyu
                        <i class="fas fa-users"></i>
                    </h3>
                    <div class="text-right">
                        <a href="{{route('interview_peoples.create')}}" class="btn btn-success text-white">&plus; Qo'shish</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-hover table-bordered text-center table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>F.I.O</th>
                            <th>Kategoriya</th>
                            <th>Status</th>
                            <th>Qo'shilgan sanasi</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" class="form_filter" value="true">
                                <button class="d-none" type="submit"></button>
                                <th></th>
                                <th>
                                    <input type="text" class="form-control" value="{{request()->is('full_name_oz')}}" name="full_name_oz">
                                </th>
                                <th>
                                    <select class="form-control" name="category_id" id="" onchange="this.form.submit()">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == request('category_id')?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
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
                                <td>{{$model->full_name_oz}}</td>
                                <td>{{$model->category->name_oz}}</td>
                                <td>{{$model->status == 1?'Active':'No Active'}}</td>
                                <td>{{$model->created_at}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('interview_peoples.edit', $model->id)}}" class="btn btn-info mr-1"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('interview_peoples.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
                <div class="text-right">
                    {{$models->links('vendor.pagination.bootstrap-5')}}
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection
