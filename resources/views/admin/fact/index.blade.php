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
                        <li class="breadcrumb-item"><a href="{{route('cinema_fact.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cinema Fact</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11 ml-auto mr-auto">
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Kino Fakt <i class="fa fa-users"></i></h3>
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
                                    <input type="text" class="form-control" name="name_oz"
                                           value="{{request('name_oz')}}" placeholder="Fakt Nomi">
                                </th>
                                <th></th>
                                <th>
                                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                                        <option value="">---</option>
                                        <option value="1" {{request('status') == 1?'selected':''}}>Active</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>No Active
                                        </option>
                                    </select>
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
                                        <a href="{{route('cinema_fact.edit', $item->id)}}" class="btn btn-info mr-2"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('cinema_fact.destroy', $item->id) }}" method="post"
                                              id="deleteItem-{{$item->id}}">
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
                    </table>
                    <div class="text-right mt-2">
                        {{$models->links('vendor.pagination.bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            let timeout;
            let clicked = false;
            $('.cancel').click(function () {
                clicked = true;
                let check = $('.cancel').text().trim();
                if (check !== 'x') {
                    $("#close").addClass('closer');
                }
            })

            timeout = setTimeout(function () {
                if (!clicked) {
                    $('#close').addClass('closer');
                }
            }, 5000)
        })
    </script>
@endpush
