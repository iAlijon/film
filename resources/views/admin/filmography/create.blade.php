@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinokatalog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('filmography.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Kinokatalog</li>
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
                    <form action="{{route('filmography.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">

                                <div class="form-group required">
                                    <label for="">{{labels('category')}}</label>
                                    <select name="category_id" id="" class="form-control @error('category_id') border-danger @enderror">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">
                                                @foreach($category->translates as $item)
                                                    {{$item->name}}
                                                @endforeach
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group required">
                                    <label for="name">{{labels('name')}}</label>
                                    <input type="text" class="form-control @error('name') border-danger @enderror" name="name" value="{{old('name')}}" placeholder="Nomi">
                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="image">{{labels('image')}}</label>
                                    <input type="file" class="form-control @error('image') border-danger @enderror" name="image">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description">{{labels('description')}}</label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control @error('description') border-danger @enderror" placeholder="Qisqacha ma'lumot">
                                        {{old('description')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content">{{labels('content')}}</label>
                                    <textarea name="content" id="" cols="30" rows="10" class="form-control textarea @error('content') border-danger @enderror">
                                        {{old('content')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('content')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="date">Sana</label>
                                    <input type="text" class="form-control @error('date') border-danger @enderror" name="date" placeholder="Sana">
                                    <small class="text-danger"{{$errors->first('date')}}></small>
                                </div>

                                <div class="form-group required">
                                    <label for="status">{{labels('status')}}</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="2">No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">{{labels('order')}}</label>
                                    <input type="text" name="order" class="form-control" value="{{$order + 1}}">
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
