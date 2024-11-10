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
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Har bir elementni teng kenglikda qilish */
            gap: 10px; /* elementlar orasidagi masofa */
            height: 100%;
        }
        .project-actions a{
            width: 100%;
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
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">News List</h3>
                    <a href="{{route('news.create')}}" class="btn btn-success ml-auto"><i class="fa fa-plus"></i> Qo'shish</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th class="w-25">
                                    <input type="text" class="form-control form-control-sm" name="name_oz"
                                           value="{{request('name_oz')}}">
                                </th>
                                <th class="w-25">
                                    <input type="text" class="form-control form-control-sm" name="description_oz"
                                           value="{{request('description_oz')}}">
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
                                <td class="d-flex justify-content-center align-content-around">
                                    <a href="{{route('news.edit', $model->id)}}" class="btn btn-info btn-sm mr-1"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <a href="{{route('news.show', $model->id)}}" class="btn btn-primary btn-sm mr-1"><i
                                            class="fas fa-eye"></i></a>
                                    <form action="{{ route('news.destroy', $model->id) }}" method="post" id="deleteItem-{{$model->id}}">
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
                <!-- /.card-body -->
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
