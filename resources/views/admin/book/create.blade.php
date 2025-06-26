@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kitoblar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('book.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Books</li>
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
                    <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{---- oz ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label for="category_id">Kategoriya</label>
                                    <select name="category_id" id="" class="form-control @error('category_id') border-danger @enderror">
                                        <option value="">----</option>
                                        @foreach($categories as $k=>$category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('category_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="author">Muallif</label>
                                    <input type="text" name="author_oz" class="form-control @error('author_oz') border-danger @enderror" value="{{old('author_oz')}}"
                                    placeholder="Muallif..."
                                    >
                                    <small class="text-danger">{{$errors->first('author_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="name_oz">Nomi</label>
                                    <input type="text" name="name_oz" class="form-control @error('name_oz') border-danger @enderror" value="{{old('name_oz')}}"
                                    placeholder="Nomi..."
                                    >
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="about_oz">Kitob haqida</label>
                                    <input type="text" name="about_oz" class="form-control @error('about_oz') border-danger @enderror" value="{{old('about_oz')}}"
                                    placeholder="Kiton haqida..."
                                    >
                                    <small class="text-danger">{{$errors->first('about_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Rasm</label>
                                    <input type="file" name="image" class="form-control @error('image') border-danger @enderror" accept="image/jpeg,png,jpg">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="file">Fayillar</label>
                                    <input type="file" name="file" class="form-control @error('file') border-danger @enderror" accept="application/pdf,doc">
                                    <small class="text-danger">{{$errors->first('file')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control @error('description_oz') border-danger @enderror"
                                    placeholder="Qisqacha ma'lumot..."
                                    >
                                        {{old('description_oz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="date">Sana</label>
                                    <input type="date" name="date" class="form-control @error('date') border-danger @enderror" value="{{old('date')}}"
                                    placeholder="Sana"
                                    >
                                    <small class="text-danger">{{$errors->first('date')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="2">No Active</option>
                                    </select>
                                </div>

                            </div>
                            {{---- uz ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label for="author_uz">Муаллиф</label>
                                    <input type="text" name="author_uz" class="form-control @error('author_uz') border-danger @enderror" value="{{old('author_uz')}}"
                                    placeholder="Муаллиф..."
                                    >
                                    <small class="text-danger">{{$errors->first('author_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="name_uz">Номи</label>
                                    <input type="text" name="name_uz" class="form-control @error('name_uz') border-danger @enderror" value="{{old('name_uz')}}"
                                    placeholder="Номи..."
                                    >
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="about_uz">Kitob haqida</label>
                                    <input type="text" name="about_uz" class="form-control @error('about_uz') border-danger @enderror" value="{{old('about_uz')}}"
                                           placeholder="Китоб ҳақида..."
                                    >
                                    <small class="text-danger">{{$errors->first('about_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумот</label>
                                    <textarea name="description_uz" id="description_uz" cols="30" rows="5" class="form-control @error('description_uz') border-danger @enderror">
                                        {{old('description_uz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                            </div>
                            {{---- ru ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-ru" role="tabpanel">
                                <div class="form-group">
                                    <label for="author_ru">Автор</label>
                                    <input type="text" name="author_ru" class="form-control @error('author_ru') border-danger @enderror" value="{{old('author_ru')}}"
                                           placeholder="Автор..."
                                    >
                                    <small class="text-danger">{{$errors->first('author_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="name_ru">Имя</label>
                                    <input type="text" name="name_ru" class="form-control @error('name_ru') border-danger @enderror" value="{{old('name_ru')}}"
                                           placeholder="Имя..."
                                    >
                                    <small class="text-danger">{{$errors->first('name_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="about_ru">О книге</label>
                                    <input type="text" name="about_ru" class="form-control @error('about_ru') border-danger @enderror" value="{{old('about_ru')}}"
                                           placeholder="О книге..."
                                    >
                                    <small class="text-danger">{{$errors->first('about_ru')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_ru">Краткая информация</label>
                                    <textarea name="description_ru" id="description_ru" cols="30" rows="5" class="form-control @error('description_ru') border-danger @enderror">
                                        {{old('description_ru')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_ru')}}</small>
                                </div>

                            </div>
                            {{---- en ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-en" role="tabpanel">
                                <div class="form-group">
                                    <label for="author_en">Author</label>
                                    <input type="text" name="author_en" class="form-control @error('author_en') border-danger @enderror" value="{{old('author_en')}}"
                                           placeholder="Author..."
                                    >
                                    <small class="text-danger">{{$errors->first('author_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="name_en">Name</label>
                                    <input type="text" name="name_en" class="form-control @error('name_en') border-danger @enderror" value="{{old('name_en')}}"
                                           placeholder="Name..."
                                    >
                                    <small class="text-danger">{{$errors->first('name_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="about_en">About the book</label>
                                    <input type="text" name="about_en" class="form-control @error('about_en') border-danger @enderror" value="{{old('about_en')}}"
                                           placeholder="About the book..."
                                    >
                                    <small class="text-danger">{{$errors->first('about_en')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_en">Brief information</label>
                                    <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control @error('description_en') border-danger @enderror">
                                        {{old('description_en')}}
                                    </textarea>
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
