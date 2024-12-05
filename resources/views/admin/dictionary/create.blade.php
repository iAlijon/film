@extends('admin.layouts.admin')


@push('css')
{{--    <style>--}}
{{--        @import url(https://fonts.googleapis.com/css?family=Lato:900);--}}
{{--        *, *:before, *:after{--}}
{{--            box-sizing:border-box;--}}
{{--        }--}}
{{--        body{--}}
{{--            font-family: 'Lato', sans-serif;--}}
{{--        }--}}
{{--        div.foo{--}}
{{--            width: 90%;--}}
{{--            margin: 0 auto;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .letter{--}}
{{--            display: inline-block;--}}
{{--            font-weight: 900;--}}
{{--            font-size: 4em;--}}
{{--            margin: 0.2em;--}}
{{--            position: relative;--}}
{{--            color: #00B4F1;--}}
{{--            transform-style: preserve-3d;--}}
{{--            perspective: 400;--}}
{{--            z-index: 1;--}}
{{--        }--}}
{{--        .letter:before, .letter:after{--}}
{{--            position:absolute;--}}
{{--            content: attr(data-letter);--}}
{{--            transform-origin: top left;--}}
{{--            top:0;--}}
{{--            left:0;--}}
{{--        }--}}
{{--        .letter, .letter:before, .letter:after{--}}
{{--            transition: all 0.3s ease-in-out;--}}
{{--        }--}}
{{--        .letter:before{--}}
{{--            color: #fff;--}}
{{--            text-shadow:--}}
{{--                -1px 0px 1px rgba(255,255,255,.8),--}}
{{--                1px 0px 1px rgba(0,0,0,.8);--}}
{{--            z-index: 3;--}}
{{--            transform:--}}
{{--                rotateX(0deg)--}}
{{--                rotateY(-15deg)--}}
{{--                rotateZ(0deg);--}}
{{--        }--}}
{{--        .letter:after{--}}
{{--            color: rgba(0,0,0,.11);--}}
{{--            z-index:2;--}}
{{--            transform:--}}
{{--                scale(1.08,1)--}}
{{--                rotateX(0deg)--}}
{{--                rotateY(0deg)--}}
{{--                rotateZ(0deg)--}}
{{--                skew(0deg,1deg);--}}
{{--        }--}}
{{--        .letter:hover:before{--}}
{{--            color: #fafafa;--}}
{{--            transform:--}}
{{--                rotateX(0deg)--}}
{{--                rotateY(-40deg)--}}
{{--                rotateZ(0deg);--}}
{{--        }--}}
{{--        .letter:hover:after{--}}
{{--            transform:--}}
{{--                scale(1.08,1)--}}
{{--                rotateX(0deg)--}}
{{--                rotateY(40deg)--}}
{{--                rotateZ(0deg)--}}
{{--                skew(0deg,22deg);--}}
{{--        }--}}
{{--    </style>--}}
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
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div>
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
                    <form action="{{route('film_dictionary.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label for="dictionary_id">Lug'at</label>
                                    <select name="dictionary_id[]"  multiple="multiple" class="select2 form-control" data-placeholder="Lug'atni tanlang">
                                        @foreach($dictionaries as $dictionary)
                                            <option value="{{$dictionary->id}}">{{json_decode($dictionary->oz)->upper}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('dictionary_id')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="name_oz">Name</label>
                                    <input type="text" class="form-control" name="name_oz">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="images">Rasm</label>
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-danger">{{$errors->first('image')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_oz">Qisqacha ma'lumoti</label>
                                    <textarea name="description_oz" class="form-control" cols="30" rows="5"></textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_oz">To'liq ma'lumot</label>
                                    <textarea name="content_oz" id="content_oz" cols="30" rows="10" class="form-control textarea"></textarea>
                                    <small class="text-danger">{{$errors->first('content_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">No Active</option>
                                    </select>
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
{{--                                <div class="form-group">--}}
{{--                                    <label for="dictionary_id">Луғат</label>--}}
{{--                                    <select name="dictionary_id"  multiple="multiple" class="select2 form-control" data-placeholder="Луғатни танланг">--}}
{{--                                        @foreach($dictionaries as $dictionary)--}}
{{--                                            <option value="{{$dictionary->id}}">{{json_decode($dictionary->ru)->upper}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <small class="text-danger">{{$errors->first('dictionary_id')}}</small>--}}
{{--                                </div>--}}

                                <div class="form-group">
                                    <label for="name_uz">Номи</label>
                                    <input type="text" class="form-control" name="name_uz">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz">Қисқача маълумоти</label>
                                    <textarea name="description_uz" id="description_uz" class="form-control" cols="30" rows="5"></textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="content_uz">Тўлиқ маълумот</label>
                                    <textarea name="content_uz" id="content_uz" cols="30" rows="10" class="form-control textarea"></textarea>
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
