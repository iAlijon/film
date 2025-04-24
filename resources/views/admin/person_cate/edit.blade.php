@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategoriyalar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
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
                    <form action="{{route('categories.update',$model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Menu</label>
                                    <select name="menu" id="menu" class="form-control">
                                        <option value="">---</option>
                                        <option value="news" {{$model->type == 'news'?'selected':''}}>Yangiliklar</option>
                                        <option value="premiere" {{$model->type == 'premiere'?'selected':''}}>Premyaerlar</option>
                                        <option value="analysis" {{$model->type == 'analysis'?'selected':''}}>Kino Tahlil</option>
                                        <option value="interview" {{$model->type == 'interview'?'selected':''}}>Suxbatlar</option>
                                        <option value="person" {{$model->type == 'person'?'selected':''}}>Shaxsiyatlar</option>
                                        <option value="dictionary" {{$model->type == 'dictionary'?'selected':''}}>Kino Lug'at</option>
                                        <option value="fact" {{$model->type == 'fact'?'selected':''}}>Kino Fakt</option>
                                        <option value="filmography" {{$model->type == 'filmography'?'selected':''}}>Filmografiya</option>
                                        <option value="books" {{$model->type == 'books'?'selected':''}}>Kitoblar</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('menu')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Kategoriya Nomi</label>
                                    <input type="text" class="form-control" name="name_oz" value="{{$model->name_oz}}">
                                    <small class="text-danger">{{$errors->first('name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Order</label>
                                    <input type="text" class="form-control" name="order" placeholder="Order" id="order" value="{{$model->order <= 0??1}}">
                                    <small class="text-danger"{{$errors->first('order')}}></small>
                                </div>

                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Категория Номи</label>
                                    <input type="text" class="form-control" name="name_uz" value="{{$model->name_uz}}">
                                    <small class="text-danger">{{$errors->first('name_uz')}}</small>
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
            $('#menu').on('change', function () {
                let menu = $(this).val();
                console.log(menu);
                $.ajax({
                    url: '{{route('order_category')}}',
                    method: 'GET',
                    data: {menu: menu},
                    success: function (res){
                        let order = res.data.order + 1;
                        $('#order').val(order);
                    },
                })
            })
        })
    </script>
@endpush
