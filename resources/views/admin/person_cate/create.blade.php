@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategoriyalar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info card-outline">
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
                            <a class="nav-link" id="custom-tabs-three-en-tab" data-toggle="pill"
                               href="#custom-tabs-three-en" role="tab" aria-controls="custom-tabs-three-en"
                               aria-selected="false">EN</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Menu</label>
                                    <select name="menu" id="menu" class="form-control">
                                        <option value="">---</option>
                                        <option value="news">Yangiliklar</option>
                                        <option value="premiere">Premyaerlar</option>
                                        <option value="analysis">Kino Tahlil</option>
                                        <option value="interview">Suxbatlar</option>
                                        <option value="person">Shaxsiyatlar</option>
                                        <option value="dictionary">Kino Lug'at</option>
                                        <option value="fact">Kino Fakt</option>
                                        <option value="filmography">Filmografiya</option>
                                        <option value="books">Kitoblar</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('menu')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Kategoriya Nomi</label>
                                    <input type="text" class="form-control" name="name_oz" placeholder="Name">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="2">No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Order</label>
                                    <input type="text" class="form-control" name="order" placeholder="Order" value="{{$order}}">
                                    <small class="text-danger"{{$errors->first('order')}}></small>
                                </div>

                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Категория Номи</label>
                                    <input type="text" class="form-control" name="name_uz" placeholder="Name">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>
                            </div>
                            {{----  ru  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">
                                <div class="form-group">
                                    <label for="name_ru">Название категории</label>
                                    <input type="text" class="form-control" name="name_ru" placeholder="Name">
                                    <small class="text-danger">{{$errors->first('name_ru')}}</small>
                                </div>
                            </div>
                            {{----  en  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-en" role="tabpanel">
                                <div class="form-group">
                                    <label for="name_en">Category name</label>
                                    <input type="text" class="form-control" name="name_en" placeholder="Name">
                                    <small class="text-danger">{{$errors->first('name_en')}}</small>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-success">&check;Saqlash</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('#menu').on('change', function () {--}}
        {{--        let menu = $(this).val();--}}
        {{--        $.ajax({--}}
        {{--            url: '{{route('order_category')}}',--}}
        {{--            method: 'GET',--}}
        {{--            data: {menu: menu},--}}
        {{--            success: function (res){--}}
        {{--                let order = res.data.order + 1;--}}
        {{--                $('#order').val(order);--}}
        {{--            },--}}
        {{--        })--}}
        {{--    })--}}
        {{--})--}}
    </script>
@endpush
