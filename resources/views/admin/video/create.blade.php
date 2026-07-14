@extends('admin.layouts.admin')

@section('title', 'Video qo\'shish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Video qo'shish</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('video.index') }}">Videolar</a></li>
                        <li class="breadcrumb-item active">Qo'shish</li>
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

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-film mr-1"></i> Yangi Video</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Video fayl --}}
                        <div class="form-group">
                            <label>Video fayl <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('video_file') border-danger @enderror"
                                           id="video_file"
                                           name="video_file"
                                           accept="video/mp4,video/avi,video/mov,video/webm">
                                    <label class="custom-file-label" for="video_file">Faylni tanlang...</label>
                                </div>
                            </div>
                            @error('video_file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="text-muted">Qo'llab-quvvatlanadi: MP4, AVI, MOV, WEBM</small>
                        </div>

                        {{-- Video preview --}}
                        <div id="videoPreviewBox" style="display:none;" class="form-group">
                            <label>Ko'rinishi</label>
                            <div>
                                <video id="videoPreview" controls style="max-width:100%; max-height:300px; border-radius:6px; border:1px solid #dee2e6;">
                                    <source src="" type="video/mp4">
                                </video>
                            </div>
                        </div>

                        {{-- Proporsiya --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kenglik nisbati (Width Ratio)</label>
                                    <input type="number"
                                           name="width_ratio"
                                           class="form-control @error('width_ratio') border-danger @enderror"
                                           value="{{ old('width_ratio', 16) }}"
                                           min="1" max="100"
                                           placeholder="16">
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
                                           value="{{ old('height_ratio', 9) }}"
                                           min="1" max="100"
                                           placeholder="9">
                                    @error('height_ratio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Tezkor proporsiya tanlash --}}
                        <div class="form-group">
                            <label>Tezkor proporsiya tanlash</label>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="16" data-h="9">16:9</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="4" data-h="3">4:3</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="1" data-h="1">1:1</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="9" data-h="16">9:16</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="21" data-h="9">21:9</button>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control form-control-sm" style="max-width:200px;">
                                <option value="1" selected>Active</option>
                                <option value="2" >No Active</option>
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

            // Custom file label update
            $('#video_file').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $(this).siblings('.custom-file-label').text(fileName || 'Faylni tanlang...');

                // Video preview
                const file = this.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    $('#videoPreview source').attr('src', url);
                    $('#videoPreview')[0].load();
                    $('#videoPreviewBox').show();
                }
            });

            // Quick ratio buttons
            $('.ratio-btn').on('click', function () {
                const w = $(this).data('w');
                const h = $(this).data('h');
                $('input[name="width_ratio"]').val(w);
                $('input[name="height_ratio"]').val(h);
                $('.ratio-btn').removeClass('btn-secondary').addClass('btn-outline-secondary');
                $(this).removeClass('btn-outline-secondary').addClass('btn-secondary');
            });

            // Close alert
            $('.cancel').click(function () {
                $(this).closest('.alert').fadeOut();
            });
        });
    </script>
@endpush
