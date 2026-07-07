@extends('admin.layouts.admin')


@section('title', 'Calendar')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kalendar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('calendar.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Kalendar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">

            @if(session()->has('error'))
                <div class="alert alert-danger" id="close">
                    {{ session()->get('error') }}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif

            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{ route('calendar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">

                        <div class="form-group">
                            <label for="date">Sana</label>
                            <input type="text" name="date" class="form-control" placeholder="Sana">
                            <small class="text-danger">{{$errors->first('date')}}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('description')}}</label>
                            <textarea name="description" rows="5"
                                      class="form-control @error('description') border-danger @enderror"
                                      placeholder="{{labels('description')}}">{{ old('description') }}</textarea>
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('status')}}</label>
                            <select name="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="2">No Active</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control" value="{{$order}}">
                        </div>

                        <br>
                        <div class="text-right mt-3">
                            <button class="btn btn-success">&check; Saqlash</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
