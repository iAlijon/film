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
    <section class="content-header"></section>
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
                            <a class="nav-link disabled" id="custom-tabs-three-content-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="false" disabled="disabled">RU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="custom-tabs-three-body-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false" disabled="disabled">EN</a>
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
                                    <label for="analysis_category_id">Tahlil kategoriyasi</label>
                                    <select name="analysis_category_id" id="" class="form-control">
                                        <option value="">----</option>
                                        <option value="1" {{$model->analysis_category == 1?'selected':''}}>Milliy filmlar tahlili</option>
                                        <option value="2" {{$model->analysis_category == 2?'selected':''}}>Xorijiy filmlar tahlili</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('analysis_category_id')}}</small>
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
                                        <option value="0" {{$model->status == 0?'selected':''}}>No Active</option>
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
                                    <textarea name="description_uz" id="description_uz" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_uz">Тўлиқ маълумот</label>
                                    <textarea name="content_uz" id="content_uz" cols="30" rows="10" class="form-control textarea">{{$model->content_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_uz')}}</small>
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
