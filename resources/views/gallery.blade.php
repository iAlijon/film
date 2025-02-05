@extends('layouts.app')

@section('title', 'Home Gallery')


@section('content')

<div class="cd-full-width">                        
    <div class="container js-tm-page-content tm-section-margin-t" data-page-no="3">
        <div class="row tm-margin-b">
            <div class="col-xs-12">
                <div class="tm-img-gallery-container">

                    <div class="tm-img-gallery gallery-first">
                    <!-- Gallery Two pop up connected with JS code below -->

                        <div class="tm-gallery-title-container">
                            <div class="tm-bg-dark-blue tm-white-border tm-textbox-padding tm-margin-b">                                    
                                <h2 class="tm-text-title tm-gallery-title tm-margin-b-0"><span class="tm-white">First Gallery</span></h2>                                        
                            </div>
                            <div class="tm-bg-white-half"></div>
                        </div>

                        <div class="grid-item">
                            <a href="img/tm-img-01.jpg">                                                
                                <img src="img/tm-img-01-tn.jpg" alt="Image" class="img-fluid tm-img">                                              
                            </a>
                        </div>
                        <div class="grid-item">
                            <a href="img/tm-img-02.jpg">                                                
                                <img src="img/tm-img-02-tn.jpg" alt="Image" class="img-fluid tm-img">                                                
                            </a>
                        </div>
                        <div class="grid-item">
                            <a href="img/tm-img-03.jpg">                                                
                                <img src="img/tm-img-03-tn.jpg" alt="Image" class="img-fluid tm-img">                                                
                            </a>
                        </div>
                        <div class="grid-item">
                            <a href="img/tm-img-04.jpg">                                                
                                <img src="img/tm-img-04-tn.jpg" alt="Image" class="img-fluid tm-img">                                                
                            </a>
                        </div>
                        <div class="grid-item">
                            <a href="img/tm-img-05.jpg">                                                
                                <img src="img/tm-img-05-tn.jpg" alt="Image" class="img-fluid tm-img">                                                
                            </a>
                        </div>
                        <div class="grid-item">
                            <a href="img/tm-img-06.jpg">                                                
                                <img src="img/tm-img-06-tn.jpg" alt="Image" class="img-fluid tm-img">                                                
                            </a>
                        </div>                                                                           
                    </div>                                         
                </div> <!-- .tm-img-gallery-container -->  

            </div>
        </div> <!-- row -->
        <div class="row">                                
            <div class="col-xs-12">
                <div class="tm-img-gallery-container">

                    <div class="tm-img-gallery gallery-second">
                    <!-- Gallery Two pop up connected with JS code below -->

                        <div class="tm-gallery-title-container">
                            <div class="tm-bg-dark-blue tm-white-border tm-textbox-padding tm-margin-b">                                    
                                <h2 class="tm-text-title tm-gallery-title tm-margin-b-0"><span class="tm-white">Second Gallery</span></h2>                                        
                            </div>
                            <div class="tm-bg-white-half"></div>
                        </div>

                        <div class="grid-item grid-item-big">
                            <a href="img/tm-img-07.jpg">                                                
                                <img src="img/tm-img-07-tn.jpg" alt="Image" class="img-fluid tm-img-no-border">                                              
                            </a>
                        </div>
                        <div class="grid-item grid-item-big">
                            <a href="img/tm-img-08.jpg">                                                
                                <img src="img/tm-img-08-tn.jpg" alt="Image" class="img-fluid tm-img-no-border">                                                
                            </a>
                        </div>
                        <div class="grid-item grid-item-square">
                            <a href="img/tm-img-09.jpg">                                                
                                <img src="img/tm-img-09-tn.jpg" alt="Image" class="img-fluid tm-img-no-border">                                                
                            </a>
                        </div>
                        <div class="grid-item grid-item-square">
                            <a href="img/tm-img-10.jpg">                                                
                                <img src="img/tm-img-10-tn.jpg" alt="Image" class="img-fluid tm-img-no-border">                                                
                            </a>
                        </div>
                        <div class="grid-item grid-item-square">
                            <a href="img/tm-img-11.jpg">                                                
                                <img src="img/tm-img-11-tn.jpg" alt="Image" class="img-fluid tm-img-no-border">                                                
                            </a>
                        </div>
                        <div class="grid-item grid-item-square">
                            <a href="img/tm-img-12.jpg">                                                
                                <img src="img/tm-img-12-tn.jpg" alt="Image" class="img-fluid tm-img-no-border">                                                
                            </a>
                        </div>                                                                            
                    </div>                                         
                </div> <!-- .tm-img-gallery-container -->                                     
            </div>  <!-- col-xs-12 -->                          
        </div> <!-- row --> 
    </div> <!-- .container -->
                                
</div>
@endsection