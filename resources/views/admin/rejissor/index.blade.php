@extends('admin.layouts.admin')

@section('content')
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Rejissor Bilan Suxbatlar <i class="fa fa-users"></i></h3>
                <div class="text-right">
                    <a href="{{route('rejissor.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>F.I.O</th>
                        <th>Suxbat mazmuni</th>
                        <th>Qisqacha ma'lumot</th>
                        <th>Qo'shilgan vaqti</th>
                        <th></th>
                    </tr>
                    <tr>
                        <form action="" >
                            <input type="hidden" name="from_filter" value="true">
                            <button type="submit" class="d-none"></button>
                            <th></th>
                            <th>
                                <input type="text" class="form-control form-control-sm" name="full_name_oz">
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
                                <td>{{$model->people_film_category->full_name_oz}}</td>
                                <td>{{$model->name_oz}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td>{{($model->created_at)}}</td>
                                <td>
                                    <a href="{{route('rejissor.edit', $model->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
