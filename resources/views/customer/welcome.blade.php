@extends('layout.customer.main')
@section('content')
    <div class="carouselContainer">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="uploads/image1.jpg" alt="First Slide">
                    <div class="carousel-caption">
                        <h3>Lorem Ipsum</h3>
                        <p>some description here</p>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/image1.jpg" alt="Second Slide">
                    <div class="carousel-caption">
                        <h3>Lorem Ipsum 2</h3>
                        <p>some description here</p>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/image1.jpg" alt="Third Slide">
                    <div class="carousel-caption">
                        <h3>Lorem Ipsum 3</h3>
                        <p>some description here</p>
                    </div>
                </div>
            </div>
            <!-- Carousel controls -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
@endsection