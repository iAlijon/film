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
                        <a href="#" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Suxbatlar</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('actor.index')}}" class="nav-link" {{(request()->is('admin/actor*'))?'active':''}}>Aktyorlar</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Rejissyorlar</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Kinodramaturgiya</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Operatirlar</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Kompozitor bastakorlar</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Boshqa kino ijodkorlari</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Portret
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            <span class="badge badge-primary right"></span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('director.index')}}" class="nav-link {{(request()->is('admin/director*'))?'active':''}}">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Rejissyorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Aktyorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Operatorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Kompozitor-bastakorlar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Рассомлар</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Kinolug‘at</p>
                            <span class="badge badge-primary right"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Kino fakt</p>
                            <span class="badge badge-primary right"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p class="text">Filmlar</p>
                            <span class="badge badge-primary right"></span>
                        </a>
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












