<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/film.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Film Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">
                    Administrator
                </a>
            </div>
        </div>
    <!-- Sidebar Menu -->
        <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">MENUS</li>
                    <li class="nav-item">
                        <a href="{{route('news.index')}}" class="nav-link {{(request()->is('admin/news*'))?'active':''}}">
                            <i class="far fa-circle"></i>
                            <p class="text">Yangiliklar</p>
                            <span class="badge badge-primary right"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" >
                            <i class="nav-icon fas fa-copy"></i>
                            <p class="text">Suxbatlar</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="{{route('actor_conversation.index')}}" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    Aktyorlar
{{--                                    <i class="right fas fa-angle-left"></i>--}}
                                </a>
{{--                                <ul class="nav nav-treeview">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{route('actor.index')}}" class="nav-link {{request()->is('admin/actor*')?'active':''}}"><i class="far fa-dot-circle nav-icon"></i>Aktyor qo'shish</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{route('actor_conversation.index')}}" class="nav-link {{request()->is('admin/actor_conversation*')?'active':''}}"><i class="far fa-dot-circle nav-icon"></i>Aktyor bilan suxbat</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                            </li>
                            <li class="nav-item">
                                <a href="{{route('rejissor.index')}}" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    Rejissyorlar
{{--                                    <i class="right fas fa-angle-left"></i>--}}
                                </a>
{{--                                <ul class="nav nav-treeview">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{route('rejissor.index')}}" class="nav-link {{(request()->is('admin/rejissor*'))?'active':''}}">Rejissor qo'shish</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="" class="nav-link">Rejissor bilan suxbat</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                            </li>
                            <li class="nav-item">
                                <a href="{{route('dramaturgy.index')}}" class="nav-link"><i class="nav-icon far fa-circle"></i> Kinodramaturgiya</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('operator.index')}}" class="nav-link"><i class="nav-icon far fa-circle"></i> Operatirlar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('composer.index')}}" class="nav-link"><i class="nav-icon far fa-circle"></i> Kompozitor bastakorlar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('other.index')}}" class="nav-link"><i class="nav-icon far fa-circle"></i> Boshqa kino ijodkorlari</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('people_film.index')}}" class="nav-link"><i class="nav-icon far fa-circle"></i> Kinoga tegishli odamlarni qo'shosh</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p class="text">Shaxsiyatlar</p>
                            <i class="right fas fa-angle-left"></i>
                            <span class="badge badge-primary right"></span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('portrait_rejissors.index')}}" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Rejissyorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('portrait_actor.index')}}" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Aktyorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('portrait_operator.index')}}" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Operatorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('portrait_composer.index')}}" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Kompozitor-bastakorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('portrait_artist.index')}}" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Рассомлар</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('film_dictionary.index')}}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Kinolug‘at</p>
                            <span class="badge badge-primary right"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('cinema_fact.index')}}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Kino fakt</p>
                            <span class="badge badge-primary right"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p class="text">Filmografiya</p>
                            <i class="right fas fa-angle-left"></i>
                            <span class="badge badge-primary right"></span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('artistic_film.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Badiiy filmlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hujjatli filmlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ilmiy-ommabop filmlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Animatsiyali filmlar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                                <i class="far fa-circle"></i>
                            <p>Kino tahlil</p>
                            <span class="badge badge-primary right"></span>
                        </a>
                    </li>
                </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>












