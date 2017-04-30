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
    <br/>
    <div class="col-lg-12">
        <div class="col-lg-4 sideInfo-item">
            <div class="sideInfo-title">How to choose the right fire extinguisher</div>
            <br/>
            Get the right kind of fire extinguisher based on the class of fire you want to extinguish.
            <a class="btn btn-primary btn-sm collapsable" data-toggle="collapse" data-target="#demo">See more</a>

            <div id="demo" class="collapse">
                <br/>
                <strong style="color: orange">DRY CHEMICAL (Mono-Ammonium Phosphate)</strong>
                <br/>applicable for Five (5) classes of fires such as, ordinary(A), flammable(B), electrical(C), and for aluminum and magnesium (D & E).
                <br/><br/>
                <strong style="color: orange">HCFC 123 CHEMICAL (1,2-Dichloro- 1,1,2-Trifluoroethane)</strong>
                <br/>Highly recommended for industrial, electronics, computer, home, and motor vehicles. (For ABC fires)
                <br/><br/>
                <strong style="color: orange">A-FFF CHEMICAL (Aqueous Film Fonning Foam - 3%)</strong>
                <br/>This extinguishant provide excellent control and extinguishment of class B fires and provides excellent penetrating
                and wetting qualities when used on class A fires.
            </div>
        </div>
        <div class="col-lg-offset-1 col-lg-3 sideInfo-item">
            <div class="sideInfo-title">Using a fire extinguisher</div>
            <br/>
            The four (4) easy steps on how to use a fire extinguisher.
            <a class="btn btn-primary btn-sm collapsable" data-toggle="collapse" data-target="#demo1">See more</a>

            <div id="demo1" class="collapse">
                <br/>
                <strong style="color: orange">PULL THE PIN</strong> at the top of the extinguisher.
                The pin releases a locking mechanism and will allow you to discharge the extinguisher.
                <br/><br/>
                <strong style="color: orange">AIM AT THE BASE OF THE FIRE</strong>, not the flames. This is important
                - in order to put out the fire, you must extinguish the fuel.
                <br/><br/>
                <strong style="color: orange">SQUEEZE THE LEVER SLOWLY</strong> This will release the extinguishing agent
                in the extinguisher. If the handle is released, the discharge will stop.
                <br/><br/>
                <strong style="color: orange">SWEEP FROM SIDE TO SIDE</strong> Using a sweeping notion, move the fire extinguisher
                back and forth until the fire is completely out. Operate the extinguisher from a safe distance,
                several feet away and then move towards the fire once it starts to diminish. Be sure to read the instructions
                on your fire extinguisher - different fire extinguishers recommend operating them from different distance
            </div>
        </div>
        <div class="col-lg-offset-1 col-lg-3 sideInfo-item">
            <div class="sideInfo-title">Maintaining fire extinguishers</div>
            <br/>
            Fire extinguishers are useless if not maintained well.
            <a class="btn btn-primary btn-sm collapsable" data-toggle="collapse" data-target="#demo2">See more</a>

            <div id="demo2" class="collapse">
                <br/>
                <strong style="color: orange">Make sure that the following are checked:</strong>
                <ul>
                    <li>
                        The extinguisher is not blocked by equipment, coats or other objects that could interfere
                        with access in an emergency
                    </li>
                    <li>
                        The pressure is at the recommended level. On extinguishers equipped with a gauge, the needle should
                        be in the green zone - not too high and not too low
                    </li>
                    <li>
                        The nozzle or other parts are not hindered in any way
                    </li>
                    <li>
                        The pin and tamper seal (if it has one) are intact
                    </li>
                    <li>
                        There are no dents, leaks, rust, chemical deposits and/or other signs of abuse/wear.
                        Wipe off any corrosive chemicals, oil, gunk, etc. that may have deposited on the extinguisher
                    </li>
                </ul>

                <strong style="color: orange">IMPORTANT:</strong> Recharge all extinguishers immediately after use
                regardless of how much they were used
            </div>
        </div>
    </div>
@endsection