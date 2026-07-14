@extends('admin.layouts.admin')

@section('title', 'Videoni tahrirlash')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videoni tahrirlash</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('video.index') }}">Videolar</a></li>
                        <li class="breadcrumb-item active">Tahrirlash</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-10 mr-auto ml-auto">

            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{ session()->get('error') }}
                    <button class="btn btn-danger position-absolute cancel" style="top:5px;right:5px;">&times;</button>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{ session()->get('success') }}
                    <button class="btn btn-success position-absolute cancel" style="top:5px;right:5px;">&times;</button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit mr-1"></i>
                        Video #{{ $model->id }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('video.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Mavjud video --}}
                        @if($model->video)
                            <div class="form-group">
                                <label>Joriy video</label>
                                <div id="currentVideoBox">
                                    <video controls
                                           style="max-width:100%; max-height:300px; border-radius:6px; border:1px solid #dee2e6;"
                                           preload="metadata">
                                        <source src="{{ asset($model->video) }}" type="video/mp4">
                                        Brauzeringiz video formatini qo'llab-quvvatlamaydi.
                                    </video>
                                    <div class="mt-2">
                                        <a href="#" id="changeVideo" class="btn btn-warning btn-sm">
                                            <i class="fas fa-exchange-alt"></i> Videoni almashtirish
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Yangi video fayl (yashirin, almashtirish tugmasi bosilganda ko'rinadi) --}}
                            <div id="newVideoBox" style="display:none;" class="form-group">
                                <label>Yangi video fayl</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input @error('video_file') border-danger @enderror"
                                               id="video_file"
                                               name="video_file"
                                               accept="video/mp4,video/avi,video/mov,video/mkv,video/webm">
                                        <label class="custom-file-label" for="video_file">Faylni tanlang...</label>
                                    </div>
                                </div>
                                @error('video_file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="mt-2">
                                    <a href="#" id="cancelChangeVideo" class="text-secondary">
                                        <i class="fas fa-times"></i> Bekor qilish
                                    </a>
                                </div>
                            </div>

                            {{-- Yangi video preview --}}
                            <div id="newVideoPreviewBox" style="display:none;" class="form-group">
                                <label>Yangi video ko'rinishi</label>
                                <div>
                                    <video id="newVideoPreview" controls
                                           style="max-width:100%; max-height:300px; border-radius:6px; border:1px solid #28a745;">
                                        <source src="" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                        @else
                            {{-- Video mavjud emas - to'g'ridan-to'g'ri upload --}}
                            <div class="form-group">
                                <label>Video fayl</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input @error('video_file') border-danger @enderror"
                                               id="video_file"
                                               name="video_file"
                                               accept="video/mp4,video/avi,video/mov,video/mkv,video/webm">
                                        <label class="custom-file-label" for="video_file">Faylni tanlang...</label>
                                    </div>
                                </div>
                                @error('video_file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="text-muted">Qo'llab-quvvatlanadi: MP4, AVI, MOV, WEBM</small>
                            </div>

                            <div id="videoPreviewBox" style="display:none;" class="form-group">
                                <label>Ko'rinishi</label>
                                <video id="videoPreview" controls
                                       style="max-width:100%; max-height:300px; border-radius:6px; border:1px solid #dee2e6;">
                                    <source src="" type="video/mp4">
                                </video>
                            </div>
                        @endif

                        {{-- Proporsiya --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kenglik nisbati (Width Ratio)</label>
                                    <input type="number"
                                           name="width_ratio"
                                           class="form-control @error('width_ratio') border-danger @enderror"
                                           value="{{ old('width_ratio', $model->width_ratio) }}"
                                           min="1" max="100">
                                    @error('width_ratio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balandlik nisbati (Height Ratio)</label>
                                    <input type="number"
                                           name="height_ratio"
                                           class="form-control @error('height_ratio') border-danger @enderror"
                                           value="{{ old('height_ratio', $model->height_ratio) }}"
                                           min="1" max="100">
                                    @error('height_ratio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Tezkor proporsiya --}}
                        <div class="form-group">
                            <label>Tezkor proporsiya tanlash</label>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm ratio-btn
                                    {{ $model->width_ratio == 16 && $model->height_ratio == 9 ? 'btn-secondary' : 'btn-outline-secondary' }}"
                                    data-w="16" data-h="9">16:9</button>
                                <button type="button" class="btn btn-sm ratio-btn
                                    {{ $model->width_ratio == 4 && $model->height_ratio == 3 ? 'btn-secondary' : 'btn-outline-secondary' }}"
                                    data-w="4" data-h="3">4:3</button>
                                <button type="button" class="btn btn-sm ratio-btn
                                    {{ $model->width_ratio == 1 && $model->height_ratio == 1 ? 'btn-secondary' : 'btn-outline-secondary' }}"
                                    data-w="1" data-h="1">1:1</button>
                                <button type="button" class="btn btn-sm ratio-btn
                                    {{ $model->width_ratio == 9 && $model->height_ratio == 16 ? 'btn-secondary' : 'btn-outline-secondary' }}"
                                    data-w="9" data-h="16">9:16</button>
                                <button type="button" class="btn btn-sm ratio-btn
                                    {{ $model->width_ratio == 21 && $model->height_ratio == 9 ? 'btn-secondary' : 'btn-outline-secondary' }}"
                                    data-w="21" data-h="9">21:9</button>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control form-control-sm" style="max-width:200px;">
                                <option value="1" {{ old('status', $model->status) == 1 ? 'selected' : '' }}>Faol</option>
                                <option value="0" {{ old('status', $model->status) == 0 ? 'selected' : '' }}>Nofaol</option>
                            </select>
                        </div>

                        <div class="text-right mt-3">
                            <a href="{{ route('video.index') }}" class="btn btn-secondary mr-2">Bekor qilish</a>
                            <button type="submit" class="btn btn-success">&check; Saqlash</button>
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

            // Videoni almashtirish toggle
            $('#changeVideo').on('click', function (e) {
                e.preventDefault();
                $('#currentVideoBox').hide();
                $('#newVideoBox').show();
            });

            $('#cancelChangeVideo').on('click', function (e) {
                e.preventDefault();
                $('#newVideoBox').hide();
                $('#newVideoPreviewBox').hide();
                $('#currentVideoBox').show();
                $('#video_file').val('');
                $('.custom-file-label').text('Faylni tanlang...');
            });

            // Fayl tanlanganda label va preview yangilash
            $('#video_file').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $(this).siblings('.custom-file-label').text(fileName || 'Faylni tanlang...');

                const file = this.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    // Agar almashtirish rejimi
                    if ($('#newVideoPreview').length) {
                        $('#newVideoPreview source').attr('src', url);
                        $('#newVideoPreview')[0].load();
                        $('#newVideoPreviewBox').show();
                    }
                    // Agar video mavjud emas rejimi
                    if ($('#videoPreview').length) {
                        $('#videoPreview source').attr('src', url);
                        $('#videoPreview')[0].load();
                        $('#videoPreviewBox').show();
                    }
                }
            });

            // Tezkor proporsiya
            $('.ratio-btn').on('click', function () {
                const w = $(this).data('w');
                const h = $(this).data('h');
                $('input[name="width_ratio"]').val(w);
                $('input[name="height_ratio"]').val(h);
                $('.ratio-btn').removeClass('btn-secondary').addClass('btn-outline-secondary');
                $(this).removeClass('btn-outline-secondary').addClass('btn-secondary');
            });

            // Alert yopish
            $('.cancel').click(function () {
                $(this).closest('.alert').fadeOut();
            });
        });
    </script>
@endpush
