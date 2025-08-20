@extends('admin.layouts.admin')

@section('title', 'Yangililar qo\'shish')

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
            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{session()->get('error')}}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
            <div class="card card-primary card-outline" >
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
                    <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label>Yangiliklar kategoriyasi</label>
                                    <select name="category_id" class="form-control @error('category_id') border-danger @enderror" id="category_id">
                                        <option>----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('new_category_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Nomi</label>
                                    <input type="text" class="form-control @error('name_oz') border-danger @enderror" name="name_oz" placeholder="Nomi">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Rasm</label>
                                    <input type="file" class="form-control @error('images') border-danger @enderror" name="images" required accept="image/jpeg,png,jpg">
                                    <small class="text-danger">{{$errors->first('images')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control @error('description_oz') border-danger @enderror" placeholder="Qisqacha ma'lumot"></textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>To'liq ma'lumot</label>
                                    <textarea name="content_oz" class="textarea form-control summernote @error('content_oz') border-danger @enderror" id="summernote" placeholder="To'liq ma'lumot"></textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="1" selected>Active</option>
                                        <option value="0">No Active</option>
                                    </select>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Номи</label>
                                    <input type="text" class="form-control @error('name_uz') border-danger @enderror" name="name_uz" placeholder="Номи">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Қисқача маълумот</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control @error('description_uz') border-danger @enderror" placeholder="Қисқача маълумот"></textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Тўлиқ маълумот</label>
                                    <textarea name="content_uz" class="textarea form-control summernote @error('content_uz') border-danger @enderror" id="summernote" placeholder="Тўлиқ маълумот"></textarea>
                                    <small class="text-danger">{{$errors->first('content_uz')}}</small>
                                </div>
                            </div>
                            {{----  ru  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">
                                <div class="form-group">
                                    <label>Имя</label>
                                    <input type="text" class="form-control @error('name_ru') border-danger @enderror" name="name_ru" placeholder="Имя">
                                    <small class="text-danger">{{$errors->first('name_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Краткая информация</label>
                                    <textarea name="description_ru" cols="30" rows="5" class="form-control @error('description_ru') border-danger @enderror" placeholder="Краткая информация"></textarea>
                                    <small class="text-danger">{{$errors->first('description_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Полная информация</label>
                                    <textarea name="content_ru" class="textarea form-control summernote @error('content_ru') border-danger @enderror" id="summernote" placeholder="Полная информация"></textarea>
                                    <small class="text-danger">{{$errors->first('content_ru')}}</small>
                                </div>
                            </div>
                            {{----  en  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-en" role="tabpanel">
                                <div class="form-group">
                                    <label>Имя</label>
                                    <input type="text" class="form-control @error('name_en') border-danger @enderror" name="name_en" placeholder="Имя">
                                    <small class="text-danger">{{$errors->first('name_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Краткая информация</label>
                                    <textarea name="description_en" cols="30" rows="5" class="form-control @error('description_en') border-danger @enderror" placeholder="Краткая информация"></textarea>
                                    <small class="text-danger">{{$errors->first('description_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Полная информация</label>
                                    <textarea name="content_en" class="textarea form-control summernote @error('content_en') border-danger @enderror" id="summernote" placeholder="Полная информация"></textarea>
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

@endpush
