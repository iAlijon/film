@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinomutolaa</h1>
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
            <div class="card card-outline card-info">
                <div class="card-body">
                    <form action="{{route('book.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>{{labels('category')}}</label>
                            <select name="category_id" id=""
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option value="">----</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $model->category_id ? 'selected' : ''}}>
                                        @foreach($category->translates as $item)
                                            {{$item->name}}
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{$errors->first('book_category')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="author">{{labels('author')}}</label>
                            <input type="text" name="author"
                                   class="form-control @error('author') border-danger @enderror"
                                   value="{{$model->translates->first()?->author}}"
                                   placeholder="Muallif..."
                            >
                            <small class="text-danger">{{$errors->first('author')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">{{labels('name')}}</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') border-danger @enderror"
                                   value="{{$model->translates->first()?->name}}">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="about">{{labels('book')}}</label>
                            <input type="text" name="about"
                                   class="form-control @error('about') border-danger @enderror"
                                   value="{{$model->translates->first()?->about}}"
                                   placeholder="Kiton haqida..."
                            >
                            <small class="text-danger">{{$errors->first('about')}}</small>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="image">{{labels('image')}}</label>--}}
{{--                            <input type="file" name="image" class="form-control @error('image') border-danger @enderror"--}}
{{--                                   accept="image/jpeg,png,jpg">--}}
{{--                            <small class="text-danger">{{$errors->first('image')}}</small>--}}
{{--                        </div>--}}

                        <x-image-edit-field :image="$model->translates->first()?->images" input-name="image" />

                        <div class="form-group">
                            <label for="file">{{labels('file')}}</label>
                            <input type="file" name="file" class="form-control @error('file') border-danger @enderror" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf">
                            <small class="text-danger">{{$errors->first('file')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="description">{{labels('description')}}</label>
                            <textarea name="description" id="" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror">{{$model->translates->first()?->description}}</textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="date">{{labels('date')}}</label>
                            <input type="date" name="date" class="form-control" value="{{$model->translates->first()?->date}}">
                            <small class="text-danger">{{$errors->first('date')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="order">{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control @error('order') border-danger @enderror" value="{{$model->order}}">
                            <small class="text-danger">{{$errors->first('order')}}</small>
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
