@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">

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
                    <form action="{{route('actor_conversation.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group">
                                    <label>Aktyorni tanlang</label>
                                    <select class="form-control form-control-sm" name="actor_id">
                                        <option value="">---</option>
                                        @foreach($actors as $actor)
                                            <option value="{{$actor->id}}">{{$actor->full_name_oz}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Suxbat nomi (OZ)</label>
                                    <input type="text" name="name_oz" class="form-control form-control-sm">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha mazmuni (OZ)</label>
                                    <textarea name="description_oz" id="" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>To'liq ma'mazmuni (OZ)</label>
                                    <textarea name="content_oz" class="textarea form-control summernote"
                                              id="summernote"></textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">---</option>
                                        <option value="1">Active</option>
                                        <option value="0">No active</option>
                                    </select>
                                </div>

                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Сухбат номи (UZ)</label>
                                    <input type="text" name="name_uz" class="form-control form-control-sm" placeholder="">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача мазмуни (UZ)</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Тўлиқ мазмуни (UZ)</label>
                                    <textarea name="content_uz" class="textarea form-control summernote"
                                              id="summernote"></textarea>
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
