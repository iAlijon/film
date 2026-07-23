@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Afarizm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('aphorism.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Aphorism</li>
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
                    <form action="{{route('aphorism.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>{{labels('f.i.o')}}</label>
                            <input type="text" class="form-control @error('full_name') border-danger @enderror"
                                   name="full_name" value="{{$model->translations->first()?->full_name}}">
                            <small class="text-danger">{{$errors->first('full_name')}}</small>
                        </div>

                        <x-image-edit-field :image="$model->images" input-name="image" />

                        <div class="form-group">
                            <label>{{labels('description')}}</label>
                            <textarea name="description" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror">{{$model->translations->first()?->description}}</textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        @include('admin.components.ratio-fields', ['widthRatio' => $model->width_ratio ?? 16, 'heightRatio' => $model->height_ratio ?? 9])

                        <div class="form-group">
                            <label for="status">{{labels('status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                            <small class="text-danger">{{$errors->first('status')}}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control" value="{{$model->order}}">
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
