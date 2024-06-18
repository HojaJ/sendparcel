<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>


    <!-- bootstrap core css -->
    <title>Send Parcel</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}"/>
    <!-- responsive style -->
    <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet"/>
</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="/">
                    <img style="max-width: 100px;" src="{{ asset('logo_colo.png') }}" alt="Logo">
                </a>

                <div class="user_option">
                    <div class="mr-3">
                        @include('frontend.includes.language')
                    </div>

                    <a class="mt-2" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
        <div class="slider_container">
            <div class="img-box">
                <img src="{{ asset('front/images/hero-img.jpg') }}" alt="">
            </div>
        </div>
    </section>
    <!-- end slider section -->
</div>


<!-- car section -->

<section class="car_section layout_padding2-top layout_padding-bottom">
    <div class="container">
        <div class="heading_container">
            <h2>
                {{ __("Deliver Delight - Where Every Parcel is Priority!") }}
            </h2>
            <p>
                {{ __("Every package sent with this service is treated as the most important one. It's a pledge of quality and care, ensuring that every delivery is a delightful experience for the customer.") }}
            </p>
        </div>
        <div class="car_container">
            <div class="box">
                <div class="img-box">
                    <img src="{{ asset('front/images/parcel.png') }}" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        {{ __("Send Your Parcel!") }}
                    </h5>
                    <p>
                        {{ __("Send Your Parcel! is more than just a service—it's a promise that every package is delivered with care, ensuring satisfaction and smiles at every destination.") }}
                    </p>

                    @if (Auth::check())
                        <a href=" {{  route('backend.dashboard') }}">
                            @else
                                <a href=" {{  route('register', ['type' => 'client']) }}">
                                    @endif
                                    {{__("Try it")}}
                                </a>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="{{ asset('front/images/c-3.png') }}" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        {{ __("Become a Transporter!") }}
                    </h5>
                    <p>
                        {{ __("Embrace the journey of a transporter, where every delivery is more than just a task—it's a commitment to excellence and a seamless experience for every customer.") }}
                    </p>
                    @if (Auth::check())
                        <a href=" {{  route('backend.dashboard') }}">
                            @else
                                <a href=" {{  route('register', ['type' => 'deliveryman']) }}">
                                    @endif
                                    {{__("Try it")}}
                                </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end car section -->


<!-- best section -->

<section class="best_section">
    <div class="container">
        <div class="book_now">
            <div class="detail-box">
                <h2>
                    {{__("Our Best Cars")}}
                </h2>
            </div>
        </div>
    </div>
</section>

<!-- end best section -->

<!-- rent section -->

<section class="rent_section layout_padding">
    <div class="container">
        <div class="rent_container">
            @foreach($cars as $car)
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset($car->image) }}" alt="Car">
                    </div>
                    <h4 class="car_title">{{ $car->name }}</h4>

                    <div style="display: flex;     width: 100%;justify-content: space-between;align-self: flex-start; align-items: center">
                        <span style="    font-size: 13px;">{{$car->from_city->name}} - {{$car->to_city->name}} </span>
                        <span class="time">{{\Carbon\Carbon::make($car->date)->format('Y-m-d H:i')}}</span>
                    </div>
                    <div style="display: flex;  margin-top: 5px;   width: 100%;justify-content: space-between;align-self: flex-start; align-items: center">
                        <span style="align-self: flex-start;" class="capacity">{{ __('Capacity') }}: {{ $car->capacity }} (kg)</span>
                        <span class="time">{{ __('Busy') }}: {{ $car->busy }}(kg)</span>
                    </div>
                    @if (Auth::check())
                        <button
                                data-capacity="{{$car->capacity}}"
                                data-title="{{ $car->name }}"
                                data-id="{{ $car->id }}"
                                type="button"
                                class="btn my-3 btn-primary"
                                data-toggle="modal"
                                data-target="#exampleModal">
                            {{ __('Send Your Parcel!') }}
                        </button>
                    @else
                        <a class="btn my-3 btn-primary" href=" {{  route('register', ['type' => 'deliveryman']) }}">
                            {{__("Try it")}}
                        </a>

                    @endif

                </div>
            @endforeach
        </div>
        <div class="btn-box">
            <a href="{{ route('frontend.cars_all') }}">
                {{__('See More')}}
            </a>
        </div>
    </div>
</section>
<!-- contact section -->

<section class="contact_section layout_padding">
    <div class="container">
        <div class="contact_items">

            <a href="">
                <div class="img-box">
                    <img src="{{ asset('front/images/location.png') }}" alt="">
                </div>
                <h6>
                    Ashgabat, Turkmenistan
                </h6>
            </a>
            <a href="">
                <div class="img-box">
                    <img src="{{ asset('front/images/call.png') }}" alt="">
                </div>
                <h6>
                    (+99365555555)
                </h6>
            </a>
            <a href="">
                <div class="img-box">
                    <img src="{{ asset('front/images/mail.png') }}" alt="">
                </div>
                <h6>
                    email@gmail.com
                </h6>
            </a>

        </div>
        <div class="social_container">
            <div class="social-box">
                <div>
                    <a href="">
                        <img src="{{ asset('front/images/fb.png') }}" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img src="{{ asset('front/images/twitter.png') }}" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img src="{{ asset('front/images/linkedin.png') }}" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img src="{{ asset('front/images/insta.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer section -->
<footer class="container-fluid footer_section">
    <p>
        Copyright &copy; 2024 {{ __("All Rights Reserved") }}.
    </p>
</footer>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Send Your Parcel!') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('frontend.update_parcel') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="car_title"></h4>
                    <span class="capacity">{{ __('Capacity') }} (kg):  <span class="capacity_"></span></span>
                    <input type="number" name="weight" class="form-control mt-3" style="max-width: 200px"/>
                    <input type="hidden" name="id" class="car_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- footer section -->

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script>
    $(document).ready(function () {

        $('#exampleModal').on('show.bs.modal', function (event) {
            var modal = $(this)
            modal.find('.modal-body .car_id').val('')
            var button = $(event.relatedTarget)
            var car_name = button.attr('data-title')
            var capacity = button.attr('data-capacity')
            var id = button.attr('data-id')
            modal.find('.modal-body .car_title').text(car_name)
            modal.find('.modal-body .capacity_').text(capacity)
            modal.find('.modal-body .car_id').val(id)
        })
    });

</script>

</body>

</html>