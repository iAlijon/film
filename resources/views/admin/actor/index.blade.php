@extends('admin.layouts.admin')

@push('css')
    <style>
        table td{
            vertical-align: middle!important;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aktyorlar</h1>
                </div>
{{--                <div class="col-sm-6">--}}
{{--                    <ol class="breadcrumb float-sm-right">--}}
{{--                        <li class="breadcrumb-item"><a href="{{route('actor.index')}}">Home</a></li>--}}
{{--                        <li class="breadcrumb-item active">Aktyorlar</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Aktyorlar  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('actor.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered table-sm" id="paging">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Rasm</th>
                            <th>F.I.O</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th></th>
                                <th>
                                    <input type="text" name="full_name_oz" class="form-control form-control-sm" value="{{request('full_name_oz')}}">
                                </th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($models as $k => $item)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td class="text-center" width="100px"><img src="{{getInFolder($item->images, 'actor')}}" alt="error" width="100px" height="100px"></td>
                                    <td>{{$item->full_name_oz}}</td>
                                    <td>{{$item->description_oz}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{route('actor.edit', $item->id)}}" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
{{--                                            <a href="{{route('actor.show', $item->id)}}" class="btn btn-primary btn-sm mr-1"><i class="fa fa-eye"></i></a>--}}
                                            <form action="{{ route('actor.destroy', $item->id) }}" method="post" id="deleteItem-{{$item->id}}">
                                                @csrf
                                                @method('delete')

                                            </form>
                                            <a type="submit" class="btn btn-danger btn-sm"
                                               onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                                                   document.getElementById('deleteItem-<?= $item->id ?>').submit();
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
                        {{$models->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
