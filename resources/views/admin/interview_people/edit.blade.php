@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yulduzlar Bilan Interviyu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('interview_peoples.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Stars With Interview</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
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
                               aria-selected="true">O'Z
                                @if($errors->any() == '*_oz')
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="line"></div>
                                        @endforeach
                                    @endif
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false">UZ
                                @if($errors->any() == '*_uz')
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="line"></div>
                                        @endforeach
                                    @endif
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-ru-tab" data-toggle="pill"
                               href="#custom-tabs-three-ru" role="tab" aria-controls="custom-tabs-three-ru"
                               aria-selected="false">RU
                                @if($errors->any() == '*_ru')
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="line"></div>
                                        @endforeach
                                    @endif
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-en-tab" data-toggle="pill"
                               href="#custom-tabs-three-en" role="tab" aria-controls="custom-tabs-three-en"
                               aria-selected="false">EN</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{route('interview_peoples.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label>Kategoriya Nomi</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$model->category_id == $category->id?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('category_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="full_name_oz">F.I.O</label>
                                    <input type="text" name="full_name_oz" class="form-control" value="{{$model->full_name_oz}}">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Rasim</label>
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                                    </select>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Ф.И.О</label>
                                    <input type="text" class="form-control" name="full_name_uz" value="{{$model->full_name_uz}}">
                                    <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумот</label>
                                    <textarea name="description_uz" id="" cols="30" rows="5" class="form-control">{{$model->description_uz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>
                            </div>
                            {{----  ru  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">
                                <div class="form-group">
                                    <label>Ф.И.О</label>
                                    <input type="text" class="form-control" name="full_name_ru" value="{{$model->full_name_ru}}">
                                    <small class="text-danger">{{$errors->first('full_name_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_ru">Краткая информация</label>
                                    <textarea name="description_ru" id="" cols="30" rows="5" class="form-control">{{$model->description_ru}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_ru')}}</small>
                                </div>
                            </div>
                            {{----  en  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-en" role="tabpanel">
                                <div class="form-group">
                                    <label>F.I.О</label>
                                    <input type="text" class="form-control" name="full_name_en" value="{{$model->full_name_en}}">
                                    <small class="text-danger">{{$errors->first('full_name_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_en">Brief information</label>
                                    <textarea name="description_en" id="" cols="30" rows="5" class="form-control">{{$model->description_en}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_en')}}</small>
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
