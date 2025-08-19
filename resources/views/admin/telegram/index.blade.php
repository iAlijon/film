@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Telegram Foydalanuvchilar</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-12 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>F.I.O</th>
                            <th>Username</th>
                            <th>Qo'shilgan vaqti</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $k => $model)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$model->name}}</td>
                                <td>{{$model->username}}</td>
                                <td>{{$model->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">{{$models->links('vendor.pagination.bootstrap-5')}}</div>
            </div>
        </div>
    </section>
@endsection
