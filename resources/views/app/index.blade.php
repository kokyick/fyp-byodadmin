@extends('layouts.master')

@section('content')

<!--==============================content=================================-->
<div id="content">
	<!--index-->
    <script src="{{ asset('js/template/camera.js') }}"></script>
    <script src="{{ asset('js/template/jquery.mobile.customized.min.js') }}"></script>
    
    <script>	
        $(window).load( function(){	
            
        	   jQuery('.camera_wrap').camera();	 
               
        });
    </script>
    <!--==============================slider=================================-->
    <div class="slider">
        <div class="camera_wrap">
          <div data-src="img/picture1.jpg"></div>
           <!--<div data-src="img/picture2.jpg"></div>-->
          <div data-src="img/picture3.jpg"></div>
        </div>
    </div>
    <!--==============================row1=================================-->
    <div class="row_1">
        <div class="container">
            <p class="title1">Welcome to Whaletress Admin Page!</p>
            <p class="title2">In this web application, you will be able to manage your menus, payments as well as generating reports.</p>
            <!-- <a href="#" class="btn btn-default btn-lg btn1">more</a> -->
        </div>
    </div>
    <form action="{{ route('docheckuser')}}" id="checkform" name="loginform" class="reservation-form" method="POST">
        {{ csrf_field() }}
        <a href="#" onclick="checkform.submit();" class="btn-link btn-link2" data-type="submit">check<span></span></a>
    </form>

    <!--==============================row4=================================-->
<!--     <div class="row_4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 chef row4_col">
                    <h2>About Us</h2>
                    <figure><img src="img/page1_img8.jpg" alt=""></figure>
                    <p class="title3">Vivamus eget</p>
                    <p>Vitaesaert asetyertya asetrde maeciegast nieri vrtye remiad.Molirnatur aut oditaut. onsq ntmagni dolores eo qui ratione. </p>
                    <p class="m_bot1">Nasgaesaert asetyertya asetrde maeciegast nieriti vrtye remiades.Molirnatur aut oditaut.</p>
                    <a href="#" class="btn-link btn-link2">read more<span></span></a>
                </div>
                <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-3 col-md-3 col-sm-3 row4_col">
                    <h2>Latest Services</h2>
                    <ul class="list2">
                        <li><a href="#">muygasa kausyse</a></li>
                        <li><a href="#">nuyatsas lasras batsas </a></li>
                        <li><a href="#">kiaustyas</a></li>
                        <li><a href="#">batresa ksate</a></li>
                        <li><a href="#">Grerhasa mero</a></li>
                        <li><a href="#">Lanytadas nyats</a></li>
                        <li><a href="#">nuyatsas lasras batsas</a></li>
                        <li><a href="#">batresa </a></li>
                    </ul>
                </div>
                <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-3 col-md-3 col-sm-3 locations row4_col">
                    <h2>Locations</h2>
                    <figure><img src="img/smalllogo1.png" alt=""></figure>
                    <p class="title4">28 Jackson Blvd Ste 1020<br>Chicago<br>IL 60604-2340</p>
                    <hr class="line1">
                    <a href="#" class="btn-link btn-link3"><span></span>info@whaletress.org</a>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection