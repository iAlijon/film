<!-- Navigation -->
<div class="cd-slider-nav">
    <div class="container">
        <nav class="navbar">
            <div class="tm-navbar-bg">
                <a class="navbar-brand text-uppercase" href="#">KINO TAHLIL</a>
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                        data-target="#tmNavbar">
                    &#9776;
                </button>
                <div class="collapse navbar-toggleable-md text-xs-center text-uppercase tm-navbar" id="tmNavbar">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active ">
                            <a class="nav-link" href="#" data-no="1">Yangiliklar <span class="sr-only">(current)</span></a>
                            <ul class="submenu">
                                <li class="nav-item sub-item">
                                    <a href="{{route('news', ['category_id' => 1])}}" class="nav-link sub-link">Xorijiy yangliklar</a>
                                </li>
                                <li class="nav-item sub-item">
                                    <a href="{{route('news', ['category_id' => 2])}}" class="nav-link sub-link">O'zbekiston yangliklar</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#0" data-no="2">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#0" data-no="3">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#0" data-no="4">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<style>
    /* Initially hide the submenu */
    .submenu {
        display: none;
        position: absolute; /* Ensures the submenu appears relative to the parent */
        /*background-color: #fff;*/
        /*padding: 10px;*/
        border-top: 1px solid #ccc;
        z-index: 1000; /* Ensures it appears above other elements */
        list-style: none;
    }

    /* Show submenu on hover */
    .nav-item:hover .submenu {
        display: block;
    }

    /* Styling active links */
    .nav-item.active > .nav-link {
        color: #007bff; /* Example active color */
        font-weight: bold;
    }
    .sub-item{
        display: block!important;
    }
    .sub-link {
        height: 50px !important;
        vertical-align: middle !important;
        text-wrap: nowrap!important;
        font-size: 14px!important;
        display: block!important;
    }

</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navItems = document.querySelectorAll('.nav-item');

        navItems.forEach(item => {
            // Add click event listener to each menu item
            item.addEventListener('click', function (e) {
                // Remove 'active' class from all items
                navItems.forEach(i => i.classList.remove('active'));

                // Add 'active' class to the clicked item
                this.classList.add('active');
            });
        });
    });
</script>
