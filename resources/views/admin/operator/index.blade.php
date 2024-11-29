@extends('admin.layouts.admin')


@section('title', 'Operators')

@section('content')
    <section class="content-header"></section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Operatorlar  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('operator.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Suxbat nomi</th>
                                <th>Qisqacha mazmuni</th>
                                <th>Qo'shilgan vaqti</th>
                                <th></th>
                            </tr>
                            <tr>
                                <form action="">
                                    <input type="hidden" name="from_filter" value="true">
                                    <button type="submit" class="d-none"></button>
                                    <th></th>
                                    <th>
                                        <input type="text" name="full_name_oz" class="form-control">
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
                                    <td>{{$model->operator->full_name_oz}}</td>
                                    <td>{{$model->name_oz}}</td>
                                    <th>{{$model->description_oz}}</th>
                                    <td>{{$model->created_at}}</td>
                                    <th>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{route('operator.edit', $model->id)}}" class="btn btn-info mr-2"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('operator.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
                                    </th>
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
                        <div class="text-right">
                            {{$models->links()}}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
