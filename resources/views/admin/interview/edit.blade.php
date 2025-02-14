@extends('admin.layouts.admin')

@section('title', 'Intervyu qo\'shish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Intervyu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('interview.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Interview</li>
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
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
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
                    <form action="{{route('interview.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group">
                                    <label for="">Kategoriya</label>
                                    <select name="category_id" id="category_id"8
                                            class="form-control">
                                        <option value="">---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $model->category_id?'selected':''}}>{{$category->name_oz}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">F.I.O</label>
                                    <select name="interview_people_id" id="interview_people_id" class="form-control">
                                        <option value="">---</option>
                                        @foreach($peoples as $people)
                                            <option value="{{$people->id}}" {{$people->id == $model->interview_people_id?'selected':''}}>{{$people->full_name_oz}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nomi</label>
                                    <input type="text" class="form-control" name="interview_oz" value="{{$model->interview_oz}}">
                                    <small class="text-danger">{{$errors->first('interview_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>To'liq ma'lumot</label>
                                    <textarea name="content_oz" class="textarea form-control summernote"
                                              id="summernote">{{$model->content_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="0" {{$model->status == 0?'selected':''}}>No Active</option>
                                    </select>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Номи</label>
                                    <input type="text" class="form-control" name="interview_uz"  value="{{$model->interview_uz}}">
                                    <small class="text-danger">{{$errors->first('interview_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Қисқача маълумот</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control">{{$model->description_uz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Тўлиқ маълумот</label>
                                    <textarea name="content_uz" class="textarea form-control summernote"
                                              id="summernote">{{$model->content_uz}}</textarea>
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

@push('js')
    <script>
        $(document).ready(function () {
            $('#category_id').on('change', function () {
                let category_id = $(this).val();
                let interview_people_id = $('#interview_people_id')
                $.ajax({
                    url: '{{ route("interview-status") }}',
                    type: 'GET',
                    data: {category_id: category_id},
                    success: function (data) {
                        $('#interview_people_id').empty(); // Eski sub-kategoriyalarni o'chirish
                        $('#interview_people_id').append('<option>---</option>');
                        $.each(data, function (key, city) {
                            interview_people_id.append(`<option value="${city.id}">${city.full_name_oz}</option>`);
                        });
                    }
                });
            })
        });
    </script>
@endpush
