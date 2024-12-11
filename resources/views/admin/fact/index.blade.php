@extends('admin.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kino Fakt</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('cinema_fact.index')}}">home</a></li>
                        <li class="breadcrumb-item active">cinema_fact</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            @if(session()->has('success'))
                <div class="alert alert-success d-flex align-items-center justify-content-between">{{session()->get('success')}}
                    <p class="mb-0 pointer-event" onclick="handlerCancel()" style="cursor: pointer;font-size: 20px">&times;</p>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Kino Fakt  <i class="fa fa-users"></i></h3>
                    <div class="text-right">
                        <a href="{{route('cinema_fact.create')}}" class="btn btn-success btn-sm">&plus; Qo'shish</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Qisqacha ma'lumot</th>
                            <th>status</th>
                            <th>Qo'shilgan vaqti</th>
                            <th></th>
                        </tr>
                        <tr>
                            <form action="">
                                <input type="hidden" name="from_filter" value="true">
                                <button type="submit" class="d-none"></button>
                                <th></th>
                                <th>
                                    <input type="text" class="form-control" name="name_oz" value="{{request('name_oz')}}">
                                </th>
                                <th></th>
                                <th>
{{--                                    <select name="status" id="" class="form-control" onchange="this.form.submit()">--}}
{{--                                        <option value="{{ request('status') === null ? 'selected' : '' }}">----</option>--}}
{{--                                        <option value="1" {{request('status') == 1?'selected':''}}>Active</option>--}}
{{--                                        <option value="0" {{ request('status') === 0 ? 'selected' : '' }}>No Active</option>--}}
{{--                                    </select>--}}
                                </th>
                                <th></th>
                                <th></th>
                            </form>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @forelse($models as $k => $item)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$item->name_oz}}</td>
                                <td>{{$item->description_oz}}</td>
                                <td>{{$item->status == 1?'Active':'No Active'}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{route('cinema_fact.edit', $item->id)}}" class="btn btn-info mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('cinema_fact.destroy', $item->id) }}" method="post" id="deleteItem-{{$item->id}}">
                                            @csrf
                                            @method('delete')

                                        </form>
                                        <a type="submit" class="btn btn-danger"
                                           onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                                               document.getElementById('deleteItem-<?= $item->id ?>').submit();
                                               }">
                                            <span class="fa fa-trash-alt"></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="alert alert-default-warning">
                                        Ma'lumot mavjud emas
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <div class="text-right">
                            {{$models->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        function handlerCancel() {
            let element = document.getElementsByTagName('p');
            console.log(element);
        }
    </script>
@endpush
