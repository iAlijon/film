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
            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label for="category_id">{{labels('category')}}</label>
                            <select name="category_id" id=""
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option value="">----</option>
                                @foreach($categories as $k=>$category)
                                    <option value="{{$category->id}}">
                                        @foreach($category->translates as $item)
                                        {{$item->name}}
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{$errors->first('category_id')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="author">{{labels('author')}}</label>
                            <input type="text" name="author"
                                   class="form-control @error('author') border-danger @enderror"
                                   value="{{old('author')}}"
                                   placeholder="Muallif..."
                            >
                            <small class="text-danger">{{$errors->first('author')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">{{labels('name')}}</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') border-danger @enderror"
                                   value="{{old('name')}}"
                                   placeholder="Nomi..."
                            >
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="about">{{labels('book')}}</label>
                            <input type="text" name="about"
                                   class="form-control @error('about') border-danger @enderror"
                                   value="{{old('about')}}"
                                   placeholder="Kiton haqida..."
                            >
                            <small class="text-danger">{{$errors->first('about')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="image">{{labels('image')}}</label>
                            <input type="file" name="image" class="form-control @error('image') border-danger @enderror"
                                   accept="image/jpeg,png,jpg">
                            <small class="text-danger">{{$errors->first('image')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="file">{{labels('file')}}</label>
                            <input type="file" name="file" class="form-control @error('file') border-danger @enderror"
                                   accept="application/pdf,doc">
                            <small class="text-danger">{{$errors->first('file')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="description">{{labels('description')}}</label>
                            <textarea name="description" id="" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror"
                                      placeholder="Qisqacha ma'lumot..."
                            >
                                        {{old('description')}}
                                    </textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="date">{{labels('book_date')}}</label>
                            <input type="date" name="date" class="form-control @error('date') border-danger @enderror"
                                   value="{{old('date')}}"
                                   placeholder="Sana"
                            >
                            <small class="text-danger">{{$errors->first('date')}}</small>
                        </div>

                        @include('admin.components.ratio-fields')

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="2">No Active</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="order">{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control">
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
