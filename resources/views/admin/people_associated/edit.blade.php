@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kino tegishli odamlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('people_film.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">People_film</li>
                    </ol>
                </div>
            </div>
        </div>
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
                     <form action="{{route('people_film.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                         @csrf
                         @method('PUT')
                         <div class="tab-content" id="custom-tabs-three-tabContent">
                             {{---- oz ----}}
                             <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                 <div class="form-group">
                                     <label>Kategoriya</label>
                                     <select name="profession_id" class="form-control">
                                         <option value="">----</option>
                                         @foreach($categories as $category)
                                             <option value="{{$category->id}}" {{$model->people_associated_with_the_film_category_id == $category->id?'selected':''}}>{{$category->name_oz}}</option>
                                         @endforeach

                                     </select>
                                     <small class="text-danger">{{$errors->first('profession_id')}}</small>
                                 </div>

                                 <div class="form-group">
                                     <label>F.I.O</label>
                                     <input type="text" name="full_name_oz" class="form-control" placeholder="F.I.O" value="{{$model->full_name_oz}}">
                                     <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                 </div>

                                 <div class="form-group">
                                     <label>Rasm</label>
                                     <input type="file" class="form-control" name="images">
                                     <small class="text-danger">{{$errors->first('images')}}</small>
                                 </div>

                                 <div class="form-group">
                                     <label>Qisqacha ma'lumot</label>
                                     <textarea name="description_oz" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                     <small>{{$errors->first('description_oz')}}</small>
                                 </div>
                             </div>
                             {{---- uz ----}}
                             <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                 <div class="form-group">
                                     <label>Ф.И.О</label>
                                     <input type="text" name="full_name_uz" class="form-control" placeholder="F.I.O" value="{{$model->full_name_uz}}">
                                     <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                 </div>

                                 <div class="form-group">
                                     <label>Қисқача маълумот</label>
                                     <textarea name="description_uz" cols="30" rows="5" class="form-control">{{$model->description_uz}}</textarea>
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
