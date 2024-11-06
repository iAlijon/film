@extends('admin.layouts.admin')

@section('title', 'Yangililar qo\'shish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yangiliklar Qo'shish</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-sm-12">
            <div class="card card-primary card-outline">
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
                    <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            {{----  oz  ----}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group">
                                    <label>Name_oz</label>
                                    <input type="text" class="form-control" name="name_uz" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Description_oz</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Content_oz</label>
                                    <textarea name="content_oz" class="textarea form-control summernote" id="summernote"></textarea>
{{--                                    {!! summernote_editor('content_oz', old('content_oz')) !!}--}}
                                </div>
                            </div>
                            {{----  uz  ----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Name_uz</label>
                                    <input type="text" class="form-control" name="name_uz">
                                </div>

                                <div class="form-group">
                                    <label>Description_uz</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Content_uz</label>
                                    <textarea name="content_uz" class="textarea form-control summernote" id="summernote"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush
