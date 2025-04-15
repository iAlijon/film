@extends('admin.layouts.admin')

@push('css')
    <style>
        .alert-danger {
            color: #721c24 !important;
            background-color: #f8d7da !important;
            border-color: #f5c6cb !important;
        }
        .cancel {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            font-size: 20px;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinolug'at Qo'shish</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('film_dictionary.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Film Dictionary</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{session()->get('error')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-outline card-info">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="true">O'Z
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        @if(str_contains($error,'oz'))
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
                                        @if(str_contains($error,'uz'))
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
                    <form action="{{route('film_dictionary.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group required">
                                    <label for="dictionary_id">
                                        <p data-toggle="popover"
                                           data-content="Kerakli beligni topa olamasangiz Kirilchadan qdirib ko'ring faqat bir tildagsni tanlang"
                                           class="mb-0">Lug'at</p>
                                    </label>
                                    <select name="dictionary_id[]" id="dictionary" multiple="multiple"
                                            class="select2 form-control @error('dictionary_id[]') border-danger @enderror" data-placeholder="Lug'atni tanlang">
                                        @foreach($letters['data'] as $letter)
                                            <option
                                                value="{{$letter['id']}}">{{$letter['name']}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('dictionary_id')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="name_oz">Nomi</label>
                                    <input type="text" class="form-control @error('name_oz') border-danger @enderror" name="name_oz" required placeholder="Nomi" value="{{old('name_oz')}}">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="images">Rasm</label>
                                    <input type="file" name="image" class="form-control @error('image') border-danger @enderror" value="{{old('image')}}">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description_oz">Qisqacha ma'lumoti</label>
                                    <textarea name="description_oz" class="form-control @error('description_oz') border-danger @enderror" cols="30" rows="5" required
                                              placeholder="Qisqacha ma'lumot">{{old('description_oz')}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content_oz">To'liq ma'lumot</label>
                                    <textarea name="content_oz" id="content_oz" cols="30" rows="10"
                                              class="form-control textarea @error('content_oz') border-danger @enderror" required
                                              placeholder="To'liq ma'lumot">{{old('content_oz')}}</textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1" selected>Active</option>
                                        <option value="2">No Active</option>
                                    </select>
                                </div>

                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">

                                <div class="form-group required">
                                    <label for="name_uz">Номи</label>
                                    <input type="text" class="form-control @error('name_uz') border-danger @enderror" name="name_uz" required placeholder="Номи" value="{{old('name_uz')}}">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="description_uz">Қисқача маълумоти</label>
                                    <textarea name="description_uz" id="description_uz" class="form-control @error('description_uz') border-danger @enderror" cols="30"
                                              rows="5" required placeholder="Қисқача маълумоти">{{old('description_uz')}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group required">
                                    <label for="content_uz">Тўлиқ маълумот</label>
                                    <textarea name="content_uz" id="content_uz" cols="30" rows="10"
                                              class="form-control textarea @error('content_uz') border-danger @enderror" required>{{old('content_uz')}}</textarea>
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
            $('#dictionary').on('select2:select', function (e){
                let selected = e.params.data.id;
                // let dictionary = document.getElementById('dictionary').value;
                console.log(e.params);
                if (selected){
                    $(`#dictionary option[value="${selected}"]`).prop('disabled', true);
                }else {
                    $(`#dictionary option[value="${selected}"]`).prop('disabled', false);
                }
                $('#dictionary').select2();
            })
        })
    </script>
@endpush
