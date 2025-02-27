@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yulduzlar Bilan Interviyu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('interview_peoples.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Stars With Interview</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
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
                                        @if(str_contains($error, 'oz'))
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
                                        @if(str_contains($error, 'uz'))
                                            <div class="line"></div>
                                        @endif
                                    @endforeach
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="custom-tabs-three-content-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="false" disabled="disabled">RU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="custom-tabs-three-body-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false" disabled="disabled">EN</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{route('interview_peoples.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label>Kategoriya Nomi</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') border-danger @enderror">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('category_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="full_name_oz">F.I.O</label>
                                    <input type="text" name="full_name_oz" class="form-control @error('full_name_oz') border-danger @enderror" value="{{old('full_name_oz')}}">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Rasim</label>
                                    <input type="file" name="image" class="form-control @error('image') border-danger @enderror">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5"
                                              class="form-control @error('description_oz') border-danger @enderror"
                                              >{{old('description_oz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="2">No Active</option>
                                    </select>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Ф.И.О</label>
                                    <input type="text" class="form-control @error('full_name_uz') border-danger @enderror" name="full_name_uz" value="{{old('full_name_oz')}}">
                                    <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумот</label>
                                    <textarea name="description_uz" id="" cols="30" rows="5" class="form-control @error('description_uz') border-danger @enderror"
                                     >{{old('description_uz')}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
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
