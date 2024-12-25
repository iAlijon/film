<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kino Tahlil</title>

    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="{{asset('front/css/hero-slider-style.css')}}">
    <!-- Hero slider style (https://codyhouse.co/gem/hero-slider/) -->
    <link rel="stylesheet" href="{{asset('front/css/magnific-popup.css')}}">
    <!-- Magnific popup style (http://dimsemenov.com/plugins/magnific-popup/) -->
    <link rel="stylesheet" href="{{asset('front/css/tooplate-style.css')}}">
    <!-- Tooplate style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="cd-bg-video-wrapper" data-video="video/bangkok-city">
        <!-- video element will be loaded using jQuery -->
    </div> <!-- .cd-bg-video-wrapper -->

    <!-- Content -->
    <div class="cd-hero">
        @include('header')
        <ul class="cd-hero-slider">  <!-- autoplay -->
            @yield('content')
        </ul>
        @include('footer')
    </div>

    <!-- Preloader, https://ihatetomatoes.net/create-custom-preloading-screen/ -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

<!-- load JS files -->
<script src="{{asset('front/js/jquery-1.11.3.min.js')}}"></script>         <!-- jQuery (https://jquery.com/download/) -->
<script src="{{asset('front/js/tether.min.js')}}"></script>                <!-- http://tether.io/ -->
<script src="{{asset('front/js/isInViewport.min.js')}}"></script>          <!-- isInViewport js (https://github.com/zeusdeux/isInViewport) -->
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>             <!-- Bootstrap js (v4-alpha.getbootstrap.com/) -->
<script src="{{asset('front/js/hero-slider-main.js')}}"></script>          <!-- Hero slider (https://codyhouse.co/gem/hero-slider/) -->
<script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script> <!-- Magnific popup (http://dimsemenov.com/plugins/magnific-popup/) -->
<script>

    function adjustHeightOfPage(pageNo) {
        console.log('pageNo',pageNo)
        var offset = 80;
        var pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .js-tm-page-content").height();
        if($(window).width() >= 992) { offset = 120; }
        else if($(window).width() < 480) { offset = 40; }

        // Get the page height
        var totalPageHeight = 335 + $('.cd-slider-nav').height()
            + pageContentHeight + offset
            + $('.tm-footer').height();

        // Adjust layout based on page height and window height
        if(totalPageHeight > $(window).height())
        {
            $('.cd-hero-slider').addClass('small-screen');
            $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", totalPageHeight + "px");
        }
        else
        {
            $('.cd-hero-slider').removeClass('small-screen');
            $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", "100%");
        }
    }

    function uploadVideo() {

        var videoWrapper = $('.cd-bg-video-wrapper');
        if( videoWrapper.is(':visible') ) {
            // if visible - we are not on a mobile device
            var videoUrl = videoWrapper.data('video'),

            video = $('<video autoplay loop><source src="'+videoUrl+'.mp4" type="front/video/mp4" /></video>');
            video.appendTo(videoWrapper);

            // play video if first slide
            if(videoWrapper.parent('.cd-bg-video.selected').length > 0) video.get(0).play();
        }
    }

    // Everything is loaded including images.
    $(window).load(function(){

        adjustHeightOfPage(1); // Adjust page height

        // Background Video
        if($( window ).width() > 800) {
            uploadVideo();
        }

        /* Gallery One pop up
        -----------------------------------------*/
        $('.gallery-first').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery:{enabled:true}
        });

        /* Gallery Two pop up
        -----------------------------------------*/
        $('.gallery-second').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery:{enabled:true}
        });

        /* Collapse menu after click
        -----------------------------------------*/
        $('#tmNavbar a').click(function(){
            $('#tmNavbar').collapse('hide');

            adjustHeightOfPage($(this).data("no")); // Adjust page height
        });

        /* Browser resized
        -----------------------------------------*/
        $( window ).resize(function() {
            var currentPageNo = $(".cd-hero-slider li.selected .js-tm-page-content").data("page-no");
            console.log('currentPageNo',    currentPageNo)
            // wait 3 seconds
            setTimeout(function() {
                adjustHeightOfPage( currentPageNo );
            }, 3000);

            if($( window ).width() > 800) {
                uploadVideo();
            }

        });

        // Play video only when visible
        // https://stackoverflow.com/questions/21163756/html5-and-javascript-to-play-videos-only-when-visible
        $('video').each(function(){
            if ($(this).is(":in-viewport")) {
                $(this)[0].play();
            } else {
                $(this)[0].pause();
            }
        })

        // Remove preloader (https://ihatetomatoes.net/create-custom-preloading-screen/)
        $('body').addClass('loaded');
        $('.tm-current-year').text(new Date().getFullYear());

    });

</script>
</body>
</html>
