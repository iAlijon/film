@extends('layouts.app')

@section('title', 'Contacts Page')


@section('content')

<div class="cd-full-width">
    <div class="container js-tm-page-content tm-section-margin-t-small" data-page-no="4">                            
        <div class="tm-contact-page">
            <div class="row tm-margin-b">
                <div class="col-xs-12">
                    <div class="tm-bg-white tm-textbox-padding">
                        <h2 class="tm-text-title tm-margin-b-0">Contact Us</h2>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="tm-flex tm-contact-container tm-bg-dark-blue">                                
                        <div class="text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding tm-textbox-padding-contact">
                            <p class="tm-text">Phasellus lacus mi, porta vel sodales nec, faucibus non eros. Nulla at quam vel risus laoreet tincidunt in in sem.</p>                                                                                                                                                 
                            <p class="tm-text">88-99 Etiam mauris erat,<br>Vestibulum eu augue nec, 10890<br>Nam consequat<br></p>
                            <p class="tm-text">Tel: 010-020-0340<br>Fax: 090-080-0980</p>
                        </div>

                        <div class="text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding tm-textbox-padding-contact">
                            <!-- contact form -->
                            <form action="index.html" method="post" class="tm-contact-form">
                                <div class="form-group">
                                    <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name"  required/>
                                </div>                                                                                                            
                                <div class="form-group">
                                    <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"  required/>
                                </div>                                                    
                                <div class="form-group">
                                    <textarea id="contact_message" name="contact_message" class="form-control" rows="5" placeholder="Your message" required></textarea>
                                </div>
                                <button type="submit" class="tm-submit-btn">Send</button>                                                
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                        
</div> 
@endsection