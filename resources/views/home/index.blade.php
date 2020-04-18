@extends('includes.home.base')
@section('content')
    <div class="content-container" id="home">
        <div class="section home">
            <div class="container">
                <div class="row home-row">
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
                        <div class="home-text">
                            <div class="display-1 text-center">MAGIC IS IN THE DETAILS</div>
                            <p class="white mb-5 text-center">
                                Dore is a combination of good design, quality code and
                                attention for details. <br />
                                <br />
                                We used same design language for components, layouts, apps
                                and other parts of the theme. <br />
                                <br />
                                Hope you enjoy it!
                            </p>
                            <div class="text-center">
                                @if(!Auth::user())
                                    <a class="btn btn-outline-semi-light btn-xl mr-3" href="/register">EARN MONEY</a>
                                    <a class="btn btn-outline-semi-light btn-xl" href="/register">WANT TO HIRE</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20%">
                    <div class="col-12 p-0">
                        <div class="owl-container">
                            <div class="owl-carousel home-carousel">
                                @foreach($categories as $category)
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div>
                                            <i class="iconsmind-Cupcake large-icon"></i>
                                            <h5 class="mb-0 font-weight-semibold">
                                                {{ $category->name  }}
                                            </h5>
                                        </div>
                                        <a class="btn btn-link font-weight-semibold" href="/login">VIEW</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#features" id="homeCircleButton"><i
                    class="simple-icon-arrow-down"></i></a>
        </div>

        <div class="section" style="background-color: white">
            <div class="container" id="features">
                <div class="row">
                    <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                        <h1>What is Dore</h1>
                        <p>
                            Dore is a trusted marketplace for people and businesses to outsource their tasks, whether you are looking
                            for work or you need someone to do a specific task we are here to help you hire. Skilled people can earn extra income
                            through our website or mobile app.
                            Through Dore you have an ease of access to different individuals whom you find fit for the job.
                            It works in 3 simple steps. Just post the required task to be done, chose the right person for your job by
                            checking ratings, and wait for it to be done.
                        </p>
                    </div>
                </div>

                <div class="row" style="margin-top: 13%">
                    <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                        <h1>How Things Work</h1>
                    </div>
                    <div class="col-md-3">
                        <div class="image-container" style="height: 250px; width: 250px;">
                            <img src="/images/home/post-task-3.jpg" width="250" height="250">
                        </div>
                        <div class="text-center">
                            <h3 class="text-center">Post Your Task</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="image-container" style="height: 250px; width: 250px;">
                            <img src="/images/home/bids.png" width="250" height="250">
                        </div>
                        <div class="text-center">
                            <h3 class="text-center">Review Offers</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="image-container" style="height: 250px; width: 250px;">
                            <img src="/images/home/right-tasker.png" width="250" height="250">
                        </div>
                        <div class="text-center">
                            <h3 class="text-center">Select The Right Person</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="image-container" style="height: 250px; width: 250px;">
                            <img src="/images/home/get-things-done.png" width="250" height="250">
                        </div>
                        <div class="text-center">
                            <h3 class="text-center">Get Things Done</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section background">
            <div class="container">
                <div class="row">
                    <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                        <h1>Our Beloved Workers</h1>
                        <p>
                            People love Dore. We have received lots of awesome reviews
                            for work quality, trust,
                            flexibility, features, support and other categories. Here
                            are some of them.
                        </p>
                    </div>
                    <div class="col-12 p-0">
                        <div class="owl-container">
                            <div class="owl-carousel review-carousel">
                                <div class="card">
                                    <div class="card-body text-center pt-5 pb-5">
                                        <div>
                                            <img alt="review profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto"
                                                 src="img/profile-pic-l-7.jpg" />
                                            <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                                                codebars
                                            </h5>
                                            <select class="rating" data-current-rating="5" data-readonly="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p class="text-muted text-small">Code Quality</p>
                                        </div>
                                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                                            <p class="mb-0 ">
                                                Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively
                                                coordinate proactive e-commerce via process-centric "outside the box" thinking. </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body text-center pt-5 pb-5">
                                        <div>
                                            <img alt="review profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto"
                                                 src="img/profile-pic-l-11.jpg" />
                                            <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                                                helvetica
                                            </h5>
                                            <select class="rating" data-current-rating="5" data-readonly="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p class="text-muted text-small">Code Quality</p>
                                        </div>
                                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                                            <p class="mb-0 ">
                                                Credibly innovate granular internal or "organic" sources whereas high standards in
                                                web-readiness. Energistically scale future-proof core competencies. </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body text-center pt-5 pb-5">
                                        <div>
                                            <img alt="review profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto"
                                                 src="img/profile-pic-l-2.jpg" />
                                            <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                                                logorrhea
                                            </h5>
                                            <select class="rating" data-current-rating="5" data-readonly="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p class="text-muted text-small">Code Quality</p>
                                        </div>
                                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                                            <p class="mb-0 ">
                                                Collaboratively administrate turnkey channels whereas virtual e-tailers. Objectively seize
                                                scalable metrics whereas proactive e-services.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body text-center pt-5 pb-5">
                                        <div>
                                            <img alt="review profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto"
                                                 src="img/profile-pic-l-8.jpg" />

                                            <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                                                nanaimo
                                            </h5>
                                            <select class="rating" data-current-rating="5" data-readonly="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p class="text-muted text-small">Code Quality</p>
                                        </div>
                                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                                            <p class="mb-0 ">
                                                Globally incubate standards compliant channels before scalable benefits. Quickly
                                                disseminate superior deliverables whereas web-enabled applications. </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body text-center pt-5 pb-5">
                                        <div>
                                            <img alt="review profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto"
                                                 src="img/profile-pic-l-11.jpg" />
                                            <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                                                helvetica
                                            </h5>
                                            <select class="rating" data-current-rating="5" data-readonly="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p class="text-muted text-small">Code Quality</p>
                                        </div>
                                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                                            <p class="mb-0 ">
                                                Interactively procrastinate high-payoff content without backward-compatible data. Quickly
                                                cultivate optimal processes and tactical architectures. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="slider-nav text-center">
                                <a href="#" class="left-arrow owl-prev">
                                    <i class="simple-icon-arrow-left"></i>
                                </a>
                                <div class="slider-dot-container"></div>
                                <a href="#" class="right-arrow owl-next">
                                    <i class="simple-icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section background background-no-bottom mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                        <h1>Thousands of Happy Customers</h1>
                        <p>
                            Humanitarian resist incubator movements outcomes.
                            Low-hanging fruit synergy correlation accessibility; save
                            the world unprecedented challenge scalable. Leverage
                            strategy, and, game-changer, agile, social return on
                            investment.
                        </p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="owl-container">
                            <div class="owl-carousel client-carousel">
                                <div>
                                    <img alt="client" class="img-fluid" src="img/landing-page/client-1.png" />
                                </div>
                                <div>
                                    <img alt="client" class="img-fluid" src="img/landing-page/client-2.png" />
                                </div>
                                <div>
                                    <img alt="client" class="img-fluid" src="img/landing-page/client-3.png" />
                                </div>
                                <div>
                                    <img alt="client" class="img-fluid" src="img/landing-page/client-4.png" />
                                </div>
                                <div>
                                    <img alt="client" class="img-fluid" src="img/landing-page/client-5.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
