@extends('admin.layouts.admin')

@section('title', 'Videolar')
@push('css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2ab934;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider:after {
            content: 'OFF';
            color: white;
            display: block;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 70%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        input:checked + .slider:after {
            content: 'ON';
            color: white;
            display: block;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 30%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        .project-actions {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table {
            text-align: center;
        }

        label {
            margin-bottom: 0;
        }

        .video-thumb {
            width: 120px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }

        .ratio-badge {
            display: inline-block;
            padding: 2px 8px;
            background: #17a2b8;
            color: #fff;
            border-radius: 10px;
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videolar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Videolar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-11 ml-auto mr-auto">

            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{ session()->get('success') }}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{ session()->get('error') }}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Videolar <i class="fas fa-film"></i></h3>
                    <div class="text-right">
                        <a href="{{ route('video.create') }}" class="btn btn-success">&plus; Qo'shish</a>
                    </div>
                </div>

                <!-- Filter -->
                <div class="card-body pb-0">
                    <form action="{{ route('video.index') }}" method="GET" class="row align-items-end mb-3">
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                <option value="">Barchasi</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Faol</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Nofaol</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('video.index') }}" class="btn btn-secondary btn-sm">Tozalash</a>
                        </div>
                    </form>
                </div>

                <div class="card-body pt-0">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th>Video</th>
                            <th>Proporsiya</th>
                            <th>Status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th>Amallar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $k => $model)
                            <tr>
                                <td class="text-center align-middle">{{ $models->firstItem() + $k }}</td>
                                <td class="text-center align-middle">
                                    @if($model->video)
                                        <video class="video-thumb" controls preload="none">
                                            <source src="{{ asset($model->video) }}" type="video/mp4">
                                        </video>
                                    @else
                                        <span class="text-muted"><i class="fas fa-video-slash"></i> Yo'q</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <span class="ratio-badge">{{ $model->width_ratio }}:{{ $model->height_ratio }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <label class="switch">
                                        <input type="checkbox"
                                               class="status-toggle"
                                               data-id="{{ $model->id }}"
                                            {{ $model->status == 1 ? 'checked' : '' }}
                                        >
                                        <div class="slider round"></div>
                                    </label>
                                </td>
                                <td class="text-center align-middle">
                                    {{ \Carbon\Carbon::parse($model->created_at)->format('d.m.Y H:i') }}
                                </td>
                                <td class="align-middle">
                                    <div class="project-actions">
                                        <a href="{{ route('video.edit', $model->id) }}" class="btn btn-info btn-sm mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('video.destroy', $model->id) }}" method="POST"
                                              id="deleteVideo-{{ $model->id }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a class="btn btn-danger btn-sm"
                                           onclick="if(confirm('Siz rostdan ham ushbu videoni o\'chirishni xohlaysizmi?')){
                                               document.getElementById('deleteVideo-{{ $model->id }}').submit();
                                           }">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="alert alert-warning mb-0">
                                        Ma'lumot mavjud emas
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="col-sm-12 text-right">
                        {{ $models->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            // Status toggle
            $('.status-toggle').change(function () {
                const checkbox = $(this);
                const itemId = checkbox.data('id');
                const newStatus = checkbox.is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('video-status') }}",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: itemId,
                        status: newStatus
                    },
                    success: function () {
                        location.reload();
                    },
                    error: function () {
                        alert('ID ' + itemId + ' ma\'lumotni holati o\'zgarmadi');
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    }
                });
            });

            // Alert close
            $('.cancel').click(function () {
                $(this).closest('.alert').fadeOut();
            });
        });
    </script>
@endpush
