@extends('admin.layouts.admin')

@push('css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            vertical-align: text-top;
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
        /*--------- END --------*/

    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$menus['news']}}</h3>

                        <p>Yangliklar</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                    <a href="{{route('news.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$menus['aphorism']}}</h3>
                        <p>Afarizmlar</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-aphorism"></i>
                    </div>
                    <a href="{{route('aphorism.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{$menus['premiere']}}</h3>
                        <p>Premyeralar</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-film"></i>
                    </div>
                    <a href="{{route('premiere.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>{{$menus['interview']}}</h3>
                        <p>Suxbatlar</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('interview.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Yangiliklar <i class="fas fa-newspaper"></i></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped text-center table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomi</th>
                                    <th>Qisqacha ma'lumot</th>
                                    <th>Kategoriya</th>
                                    <th>Status</th>
                                    <th>Qo'shilgan sana</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($news as $k => $new)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td>{{$new->name_oz}}</td>
                                    <td>{{$new->description_oz}}</td>
                                    <td>{{$new->category->name_oz}}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox"
                                                   class="status-toggle"
                                                   data-id="{{$new->id}}"
                                                {{$new->status == true ? 'checked':false}}
                                            >
                                            <div class="slider round"></div>
                                        </label>
                                    </td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($new->created_at)->format('d.m.Y')}}</td>
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
                        <div class="float-right">
                            {{$news->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
