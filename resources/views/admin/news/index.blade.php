@extends('admin.layouts.admin')

@section('title', 'Yangiliklar')
@push('css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2ab934;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(18px);
            -ms-transform: translateX(18px);
            transform: translateX(26px);
        }

        /*------ ADDED CSS ---------*/
        .slider:after {
            content: 'OFF';
            color: white;
            display: block;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 70%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        input:checked + .slider:after {
            content: 'ON';
            color: white;
            display: block;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 30%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }
        .project-actions{
            display: flex;
            align-items: center;
            justify-content: center;

        }
       .table{
           text-align: center;
       }
       label{
           margin-bottom: 0;
       }
        /*--------- END --------*/

    </style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yangiliklar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('news.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">News</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Yangiliklar <i class="fas fa-newspaper"></i></h3>
                    <div class="text-right">
                        <a href="{{route('news.create')}}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th>Nomi</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>Kategoriya</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th class="w-25">
                                    <input type="text" class="form-control" name="name_oz"
                                           value="{{request('name_oz')}}" placeholder="Yangiliklar Nomi">
                                </th>
                                <th></th>
                                <th>
                                    <select name="category_id" class="form-control" id="new_category_id" onchange="this.form.submit()">
                                        <option value="">----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{request('category_id') == $category->id ?'selected':''}}>
                                                {{$category->name_oz}}
                                            </option>
                                        @endforeach
                                    </select>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $k => $model)
                            <tr>
                                <td class="text-center">{{$k + 1}}</td>
                                <td>{{$model->name_oz}}</td>
                                <td>{{$model->description_oz}}</td>
                                <td>{{$model->category->name_oz}}</td>
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox"
                                               class="status-toggle"
                                               data-id="{{$model->id}}"
                                            {{$model->status == true ? 'checked':false}}
                                        >
                                        <div class="slider round"></div>
                                    </label>
                                </td>
                                <td class="text-center">{{\Carbon\Carbon::parse($model->created_at)->format('d.m.Y')}}</td>
                                <td>
                                    <div class="project-actions">
                                        <a href="{{route('news.edit', $model->id)}}" class="btn btn-info mr-1"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <a href="{{route('news.show', $model->id)}}" class="btn btn-info mr-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('news.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="col-sm-12 text-right">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{$models->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.status-toggle').change(function () {
                const checkbox = $(this);
                const itemId = checkbox.data('id');
                const newStatus = checkbox.is(':checked') ? true : false;
                console.log(itemId, newStatus)
                $.ajax({
                    url: "{{route('new-status')}}",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: itemId,
                        status: newStatus
                    },
                    success: function (data) {
                        console.log(data)
                        location.reload()
                    },
                    error: function (error) {
                        console.log(error)
                        alert('ID' + ' ' + itemId + ' ' + 'm\'alumotni holati o\'zgarmadi')
                    }
                })

            });
        });
    </script>
@endpush
