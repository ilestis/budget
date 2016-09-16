@extends('layouts.app')

@section('content')
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Meal Planning made fun and easy</h1>
                <hr>
                <p>Meal Planner is a simple service that allows you to enter your known recipes, and help you plan your next meals.</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
        </div>
    </header>
    <section class="bg-primary big" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">We've got what you need!</h2>
                    <hr class="light">
                    <p class="text-faded">We've always wanted an intuitive, simple and easy app to plan our meals, yet never found exactly what we wanted. We've slimmed down our app to the minimum to allow you to start using it quickly and simply. Best of all? It's 100% free.</p>
                    <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="big">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">We provide</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Ease of use</h3>
                        <p class="text-muted">We've poured a lot of hard work to make our app simple and intuitive.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Mobile and Desktop</h3>
                        <p class="text-muted">Our app works perfectly on mobile and on desktop, so you access your data from anywhere, anytime.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Free</h3>
                        <p class="text-muted">Our app is free to use, no strings attached, and you automatically get all updates for free too.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">We made our app with love and we use it every day ourselves.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <aside class="bg-dark big">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Give our app a go, it's free!</h2>
                <a href="{{ url('/register') }}" class="btn btn-default btn-xl sr-button">Register Now!</a>
            </div>
        </div>
    </aside>
@endsection
