@extends('admin.layouts.admin')

@section('title', 'Kino Lug\'at')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinolug'at</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('film_dictionary.index')}}">home</a></li>
                        <li class="breadcrumb-item active">film_dictionary</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Kinolug'at  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('film_dictionary.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Qisqacha ma'lumoti</th>
                                <th>Lug'at</th>
                                <th>Qo'shilgan vaqti</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            <tr>
                                <form action="">
                                    <input type="hidden" name="from_filter" value="true">
                                    <button type="submit" class="d-none"></button>
                                    <th></th>
                                    <th>
                                        <input type="text" class="form-control" name="example">
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
                            @forelse($models as $k=>$item)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td>{{$item->name_oz}}</td>
                                    <td>{{$item->description_oz}}</td>
                                    <td>
                                        @foreach($item->film_dictionary_category as $result)
                                            @foreach($dictinaries as $param)
                                                {{$result->dictionary_category_id == $param->id?json_decode($param->oz)->upper:''}}
                                            @endforeach
                                            ,
                                        @endforeach
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->status == 1?'Active':'No Active'}}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{route('film_dictionary.edit', $item->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>

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
