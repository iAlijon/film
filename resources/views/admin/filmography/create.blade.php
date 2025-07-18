@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Filmografiya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('filmography.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Filmography</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger" id="close">
                    {{session()->get('error')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-info card-outline">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="true">O'Z
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        @if(str_contains($error,'oz'))
                                            <div class="line"></div>
                                        @endif
                                    @endforeach
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false">UZ
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        @if(str_contains($error,'uz'))
                                            <div class="line"></div>
                                        @endif
                                    @endforeach
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-ru-tab" data-toggle="pill"
                               href="#custom-tabs-three-ru" role="tab" aria-controls="custom-tabs-three-ru"
                               aria-selected="false">RU
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        @if(str_contains($error,'ru'))
                                            <div class="line"></div>
                                        @endif
                                    @endforeach
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-en-tab" data-toggle="pill"
                               href="#custom-tabs-three-en" role="tab" aria-controls="custom-tabs-three-en"
                               aria-selected="false">EN
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        @if(str_contains($error,'en'))
                                            <div class="line"></div>
                                        @endif
                                    @endforeach
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{route('filmography.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group required">
                                    <label for="">Mazular</label>
                                    <select name="category_id" id="" class="form-control @error('category_id') border-danger @enderror">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group required">
                                    <label for="name_oz">Nomi</label>
                                    <input type="text" class="form-control @error('name_oz') border-danger @enderror" name="name_oz" value="{{old('name_oz')}}">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="image">Rasm</label>
                                    <input type="file" class="form-control @error('image') border-danger @enderror" name="image">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description_oz">Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control @error('description_oz') border-danger @enderror">
                                        {{old('description_oz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content_oz">To'liq ma'lumot</label>
                                    <textarea name="content_oz" id="" cols="30" rows="10" class="form-control textarea @error('content_oz') border-danger @enderror">
                                        {{old('content_oz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="status">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="2">No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">

                                <div class="form-group required">
                                    <label for="name_uz">Номи</label>
                                    <input type="text" class="form-control @error('name_uz') border-danger @enderror" name="name_uz" value="{{old('name_uz')}}">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description_uz">Қисқача маълумот</label>
                                    <textarea name="description_uz" id="" cols="30" rows="5" class="form-control @error('description_uz') border-danger @enderror">
                                        {{old('description_uz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content_uz">Тўлиқ маълумот</label>
                                    <textarea name="content_uz" id="" cols="30" rows="10" class="form-control textarea @error('content_uz') border-danger @enderror">
                                        {{old('content_uz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('content_uz')}}</small>
                                </div>
                            </div>
                            {{----  ru  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">

                                <div class="form-group required">
                                    <label for="name_ru">Имя</label>
                                    <input type="text" class="form-control @error('name_ru') border-danger @enderror" name="name_ru" value="{{old('name_ru')}}" placeholder="Имя">
                                    <small class="text-danger">{{$errors->first('name_ru')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description_ru">Краткая информация</label>
                                    <textarea name="description_ru" id="" cols="30" rows="5" class="form-control @error('description_ru') border-danger @enderror">
                                        {{old('description_ru')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_ru')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content_ru">Полная информация</label>
                                    <textarea name="content_ru" id="" cols="30" rows="10" class="form-control textarea @error('content_ru') border-danger @enderror">
                                        {{old('content_ru')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('content_ru')}}</small>
                                </div>
                            </div>
                            {{----  en  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-en" role="tabpanel">

                                <div class="form-group required">
                                    <label for="name_en">Name</label>
                                    <input type="text" class="form-control @error('name_en') border-danger @enderror" name="name_en" value="{{old('name_en')}}">
                                    <small class="text-danger">{{$errors->first('name_en')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description_en">Brief information</label>
                                    <textarea name="description_en" id="" cols="30" rows="5" class="form-control @error('description_en') border-danger @enderror">
                                        {{old('description_en')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_en')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content_en">Full information</label>
                                    <textarea name="content_en" id="" cols="30" rows="10" class="form-control textarea @error('content_en') border-danger @enderror">
                                        {{old('content_en')}}
                                    </textarea>
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
