@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h1>Premyera</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('film_digest.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Premiere</li>
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
            <div class="card card-outline card-info">
                <div class="card-body">
                    <form action="{{route('film_digest.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>Kategoriya</label>
                            <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option>----</option>
                                @foreach($categories as $category)
                                    @foreach($category->translates as $translate)
                                        <option value="{{$category->id}}">{{$translate->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            <small class="text-danger">{{$errors->first('premiere_category')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">Premyera nomi</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') border-danger @enderror">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="image">Rasm</label>
                            <input type="file" name="image" class="form-control @error('image') border-danger @enderror"
                                   accept="image/jpeg,png,jpg">
                            <small class="text-danger">{{$errors->first('image')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" class="form-control @error('video') border-danger @enderror" name="video" accept="video/mp4,video/webm,video/mov,video/avi">
                            <small class="text-danger">{{$errors->first('video')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Qisqacha ma'lumot</label>
                            <textarea name="description" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror"></textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="content">To'liq ma'lumot</label>
                            <textarea name="content"
                                      class="textarea form-control summernote @error('content') border-danger @enderror"
                                      id="summernote"></textarea>
                            <small class="text-danger">{{$errors->first('content')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="2">No Active</option>
                            </select>
                            <small class="text-danger">{{$errors->first('status')}}</small>
                        </div>

                        <div class="form-check">

                            <label>
                                <input type="checkbox" class="form-check-input" name="telegram_status" value="true">
                                Telegramga Yuborish
                            </label>
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
