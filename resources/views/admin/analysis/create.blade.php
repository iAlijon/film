@extends('admin.layouts.admin')

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
                    <form action="{{route('film_analysis.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label for="category_id">Tahlil kategoriyasi</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">---</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{request('category_id') == $category->id?'selected':''}}>
                                        @foreach($category->translates as $item)
                                        {{$item->name}}
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{$errors->first('analysis_category_id')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">{{labels('name')}}</label>
                            <input type="text" class="form-control @error('name') border-danger @enderror"
                                   name="name">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="image">{{labels('image')}}</label>
                            <input type="file" class="form-control @error('image') border-danger @enderror" name="image"
                                   accept="image/jpeg,png,jpg">
                            <small class="text-danger">{{$errors->first('image')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="description">{{labels('description')}}</label>
                            <textarea name="description" id="" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror"></textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="content">{{labels('content')}}</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control textarea @error('content') border-danger @enderror"></textarea>
                            <small class="text-danger">{{$errors->first('content')}}</small>
                        </div>

                        @include('admin.components.ratio-fields')

                        <div class="form-group">
                            <label for="status">{{labels('status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="2">No Active</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <label>
                                <input type="checkbox" class="form-check-input" value="true" name="telegram_status">
                                Telegramga Yuborish
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="">{{labels('order')}}</label>
                            <input type="text" class="form-control" name="order" value="{{$order + 1}}">
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
