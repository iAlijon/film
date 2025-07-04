@extends('admin.layouts.admin')

@push('css')
    <style>
        .images img{
            width: 250px;
            height: 250px;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kino Tahlil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('film_analysis.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Film Analysis</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{session()->get('error')}}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
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
                            <a class="nav-link" id="custom-tabs-three-content-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="false">RU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-body-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false">EN</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{route('film_analysis.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{---- oz ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label for="category_id">Tahlil kategoriyasi</label>
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$model->category_id == $category->id?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('category_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="name_oz">Nomi</label>
                                    <input type="text" class="form-control" name="name_oz" value="{{$model->name_oz}}">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Rasm</label>
                                    @if($model->image)
                                        <div id="imageBox" style="width: 200px; height: 200px; margin-bottom: 30px">
                                            <img src="{{getInFolder($model->images, 'analysis')}}" alt="" style="width: 100%; height: 100%">
                                            <p>
                                                <a href="#" id="changeImage">O'zgartiring</a>
                                            </p>
                                        </div>
                                        <div id="fileInput" style="display: none">
                                            <input type="file" class="form-control" name="images">
                                            <p>
                                                <a href="" id="cancelChangeImage">Bekor qilish</a>
                                            </p>
                                        </div>
                                    @else
                                        <input type="file" class="form-control" name="image" accept="image/jpeg,png,jpg" maxlength="2048">
                                    @endif
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_oz">To'liq ma'lumot</label>
                                    <textarea name="content_oz" id="" cols="30" rows="10" class="form-control textarea">{{$model->content_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                                    </select>
                                </div>

                            </div>
                            {{---- uz ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">

                                <div class="form-group">
                                    <label for="name_uz">Номи</label>
                                    <input type="text" class="form-control" name="name_uz" value="{{$model->name_uz}}">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумот</label>
                                    <textarea name="description_uz" id="description_uz" cols="30" rows="5" class="form-control">{{$model->description_uz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_uz">Тўлиқ маълумот</label>
                                    <textarea name="content_uz" id="content_uz" cols="30" rows="10" class="form-control textarea">{{$model->content_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_uz')}}</small>
                                </div>

                            </div>
                            {{---- ru ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">

                                <div class="form-group">
                                    <label for="name_ru">Имя</label>
                                    <input type="text" class="form-control" name="name_ru" value="{{$model->name_ru}}" placeholder="Имя">
                                    <small class="text-danger">{{$errors->first('name_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_ru">Краткая информация</label>
                                    <textarea name="description_ru" id="description_ru" cols="30" rows="5" class="form-control">{{$model->description_ru}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_ru">Полная информация</label>
                                    <textarea name="content_ru" id="content_ru" cols="30" rows="10" class="form-control textarea">{{$model->content_ru}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_ru')}}</small>
                                </div>

                            </div>
                            {{---- en ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">

                                <div class="form-group">
                                    <label for="name_en">Name</label>
                                    <input type="text" class="form-control" name="name_en" value="{{$model->name_en}}" placeholder="Name">
                                    <small class="text-danger">{{$errors->first('name_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_en">Brief information</label>
                                    <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control">{{$model->description_en}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_en">Full information</label>
                                    <textarea name="content_en" id="content_en" cols="30" rows="10" class="form-control textarea">{{$model->content_en}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_en')}}</small>
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
        $(document).ready(function (){
            let cancel = document.getElementsByClassName('image');
            // let selectFile = document.getElementsByName('image');
            $('#replace').click(function (){
                console.log('click')
            })
        })
    </script>
@endpush
