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
                        <li class="breadcrumb-item"><a href="{{route('aphorism.index')}}">Home</a></li>
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
                    {{session()->get('error')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{route('aphorism.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>{{labels('f.i.o')}}</label>
                            <input type="text" class="form-control @error('full_name') border-danger @enderror"
                                   name="full_name" value="{{$model->translations->first()?->full_name}}">
                            <small class="text-danger">{{$errors->first('full_name')}}</small>
                        </div>

{{--                                                        <div class="form-group">--}}
{{--                                                            <label>{{labels('image')}}</label>--}}
{{--                                                            <input type="file" class="form-control @error('images') border-danger @enderror" name="image"--}}
{{--                                                                   accept="image/jpeg, image/jpg, image/png, image/gif">--}}
{{--                                                            <small class="text-danger">{{$errors->first('image')}}</small>--}}
{{--                                                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{labels('image')}}</label>--}}

{{--                            <div class="image-edit-wrapper mb-2">--}}
{{--                                @if($model->images)--}}
{{--                                    <img id="currentImage"--}}
{{--                                         src="{{ asset($model->images) }}"--}}
{{--                                         alt="{{labels('image')}}"--}}
{{--                                         style="max-width: 200px; display: block; margin-bottom: 10px;">--}}
{{--                                @else--}}
{{--                                    <img id="currentImage"--}}
{{--                                         src=""--}}
{{--                                         alt=""--}}
{{--                                         style="max-width: 200px; display: none; margin-bottom: 10px;">--}}
{{--                                @endif--}}

{{--                                <input type="file" name="image" id="imageInput"--}}
{{--                                       class="form-control @error('image') border-danger @enderror"--}}
{{--                                       accept="image/jpeg,image/jpg,image/png,image/gif"--}}
{{--                                       style="{{ $model->images ? 'display: none;' : '' }}">--}}

{{--                                @if($model->images)--}}
{{--                                    <div id="imageButtons">--}}
{{--                                        <button type="button" class="btn btn-primary btn-sm mt-2" id="editImageBtn">--}}
{{--                                            O'zgartirish--}}
{{--                                        </button>--}}
{{--                                    </div>--}}

{{--                                    <div id="editControls" style="display: none;">--}}
{{--                                        <button type="button" class="btn btn-secondary btn-sm mt-2" id="cancelImageBtn">--}}
{{--                                            Bekor qilish--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <small class="text-danger">{{$errors->first('image')}}</small>--}}
{{--                        </div>--}}

                        <x-image-edit-field :image="$model->images" input-name="image" />

                        <div class="form-group">
                            <label>{{labels('description')}}</label>
                            <textarea name="description" cols="30" rows="5"
                                      class="form-control @error('description') border-danger @enderror">{{$model->translations->first()?->description}}</textarea>
                            <small class="text-danger">{{$errors->first('description')}}</small>
                        </div>

                        {{--                                <div class="card card-outline card-success">--}}
                        {{--                                    <div class="card-header">--}}
                        {{--                                        <label>{{labels('calendar')}}</label>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="card-body">--}}
                        {{--                                        <div id="dynamic-forms">--}}
                        {{--                                            @php--}}
                        {{--                                                $translation = $model->translations->first();--}}
                        {{--                                                $calendars = $translation?->calendar ?? [];--}}
                        {{--                                            @endphp--}}
                        {{--                                            @foreach($calendars as $k => $value)--}}
                        {{--                                                <div class="card mb-2 dynamic-form">--}}
                        {{--                                                    <div class="card-header">--}}
                        {{--                                                        <label>{{ $k + 1 }}</label>--}}
                        {{--                                                        <button type="button" class="remove-form-btn btn btn-danger btn-sm float-right">--}}
                        {{--                                                            <i class="fas fa-trash"></i>--}}
                        {{--                                                        </button>--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="card-body">--}}
                        {{--                                                        <div class="form-group">--}}
                        {{--                                                    <textarea name="calendar[{{ $k }}]"--}}
                        {{--                                                      class="form-control @error("calendar.$k") border-danger @enderror"--}}
                        {{--                                                      placeholder="Enter description">--}}
                        {{--                                                        {{ $value }}--}}
                        {{--                                                    </textarea>--}}
                        {{--                                                            <small class="text-danger">{{ $errors->first("calendar.$k") }}</small>--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </div>--}}
                        {{--                                                </div>--}}
                        {{--                                            @endforeach--}}
                        {{--                                            <!-- First Form -->--}}
                        {{--                                            <button type="button" class="btn btn-primary mt-3 float-right" id="add-form-btn">--}}
                        {{--                                                + Qo'shish--}}
                        {{--                                            </button>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}

                        <div class="form-group">
                            <label for="status">{{labels('status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                            <small class="text-danger">{{$errors->first('status')}}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('order')}}</label>
                            <input type="text" name="order" class="form-control" value="{{$model->order}}">
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

@push('js')

{{--    @if($model->images)--}}
{{--        <script>--}}
{{--            const currentImage = document.getElementById('currentImage');--}}
{{--            const imageInput = document.getElementById('imageInput');--}}
{{--            const editBtn = document.getElementById('editImageBtn');--}}
{{--            const cancelBtn = document.getElementById('cancelImageBtn');--}}
{{--            const editControls = document.getElementById('editControls');--}}
{{--            const imageButtons = document.getElementById('imageButtons');--}}

{{--            const originalImageSrc = currentImage.src;--}}

{{--            // "O'zgartirish" bosilganda - fayl input ko'rinadi va ochiladi--}}
{{--            editBtn.addEventListener('click', function () {--}}
{{--                imageInput.style.display = 'block';--}}
{{--                imageInput.click();--}}
{{--                imageButtons.style.display = 'none';--}}
{{--                editControls.style.display = 'block';--}}
{{--            });--}}

{{--            // Fayl tanlanganda - preview yangilanadi--}}
{{--            imageInput.addEventListener('change', function (e) {--}}
{{--                const file = e.target.files[0];--}}
{{--                if (file) {--}}
{{--                    const reader = new FileReader();--}}
{{--                    reader.onload = function (event) {--}}
{{--                        currentImage.src = event.target.result;--}}
{{--                        currentImage.style.display = 'block';--}}
{{--                    };--}}
{{--                    reader.readAsDataURL(file);--}}
{{--                }--}}
{{--            });--}}

{{--            // "Bekor qilish" bosilganda - eski rasmga qaytariladi--}}
{{--            cancelBtn.addEventListener('click', function () {--}}
{{--                currentImage.src = originalImageSrc;--}}
{{--                currentImage.style.display = 'block';--}}
{{--                imageInput.value = '';--}}
{{--                imageInput.style.display = 'none';--}}
{{--                editControls.style.display = 'none';--}}
{{--                imageButtons.style.display = 'block';--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endif--}}
{{--<script>--}}
{{--    let formIndex = {{ count($translation?->calendar ?? []) }};--}}
{{--    console.log(formIndex);--}}
{{--    function addForm() {--}}
{{--        const dynamicForms = document.getElementById('dynamic-forms');--}}
{{--        const addFormButton = document.getElementById('add-form-btn');--}}
{{--        console.log(addFormButton);--}}
{{--        const newForm = document.createElement('div');--}}
{{--        newForm.classList.add('dynamic-form');--}}
{{--        newForm.innerHTML = `--}}
{{--        <div class="card mb-2">--}}
{{--            <div class="card-header">--}}
{{--                <label>${formIndex + 1}</label>--}}
{{--                <button type="button" class="remove-form-btn btn btn-danger btn-sm float-right">--}}
{{--                    <i class="fas fa-trash"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <textarea name="calendar[${formIndex}]"--}}
{{--                          class="form-control"--}}
{{--                          placeholder="Enter description"></textarea>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    `;--}}

{{--        dynamicForms.insertBefore(newForm, addFormButton);--}}
{{--        formIndex++;--}}
{{--    }--}}

{{--    function reindexForms() {--}}
{{--        const forms = document.querySelectorAll('#dynamic-forms .dynamic-form');--}}
{{--        forms.forEach((form, index) => {--}}
{{--            const textarea = form.querySelector('textarea');--}}
{{--            if (textarea) {--}}
{{--                textarea.setAttribute('name', `calendar[${index}]`);--}}
{{--            }--}}
{{--            const label = form.querySelector('.card-header label');--}}
{{--            if (label) {--}}
{{--                label.textContent = index + 1;--}}
{{--            }--}}
{{--        });--}}
{{--        formIndex = forms.length;--}}
{{--    }--}}

{{--    document.getElementById('add-form-btn').addEventListener('click', addForm);--}}

{{--    document.getElementById('dynamic-forms').addEventListener('click', function (e) {--}}
{{--        const removeBtn = e.target.closest('.remove-form-btn');--}}
{{--        if (removeBtn) {--}}
{{--            const formGroup = removeBtn.closest('.dynamic-form');--}}
{{--            if (formGroup) {--}}
{{--                formGroup.remove();--}}
{{--                reindexForms();--}}
{{--            }--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
@endpush
