@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aktyorlar Qo'shish</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('actor.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Aktyorlar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mb-5">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="true">O'Z</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false">UZ</a>
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
                    <form action="{{route('actor.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group">
                                    <label>F.I.O (OZ)</label>
                                    <input type="text" name="full_name_oz" class="form-control form-control-sm" placeholder="F.I.O">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Rasm</label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumoq (OZ)</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Ф.И.О (UZ)</label>
                                    <input type="text" name="full_name_uz" class="form-control form-control-sm" placeholder="F.I.O">
                                    <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумот (UZ)</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control form-control-sm"></textarea>
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
