@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">

    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            <div class="card card-outline card-info">
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
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @elseif(session()->has('errors'))
                        <div class="alert alert-danger">
                            {{session()->get('errors')}}
                        </div>
                    @endif
                    <form action="{{route('rejissor.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group">
                                    <label>Rejissorni tanlang</label>
                                    <select class="form-control form-control-sm" name="director_id">
                                        <option value="">---</option>
                                        @foreach($directors as $director)
                                            <option value="{{$director->id}}" {{$model->people_film_category_id == $director->id?'selected':''}}>
                                                {{$director->full_name_oz}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Suxbat nomi (OZ)</label>
                                    <input type="text" name="name_oz" class="form-control form-control-sm" value="{{$model->name_oz}}">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha mazmuni (OZ)</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control form-control-sm"
                                    >{{$model->description_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>To'liq ma'mazmuni (OZ)</label>
                                    <textarea name="content_oz" class="textarea form-control summernote"
                                              id="summernote">{{$model->content_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">---</option>
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="0" {{$model->status == 0?'selected':''}}>No active</option>
                                    </select>
                                </div>

                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Сухбат номи (UZ)</label>
                                    <input type="text" name="name_uz" class="form-control form-control-sm" placeholder="" value="{{$model->name_uz}}">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача мазмуни (UZ)</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control form-control-sm">
                                        {{$model->description_uz}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Тўлиқ мазмуни (UZ)</label>
                                    <textarea name="content_uz" class="textarea form-control summernote"
                                              id="summernote">{{$model->content_uz }}</textarea>
                                    <small class="text-danger">{{$errors->first('content_uz')}}</small>
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
