@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Suxbatlar</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('interview.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Interview</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Suxbatlar  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('interview.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategoriya</th>
                            <th>F.I.O</th>
                            <th>Nomi</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Status</th>
                            <th>Qo'shilgan sanasi</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" value="true" name="form_filter">
                                <button class="d-none" type="submit"></button>
                                <th></th>
                                <th>
                                    <select name="category_id" id="" class="form-control" onchange="this.form.submit()">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == request('category_id')?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <select name="people_id" id="" class="form-control" onchange="this.form.submit()">
                                        <option value="">---</option>
                                        @foreach($peoples as $people)
                                            <option value="{{$people->id}}" {{$people->id == request('people_id')?'selected':''}}>{{$people->full_name_oz}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <input type="text" name="interview_oz" class="form-control" value="{{request('interview_oz')}}" placeholder="Suxbatlar Nomi">
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
                            </form>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($models as $k => $model)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td>{{$model->category->name_oz}}</td>
                                    <td>{{$model->people->full_name_oz}}</td>
                                    <td>{{$model->interview_oz}}</td>
                                    <td>{{$model->description_oz}}</td>
                                    <td>{{$model->status == 1?'Active':'No Active'}}</td>
                                    <td>{{$model->created_at}}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{route('interview.edit', $model->id)}}" class="btn btn-info mr-1"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('interview.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
                <div class="card-footer">
                    <div class="text-right">
                        {{$models->links('vendor.pagination.bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
