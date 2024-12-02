@extends('admin.layouts.admin')

@push('css')
    <style>
        .table th{
            vertical-align: 0 !important;
        }
    </style>
@endpush

@section('content')
    <section class="content-header"></section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Rejissorlar  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('portret_rejissors.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Rasm</th>
                            <th>F.I.O</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from-filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th></th>
                                <th>
                                    <input type="text" class="form-control" name="full_name_oz">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $k => $item)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td><img src="{{getInFolder($item->images, 'portret_rejissor')}}" alt="error" class="profile-user-img img-fluid img-circle"></td>
                                <td>{{$item->full_name_oz}}</td>
                                <td>{{$item->description_oz}}</td>
                                <td>{{$item->status == true?'Active':'No Active'}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('portret_rejissors.edit', $item->id)}}" class="btn btn-info btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('portret_rejissors.destroy', $item->id) }}" method="post" id="deleteItem-{{$item->id}}">
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
            </div>
        </div>
    </section>
@endsection
