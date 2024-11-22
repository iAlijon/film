@extends('admin.layouts.admin')


@section('content')
    <section class="content-header"></section>
    <section class="content">
        <div class="col-11">
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
                    <form action="{{route('people_film.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{---- oz ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label></label>
                                    <select name="profession_id" class="form-control-sm form-control">
                                        <option value="">----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_oz}}</option>
                                        @endforeach

                                    </select>
                                    <small class="text-danger">{{$errors->first('profession_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>F.I.O (OZ)</label>
                                    <input type="text" name="full_name_oz" class="form-control form-control-sm" placeholder="F.I.O">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Rasm</label>
                                    <input type="file" class="form-control form-control-sm" name="images">
                                    <small class="text-danger">{{$errors->first('images')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Qisqacha ma'lumot (OZ)</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                    <small>{{$errors->first('description_oz')}}</small>
                                </div>
                            </div>
                            {{---- uz ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Ф.И.О (UZ)</label>
                                    <input type="text" name="full_name_oz" class="form-control form-control-sm" placeholder="F.I.O">
                                    <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Қисқача маълумот (UZ)</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                    <small>{{$errors->first('description_uz')}}</small>
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
