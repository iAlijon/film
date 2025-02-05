<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/film.svg') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Film Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
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
                    <a href="{{route('aphorism.index')}}"
                       class="nav-link {{(request()->is('admin/aphorism*'))?'active':''}}">
                        <i class="far fa-circle"></i>
                        <p class="text">Afarizmlar</p>
                        <span class="badge badge-primary right"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('news.index')}}" class="nav-link {{(request()->is('admin/news*'))?'active':''}}">
                        <i class="far fa-circle"></i>
                        <p class="text">Yangiliklar</p>
                        <span class="badge badge-primary right"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('premiere.index')}}"
                       class="nav-link {{(request()->is('admin/premiere*'))?'active':''}}">
                        <i class="far fa-circle"></i>
                        <p class="text">Premyera</p>
                        <span class="badge badge-primary right"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p class="text">Suxbatlar</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('interview.index')}}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                Intervyu
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('interview_peoples.index')}}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                Suxbat o'tkaziladigan odamlar
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('interview_category.index')}}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                Kategoriya
                            </a>
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
                            <a href="{{route('person_category.index')}}" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Shaxs kategoriyasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('person.index')}}" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Shaxsiyatlar</p>
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
                            <a href="{{route('filmographygroup.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Filmografiya Mazulari</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('filmography.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Filmografiya</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('artistic_film.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Badiiy filmlar</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('documentary.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Hujjatli filmlar</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('popular_science_film.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Ilmiy-ommabop filmlar</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('animation.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Animatsiyali filmlar</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('film_analysis.index')}}" class="nav-link">
                        <i class="far fa-circle"></i>
                        <p>Kino tahlil</p>
                        <span class="badge badge-primary right"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Kitoblar</p>
                        <i class="right fas fa-angle-left"></i>
                        <span class="badge badge-primary right"></span>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('book.index')}}" class="nav-link">
                                <i class="far fa-circle"></i>
                                <p>Kitob</p>
                                <span class="badge badge-primary right"></span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('bookgroup.index')}}" class="nav-link">
                                <i class="far fa-circle"></i>
                                <p>Kitoblar Mavzular</p>
                                <span class="badge badge-primary right"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>












