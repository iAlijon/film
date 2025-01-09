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
                    <form action="{{route('aphorism.update', $model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content " id="custom-tabs-three-tabContent">
                            {{------ oz ------}}
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">

                                <div class="form-group">
                                    <label>F.I.O</label>
                                    <input type="text" class="form-control" name="full_name_oz" value="{{$model->full_name_oz}}">
                                    <small class="text-danger">{{$errors->first('full_name_oz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Rasm</label>
                                    <input type="file" class="form-control" name="image"
                                           accept="image/jpeg, image/jpg, image/png, image/gif">
                                    <small class="text-danger">{{$errors->first('images')}}</small>
                                </div>


                                <div class="form-group">
                                    <label>Qisqacha ma'lumot</label>
                                    <textarea name="description_oz" cols="30" rows="5" class="form-control">{{$model->description_oz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_oz')}}</small>
                                </div>

                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <label>Taqvim</label>
                                    </div>
                                    <div class="card-body">
                                        <div id="dynamic-forms_oz">
                                            <!-- First Form -->
                                            <div class="form-group dynamic-form">
                                                @foreach($calendars as $calendar)
                                                <label for="description_oz">Forma</label>
                                                <textarea name="calendar[0][description_oz]" id="description_oz" class="form-control" placeholder="Enter description">{{$calendar->description_oz}}</textarea>
                                                <small class="text-danger">{{$errors->first('calendar[0][description_oz]')}}</small>
                                                @endforeach
                                            <!-- Button to Add More Forms -->
                                                <button type="button" class="btn btn-primary mt-3 btn-block ml-auto" id="add-form-btn_oz" style="width: 11%">Add Another Task</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected >Active</option>
                                        <option value="0">No Active</option>
                                    </select>
                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                </div>
                            </div>
                            {{----- uz -----}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel">
                                <div class="form-group">
                                    <label>Ф.И.О</label>
                                    <input type="text" class="form-control" name="full_name_uz" value="{{$model->full_name_uz}}">
                                    <small class="text-danger">{{$errors->first('full_name_uz')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Қисқача маълумот</label>
                                    <textarea name="description_uz" cols="30" rows="5" class="form-control">{{$model->description_uz}}</textarea>
                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                </div>

                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <label>Тақвим</label>
                                    </div>
                                    <div class="card-body">
                                        <div id="dynamic-forms_uz">
                                            <!-- First Form -->
                                            <div class="form-group dynamic-form">
                                                @foreach($calendars as $calendar)
                                                    <label for="description_uz">Форма</label>
                                                    <textarea name="calendar[0][description_uz]" id="description_uz" class="form-control" placeholder="Enter description">{{$calendar->description_uz}}</textarea>
                                                    <small class="text-danger">{{$errors->first('description_uz')}}</small>
                                                @endforeach
                                                <!-- Button to Add More Forms -->
                                                <button type="button" class="btn btn-primary mt-3 btn-block ml-auto" id="add-form-btn_uz" style="width: 11%">Add Another Task</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script>
        // JavaScript to dynamically add forms
        let formIndex = 1; // To track form indexes
        document.getElementById('add-form-btn_oz').addEventListener('click', function () {
            const dynamicForms = document.getElementById('dynamic-forms_oz');

            // Create a new form group
            const newForm = document.createElement('div');
            newForm.classList.add('form-group', 'dynamic-form', 'mt-3');
            newForm.innerHTML = `
            <label for="description">Forma ${formIndex}</label>
            <textarea name="calendar[${formIndex}][description_oz]" class="form-control" placeholder="Enter description"></textarea>
        `;

            // Append the new form group
            const addFormButton = document.getElementById('add-form-btn_oz');
            addFormButton.parentNode.insertBefore(newForm, addFormButton);

            // Increment form index for unique input names
            formIndex++;
        });

        let formIndex2 = 1
        document.getElementById('add-form-btn_uz').addEventListener('click', function () {
            const dynamicForms = document.getElementById('dynamic-forms_uz');

            // Create a new form group
            const newForm = document.createElement('div');
            newForm.classList.add('form-group', 'dynamic-form', 'mt-3');
            newForm.innerHTML = `
            <label for="description">Форма ${formIndex2}</label>
            <textarea name="calendar[${formIndex2}][description_uz]" class="form-control" placeholder="Enter description"></textarea>
        `;

            // Append the new form group
            const addFormButton = document.getElementById('add-form-btn_uz');
            addFormButton.parentNode.insertBefore(newForm, addFormButton);

            // Increment form index for unique input names
            formIndex2++;
        });
    </script>
@endpush
