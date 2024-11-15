@extends('admin.layouts.admin')

@section('title', 'Yangilikni O\'zgartirish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yangilikni O'zgartirish</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-sm-12">
            <div class="card card-primary card-outline">
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
                    <form action="{{route('news.update', $model->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label>Yangiliklar kategoriyasi</label>
                                    <select name="new_category_id" class="form-control" id="new_category_id">
                                        <option>----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $model->category_id?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('new_category_id')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>Name(OZ)</label>
                                    <input type="text" class="form-control" name="name_oz" value="{{$model->name_oz}}">
                                </div>

                                <div class="form-group">
                                    <label>Rasm</label>
                                    @if($model->image)
                                        <div id="imageBox" style="width: 200px; height: 200px; margin-bottom: 30px">
                                            <img src="{{getInFolder($model->image, 'news')}}" alt="" style="width: 100%; height: 100%">
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
                                        <input type="file" class="form-control" name="images">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Qisqacha malumot (OZ)</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>To'liq malumot(OZ)</label>
                                    <textarea name="content_oz" class="textarea form-control summernote" id="summernote">{{$model->content_oz}}</textarea>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label>Holati</label>--}}
{{--                                    <select name="status" class="form-control form-control-sm">--}}
{{--                                        <option value="active" {{$model->status == 1?'selected':''}}>Active</option>--}}
{{--                                        <option value="no_active" {{$model->status == 0?'selected':''}}>No Active</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Name(UZ)</label>
                                    <input type="text" class="form-control" name="name_uz" value="{{$model->name_uz}}">
                                </div>

                                <div class="form-group">
                                    <label>Қисқача маълумот(UZ)</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control">{{$model->description_uz}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Тўлиқ маълумот(UZ)</label>
                                    <textarea name="content_uz" class="textarea form-control summernote" id="summernote">{{$model->content_uz}}</textarea>
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
