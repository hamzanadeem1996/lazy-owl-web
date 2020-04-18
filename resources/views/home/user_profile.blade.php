@extends('includes.home.base')
@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesgeet" href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">

<div class="content-container" id="home" style="background: #FFFFFF">
    <div class="section home subpage">
        <div class="container">
            <div class="row home-row">
                <div class="col-12 col-xl-5 col-lg-12 col-md-12">
                    <div class="home-text">
                        <div class="display-1">
                            Profile
                        </div>
                        <p class="white mb-5">
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#content" id="homeCircleButton"><i
                class="simple-icon-arrow-down"></i></a>
    </div>

    <div class="section" style="margin-top: 10%">
        <div class="container" id="content">
            <div class="profile-page">
                <div class="main main-raised">
                    <div class="profile-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 ml-auto mr-auto">
                                    <div class="profile">
                                        <div class="avatar">
                                            @if ($user->image)
                                                <img src="/images/user/{{$user->image}}" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                                            @else
                                                <img src="/images/user/dummy.png" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                                            @endif
                                        </div>
                                        <div class="name">
                                            <h3 class="title">{{$user->name}}</h3>
                                            <select class="rating" @if(isset($user->ratings[0]))data-current-rating="{{$user->ratings[0]->rating}}" @else data-current-rating="0" @endif data-readonly="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="description text-center">
                                <p>
                                    @if ($user->description)
                                        {{$user->description}}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ml-auto mr-auto">
                                    <div class="profile-tabs">
                                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                                <i class="material-icons">camera</i>
                                                About
                                            </a>
                                        </li>

                                        <li class="nav-item" @if ($user->role == 2)
                                            style="display: none"
                                        @endif>
                                            <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                                <i class="material-icons">palette</i>
                                                Work
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#favorite" role="tab" data-toggle="tab">
                                                <i class="material-icons">favorite</i>
                                                Reviews
                                            </a>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    
                        <div class="tab-content tab-space">
                            <div class="tab-pane active gallery" id="studio">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h3>Gender:</h3>
                                                <h3>City:</h3>
                                                <h3>Status:</h3>
                                                <h3>Address:</h3>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <h3 style="color: black;">
                                                    @if ($user->gender)
                                                        {{$user->gender}}   
                                                    @else
                                                        -
                                                    @endif
                                                </h3>
                                                <h3 style="color: black">
                                                    @if ($user->city)
                                                        {{$user->city}}   
                                                    @else
                                                        -
                                                    @endif
                                                </h3>
                                                @if ($user->email_verified_at !== null)
                                                    <h3 style="color: black">Verified</h3>
                                                @else
                                                    <h3 style="color: red">Not Verified</h3>
                                                @endif
                                                <h3 style="color: black">
                                                    @if ($user->address)
                                                        {{$user->address}}   
                                                    @else
                                                        -
                                                    @endif
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-center gallery" id="works">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-4 text-left">
                                                <h3>Tasks Completed:</h3>
                                                <h3>Portfolio:</h3>
                                                <h3>Services:</h3>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <h3 style="color: black;">
                                                    {{$user->tasks_count}}
                                                </h3>
                                                
                                                <h3 style="color: black;">
                                                    @if($user->portfolio)
                                                        <a style="color: #922c88" href="/portfolio/{{$user->portfolio->media}}" download><i class="fa fa-download"></i></a> {{$user->portfolio->media}}
                                                    @else
                                                        -
                                                    @endif
                                                </h3>
                                                    
                                                @if(count($user->services) > 0)
                                                    @foreach ($user->services as $item)
                                                        <h3 style="color: black;">
                                                            <i class="fa fa-angle-double-right"></i> {{$item->category->name}} - {{$item->sub_category->name}}
                                                        </h3>
                                                    @endforeach
                                                @else
                                                    <h3> - </h3>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-center gallery" id="favorite">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6 text-left" style="max-height: 400px; overflow-y: scroll;">
                                        @if (isset($user->reviews))
                                            @if(count($user->reviews) > 0)
                                                @foreach ($user->reviews as $review)
                                                    <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                                        <a href="/active/task/poster/{{$review->user->id}}">
                                                            <img @if($review->user->image !== null) src="/images/user/{{$review->user->image}}" @else src="/images/user/dummy.png" @endif alt="Kathryn Mengel" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                        </a>
                                                        <div class="pl-3 pr-2">
                                                            <a href="/active/task/poster/{{$review->user->id}}">
                                                                <h6 class="font-weight-medium mb-0">{{$review->user->name}}</h6>
                                                                <p>{{$review->review}}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <h4>No Review Available</h4>
                                            @endif
                                        @else
                                            <h4>No Review Available</h4>
                                        @endif
                                        
                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
@stop