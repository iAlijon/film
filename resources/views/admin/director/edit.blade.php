@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">

    </section>
    <section class="content">
        <div class="col-sm-12">
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
                    <form action="{{route('director.store')}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="tab-content " id="custom-tabs-three-tabContent">
                            {{------ oz ------}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label>F.I.O(OZ)</label>
                                    <input type="text" class="form-control" name="full_name_oz" value="{{$model->full_name_oz??''}}">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" name="images" accept="image/jpeg, image/jpg, image/png, image/gif">
                                    <small class="text-danger">{{$errors->first('images')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="birth-date">Date</label>
                                    <input type="date" class="form-control" name="birth-date" value="{{$model->birth_date??''}}">
                                    <small class="text-danger">{{$errors->first('birth-date')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Description(OZ)</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control">{{$model->description_oz??''}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Content(OZ)</label>
                                    <textarea name="content_oz" class="textarea form-control summernote" id="summernote">{{$model->content_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>
                            </div>
                            {{----- uz -----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Name(UZ)</label>
                                    <input type="text" class="form-control" name="full_name_uz" value="{{$model->full_name_uz??''}}">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Description(UZ)</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control">{{$model->description_uz??''}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Content(UZ)</label>
                                    <textarea name="content_uz" class="textarea form-control summernote" id="summernote">{{$model->content_uz??''}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_uz')}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success">&check;Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
