@extends('includes.home.base')
@section('content')
<div class="content-container" id="home">
    <div class="section home subpage">
        <div class="container">
            <div class="row home-row">
                <div class="col-12 col-xl-5 col-lg-12 col-md-12">
                    <div class="home-text">
                        <div class="display-1">
                            Explore millions of active tasks by our customers 
                        </div>
                        <p class="white mb-5">
                            At lazy owl you will interact with people from around the globe providing you business.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#content" id="homeCircleButton"><i
                class="simple-icon-arrow-down"></i></a>
    </div>

    <div class="section">
        <div class="container" id="content">

            <div class="row">
                <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                    <h1>Active Tasks</h1>
                </div>
            </div>

            <div class="row mt-5 feature-icon-container">
                @foreach ($projects as $project)
                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div>
                                    <i class="iconsmind-Male large-icon"></i>
                                    <h3 class="mb-4 font-weight-semibold">{{$project->title}}</h3>
                                    <p class="mb-4 font-weight-semibold">{{$project->category->name}}</p>
                            
                                    <p class="mb-4 font-weight-semibold">PKR {{$project->budget}}</p>
                                    <p class="mb-4 font-weight-semibold">{{$project->location}}</p>
                                </div>
                                <div>
                                    <a href="/active/tasks/{{$project->id}}" class="btn btn-link btn-empty btn-lg">DETAILS <i class="simple-icon-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@stop