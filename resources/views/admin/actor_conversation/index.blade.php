@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aktyorlar Suxbatlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('actor_conversation.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Actor_conversation</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Aktyorlar Suxbatlar  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('actor_conversation.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered" id="paging">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>F.I.O</th>
                            <th>Suxbat Nomi</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th>
                                    <input type="text" name="full_name_oz" class="form-control" value="{{request('full_name_oz')}}">
                                </th>
                                <th>
                                    <input type="text" name="name_oz" class="form-control" value="{{request('name_oz')}}">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @forelse($models as $k => $item)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$item->actor->full_name_oz}}</td>
                                <td>{{$item->name_oz}}</td>
                                <td>{{$item->description_oz}}</td>
                                <td>{{$item->status == 1?'Active':'No Active'}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('actor_conversation.edit', $item->id)}}" class="btn btn-info mr-1"><i class="fa fa-edit"></i></a>
                                        {{--                                            <a href="{{route('actor.show', $item->id)}}" class="btn btn-primary btn-sm mr-1"><i class="fa fa-eye"></i></a>--}}
                                        <form action="{{ route('actor_conversation.destroy', $item->id) }}" method="post" id="deleteItem-{{$item->id}}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <a type="submit" class="btn btn-danger"
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
                        {{$models->links('vendor.pagination.bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
