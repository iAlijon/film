@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Afarizm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('aphorism.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Aphorism</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-11 mr-auto ml-auto">

            @if(session()->has('error'))
                <div class="alert alert-danger" id="close">
                    {{ session()->get('error') }}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif

            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{ route('aphorism.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>{{labels('f.i.o')}}</label>
                            <input type="text" name="full_name"
                                   class="form-control @error('full_name') border-danger @enderror"
                                   value="{{ old('full_name') }}"
                                   placeholder="{{labels('f.i.o')}}">
                            <small class="text-danger">{{ $errors->first('full_name') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('image')}}</label>
                            <input type="file" name="image"
                                   class="form-control @error('image') border-danger @enderror"
                                   accept="image/jpeg,image/jpg,image/png,image/gif">
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('description')}}</label>
                            <textarea name="description" rows="5"
                                      class="form-control @error('description') border-danger @enderror"
                                      placeholder="{{labels('description')}}">{{ old('description') }}</textarea>
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        </div>

                        {{-- ── Taqvim ── --}}
{{--                        <div class="card card-outline card-success">--}}
{{--                            <div class="card-header">--}}
{{--                                <label>{{labels('calendar')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div id="dynamic-forms">--}}

{{--                                    --}}{{-- Birinchi forma --}}
{{--                                    <div class="dynamic-form">--}}
{{--                                        <div class="card mb-2">--}}
{{--                                            <div class="card-header">--}}
{{--                                                <label>1</label>--}}
{{--                                            </div>--}}
{{--                                            <div class="card-body">--}}
{{--                                                <textarea name="calendar[0]"--}}
{{--                                                          class="form-control @error('calendar.0') border-danger @enderror"--}}
{{--                                                          placeholder="{{labels('calendar')}}">{{ old('calendar.0') }}</textarea>--}}
{{--                                                <small class="text-danger">{{ $errors->first('calendar.0') }}</small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <button type="button" class="btn btn-primary mt-3 float-right" id="add-form-btn">--}}
{{--                                        + Qo'shish--}}
{{--                                    </button>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        @include('admin.components.ratio-fields')

                        <div class="form-group">
                            <label>{{labels('status')}}</label>
                            <select name="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="2">No Active</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control" value="{{$order}}">
                        </div>

                        <br>
                        <div class="text-right mt-3">
                            <button class="btn btn-success">&check; Saqlash</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
{{--    <script>--}}
{{--        let formIndex = 1;--}}

{{--        function addForm() {--}}
{{--            const dynamicForms = document.getElementById('dynamic-forms');--}}
{{--            const addFormButton = document.getElementById('add-form-btn');--}}

{{--            const newForm = document.createElement('div');--}}
{{--            newForm.classList.add('dynamic-form');--}}
{{--            newForm.innerHTML = `--}}
{{--            <div class="card mb-2">--}}
{{--                <div class="card-header">--}}
{{--                    <label>${formIndex + 1}</label>--}}
{{--                    <button type="button" class="remove-form-btn btn btn-danger btn-sm float-right">--}}
{{--                        <i class="fas fa-trash"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <textarea name="calendar[${formIndex}]"--}}
{{--                              class="form-control"--}}
{{--                              placeholder="Tavsif kiriting"></textarea>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        `;--}}

{{--            dynamicForms.insertBefore(newForm, addFormButton);--}}
{{--            formIndex++;--}}
{{--        }--}}

{{--        function reindexForms() {--}}
{{--            const forms = document.querySelectorAll('#dynamic-forms .dynamic-form');--}}
{{--            forms.forEach((form, index) => {--}}
{{--                const textarea = form.querySelector('textarea');--}}
{{--                if (textarea) {--}}
{{--                    textarea.setAttribute('name', `calendar[${index}]`);--}}
{{--                }--}}
{{--                const label = form.querySelector('.card-header label');--}}
{{--                if (label) {--}}
{{--                    label.textContent = index + 1;--}}
{{--                }--}}
{{--            });--}}
{{--            formIndex = forms.length;--}}
{{--        }--}}

{{--        document.getElementById('add-form-btn').addEventListener('click', addForm);--}}

{{--        document.getElementById('dynamic-forms').addEventListener('click', function (e) {--}}
{{--            const removeBtn = e.target.closest('.remove-form-btn');--}}
{{--            if (removeBtn) {--}}
{{--                const formGroup = removeBtn.closest('.dynamic-form');--}}
{{--                if (formGroup) {--}}
{{--                    formGroup.remove();--}}
{{--                    reindexForms();--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endpush
