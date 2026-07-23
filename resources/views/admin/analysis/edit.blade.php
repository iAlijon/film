@extends('admin.layouts.admin')

@push('css')
    <style>
        .images img{
            width: 250px;
            height: 250px;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinotashxis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('film_analysis.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Kinotashxis</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{session()->get('error')}}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{route('film_analysis.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label for="category_id">{{labels('category')}}</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">----</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{$model->category_id == $category->id?'selected':''}}>
                                        @foreach($category->translates as $item)
                                        {{$item->name}}
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{$errors->first('category_id')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">{{labels('name')}}</label>
                            <input type="text" class="form-control" name="name" value="{{$model->translates->first()?->name}}">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <x-image-edit-field :image="$model->images" input-name="image" />

                        <div class="form-group">
                            <label for="description">{{labels('description')}}</label>
                            <textarea name="description" id="" cols="30" rows="5"
                                      class="form-control">{{$model->translates->first()?->description}}</textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="content">{{labels('content')}}</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control textarea">{{$model->translates->first()?->content}}</textarea>
                            <small class="text-danger">{{$errors->first('content')}}</small>
                        </div>

                        @include('admin.components.ratio-fields', ['widthRatio' => $model->width_ratio ?? 16, 'heightRatio' => $model->height_ratio ?? 9])

                        <div class="form-group">
                            <label for="status">{{labels('status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">{{labels('order')}}</label>
                            <input type="text" class="form-control" name="order" value="{{$model->order}}">
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

@push('js')

@endpush
