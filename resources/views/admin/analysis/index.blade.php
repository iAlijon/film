@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">

    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Kino tahlil <i class="fas fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('film_analysis.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Tahlil</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" value="true" name="form_filter">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th>
                                    <input type="text" name="name_oz" class="form-control" value="{{request('name_oz')}}">
                                </th>
                                <th>
                                    <select name="analysis_category" id="" class="form-control" onchange="this.form.submit()">
                                        <option value="">----</option>
                                        <option value="1" {{request('analysis_category') == 1?'selected':''}}>Milliy filmlar tahlili</option>
                                        <option value="2" {{request('analysis_category') == 2?'selected':''}}>Xorijiy filmlar tahlili</option>
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
                        @forelse($models as $k=>$model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$model->name_oz}}</td>
                                <td>{{$model->analysis_category == 1?'Milliy filmlar tahlili':'Xorijiy filmlar tahlili'}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td>{{$model->status == 1?'Active':'No Active'}}</td>
                                <td>{{$model->create_at}}</td>
                                <td>
                                    <a href="{{route('analysis.index')}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
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
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
