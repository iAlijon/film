@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kinogid</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('kino_gid.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Kinogid</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger" id="close">
                    {{session()->get('error')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-outline card-info">
                <div class="card-body">
                    <form action="{{route('kino_gid.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="translates" value="{{request('translates','oz')}}">
                        <div class="form-group required">
                            <label for="">{{labels('category')}}</label>
                            <select name="category_id" id=""
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option value="">---</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{$category->id == $model->category_id?'selected':''}}>
                                        @foreach($category->translates as $item)
                                            {{$item->name}}
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group required">
                            <label for="creatorRoles">Ijodkor</label>
                            @if($translates == 'oz')
                                <select name="creatorRoles" id="" class="form-control">
                                    <option value="">---</option>
                                    <option value="rejissor" {{$model->translates->first()?->creatorRoles == 'rejissor' ? 'selected' : ''}}>Rejissor</option>
                                    <option value="ssenariynavis" {{$model->translates->first()?->creatorRoles == 'ssenariynavis' ? 'selected' : ''}}>Ssenariynavis</option>
                                    <option value="operator" {{$model->translates->first()?->creatorRoles == 'operator' ? 'selected' : ''}}>Operator</option>
                                    <option value="rassom" {{$model->translates->first()?->creatorRoles == 'rassom' ? 'selected' : ''}}>Rassom</option>
                                    <option value="bastakor" {{$model->translates->first()?->creatorRoles == 'bastakor' ? 'selected' : ''}}>Bastakor</option>
                                    <option value="boshqa_ijodkorlar" {{$model->translates->first()?->creatorRoles == 'boshqa_ijodkorlar' ? 'selected' : ''}}>Boshqa ijodkorlar</option>
                                </select>
                            @else
                                <select name="creatorRoles" id="" class="form-control">
                                    <option value="">---</option>
                                    <option value="rejissor" {{$model->translates->first()?->creatorRoles == 'rejissor' ? 'selected' : ''}}>Режиссор</option>
                                    <option value="ssenariynavis" {{$model->translates->first()?->creatorRoles == 'ssenariynavis' ? 'selected' : ''}}>Ссенарийнавис</option>
                                    <option value="operator" {{$model->translates->first()?->creatorRoles == 'operator' ? 'selected' : ''}}>Оператор</option>
                                    <option value="rassom" {{$model->translates->first()?->creatorRoles == 'rassom' ? 'selected' : ''}}>Рассом</option>
                                    <option value="bastakor" {{$model->translates->first()?->creatorRoles == 'bastakor' ? 'selected' : ''}}>Бастакор</option>
                                    <option value="boshqa_ijodkorlar" {{$model->translates->first()?->creatorRoles == 'boshqa_ijodkorlar' ? 'selected' : ''}}>Бошқа ижодкорлар</option>
                                </select>
                            @endif
                        </div>

                        <div class="form-group required">
                            <label for="name">{{labels('name')}}</label>
                            <input type="text" class="form-control @error('name') border-danger @enderror" name="name"
                                   value="{{$model->translates->first()?->name}}">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <x-image-edit-field :image="$model->translates->first()?->image" input-name="image" />

                        <div class="form-group required">
                            <label for="description">{{labels('description')}}</label>
                            <textarea name="description" id="" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror">{{$model->translates->first()?->description}}</textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        <div class="form-group required">
                            <label for="content">{{labels('content')}}t</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control textarea @error('content') border-danger @enderror">{{$model->translates->first()?->content}}</textarea>
                            <small class="text-danger">{{$errors->first('content')}}</small>
                        </div>

                        <div class="form-group required">
                            <label for="status">{{labels('status')}}</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                            <small class="text-danger">{{$errors->first('status')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="">{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control" value="{{$model->order}}">
                            <small class="text-danger">{{$errors->first('order')}}</small>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-success">&check;Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
