@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rossom Qo'shish</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('portrait_artist.index')}}">home</a></li>
                        <li class="breadcrumb-item active">artist</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
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
                    <form action="{{route('portrait_artist.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label for="full_name_oz">F.I.O</label>
                                    <input type="text" name="full_name_oz" class="form-control" placeholder="F.I.O">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Rasm</label>
                                    <input type="file" class="form-control" name="image" accept="image/jpeg,.png,.jpg">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="birth_date">Tug'ulgan kun</label>
                                    <input type="date" class="form-control" name="birth_date">
                                    <small class="text-danger">{{$errors->first('birth_date')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control" placeholder="Qisqacha ma'lumot"></textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_oz">To'liq ma'lumot</label>
                                    <textarea name="content_oz" class="textarea form-control summernote w3-right-align" cols="30" rows="6" placeholder="To'liq ma'lumot"></textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">----</option>
                                        <option value="1" selected>Active</option>
                                        <option value="0">No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label for="full_name_uz">Ф.И.О</label>
                                    <input type="text" name="full_name_uz" class="form-control" placeholder="Ф.И.О">
                                    <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумот</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control" placeholder="Қисқача маълумот"></textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_uz">Тўлиқ маълумот</label>
                                    <textarea name="content_uz" class="textarea form-control summernote" cols="30" rows="6" placeholder="Тўлиқ маълумот"></textarea>
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