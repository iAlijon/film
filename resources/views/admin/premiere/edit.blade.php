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
                    <form action="{{route('film_digest.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>{{labels('category')}}</label>
                            <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option>----</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{$model->category_id == $category->id?'selected':''}}>
                                        {{$category->translates->first()?->name}}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{$errors->first('premiere_category')}}</small>
                        </div>


                        <div class="form-group">
                            <label for="name">{{labels('name')}}</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') border-danger @enderror"
                                   value="{{$model->translates->first()?->name}}">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <x-image-edit-field :image="$model->images" input-name="image" />

                        <div class="form-group">
                            <label for="description">{{labels('description')}}</label>
                            <textarea name="description" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror">{{$model->translates->first()?->description}}</textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="content">{{labels('content')}}</label>
                            <textarea name="content"
                                      class="textarea form-control summernote @error('content') border-danger @enderror"
                                      id="summernote">{{$model->translates->first()?->content}}</textarea>
                            <small class="text-danger">{{$errors->first('content')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="status">{{labels('status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                            <small class="text-danger">{{$errors->first('status')}}</small>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                   name="telegram_status" {{$model->telegram_status?'checked':''}}>
                            <label for="telegram_status">{{labels('telegram')}}</label>
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
