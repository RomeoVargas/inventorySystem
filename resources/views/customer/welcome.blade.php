@extends('layout.main')
@section('content')
    <div class="carouselContainer">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{ url('img/carousel/carousel-image1.jpg') }}" alt="First Slide">
                    <div class="carousel-caption">
                        <h3>Be prepared for emergencies!</h3>
                        <p>Here in checon industries, we manufacture top of the class emergency tools so that you don't have to worry for blackouts, storms, or any unexpected events</p>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ url('img/carousel/carousel-image2.jpg') }}" alt="Second Slide">
                    <div class="carousel-caption">
                        <h3>Safety and mobility? No problem</h3>
                        <p>Checon manufactures supply of portable and wheel type Fire extinguishers so you don't have to carry that heavy thing around anymore</p>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ url('img/carousel/carousel-image3.jpg') }}" alt="Third Slide">
                    <div class="carousel-caption">
                        <h3>Mind your safety</h3>
                        <p>You won't need to be too cautious anymore knowing that you have the best safety gears provided by us.
                            We can provide supply of Safety Helmet, Safety Shoes and other Safety Products</p>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ url('img/carousel/carousel-image4.jpg') }}" alt="Fourth Slide">
                    <div class="carousel-caption">
                        <h3>Use the best fire fighting gears</h3>
                        <p>Checon manufactures saturn brand fire fighting gears and offer services such as
                            Refilling and servicing of Local and imported Fire Extinguisher</p>
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