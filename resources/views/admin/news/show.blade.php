@extends('admin.layouts.admin')

@section('title', 'Yangiliklar')

@push('css')
    <style>
        img{
            width: 250px;
            height: 200px;
        }
    </style>
@endpush

@section('content')
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
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-outline card-info">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="true">O'Z</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false">UZ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-ru-tab" data-toggle="pill"
                               href="#custom-tabs-three-ru" role="tab" aria-controls="custom-tabs-three-ru"
                               aria-selected="false">RU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="custom-tabs-three-body-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false" disabled="disabled">EN</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        {{----- oz -----}}
                        <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>Nomi</th>
                                        <td>{{$model->name_oz}}</td>
                                    </tr>
                                    <tr>
                                        <th>Rasm</th>
                                        <td><img src="{{getInFolder($model->image, 'news')}}" alt="error"></td>
                                    </tr>
                                    <tr>
                                        <th>Qisqacha ma'lumot</th>
                                        <td>{{$model->description_oz}}</td>
                                    </tr>
                                    <tr>
                                        <th>Qo'shilgan vaqti</th>
                                        <td>{{$model->created_at->format('d-m-Y')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{$model->status==1?'Active':'No Active'}}</td>
                                    </tr>
                                    <tr>
                                        <th>To'liq ma'lumot</th>
                                        <td>{!! $model->content_oz !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{----- uz -----}}
                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th>Номи</th>
                                    <td>{{$model->name_uz}}</td>
                                </tr>
                                <tr>
                                    <th>Расм</th>
                                    <td><img src="{{getInFolder($model->image, 'news')}}" alt="error"></td>
                                </tr>
                                <tr>
                                    <th>Қисқача маълумот</th>
                                    <td>{{$model->description_uz}}</td>
                                </tr>
                                <tr>
                                    <th>Қўшилган вақти</th>
                                    <td>{{$model->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Статус</th>
                                    <td>{{$model->status==1?'Active':'No Active'}}</td>
                                </tr>
                                <tr>
                                    <th>Тўлиқ маълумот</th>
                                    <td> <?= $model->content_uz ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{----- ru -----}}
                        <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th>Имя</th>
                                    <td>{{$model->name_ru}}</td>
                                </tr>
                                <tr>
                                    <th>Картина</th>
                                    <td><img src="{{getInFolder($model->image, 'news')}}" alt="error"></td>
                                </tr>
                                <tr>
                                    <th>Краткая информация</th>
                                    <td>{{$model->description_ru}}</td>
                                </tr>
                                <tr>
                                    <th>Добавленное время</th>
                                    <td>{{$model->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Статус</th>
                                    <td>{{$model->status==1?'Active':'No Active'}}</td>
                                </tr>
                                <tr>
                                    <th>Полная информация</th>
                                    <td> <?= $model->content_ru ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center float-right">
                        <a href="{{route('news.edit', $model->id)}}" class="btn btn-info mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('news.destroy', $model->id) }}" method="post"
                              id="deleteItem-{{$model->id}}">
                            @csrf

                        </form>
                        <a type="submit" class="btn btn-danger"
                           onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                               document.getElementById('deleteItem-<?= $model->id ?>').submit();
                               }">
                            <span class="fa fa-trash-alt"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
