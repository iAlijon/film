@extends('admin.layouts.admin')

@section('title', 'Kino Lug\'at')

@push('css')
    <style>
        .alert {
            position: relative;
        }

        .alert-success {
            color: #155724 !important;
            background-color: #d4edda !important;
            border-color: #c3e6cb !important;
        }



        .cancel {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            font-size: 20px;
        }

    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinolug'at</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('film_dictionary.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dictionary</li>
                    </ol>
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
                    <h3 class="card-title">Kinolug'at  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('film_dictionary.create')}}" class="btn btn-success">&plus; Qo'shish</a>
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
                                        <input type="text" class="form-control" name="name_oz" value="{{request('name_oz')}}" placeholder="Lug'at Nomi">
                                    </th>
                                    <th></th>
                                    <th>
                                        <select name="dictionary_id" id="" class="form-control" onchange="this.form.submit()">
                                            <option value="">----</option>
                                            @foreach($letters['data'] as $letter)
                                                <option value="{{$letter['id']}}" {{$letter['id'] == request('dictionary_id')?'selected':''}}>{{$letter['name']}}</option>
                                            @endforeach
                                        </select>
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
                                            @foreach($letters['data'] as $letter)
                                                {{$result->dictionary_category_id == $letter['id']?$letter['name']:''}}
                                            @endforeach,
                                        @endforeach
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->status == 1?'Active':'No Active'}}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{route('film_dictionary.edit', $item->id)}}" class="btn btn-info mr-2"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('film_dictionary.destroy', $item->id) }}" method="post" id="deleteItem-{{$item->id}}">
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
                        <div class="text-right">
                            {{$models->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
