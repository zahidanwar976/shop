@extends('theme-views.layouts.app')

@section('title', translate('Cancellation_Policy').' | '.$web_config['name']->value.' '.translate(' Ecommerce'))

@section('content')

<!-- Main Content -->
<main class="main-content d-flex flex-column gap-3 pb-3">
    <div class="page-title overlay py-5 __opacity-half" style="--opacity: .5" data-bg-img="{{theme_asset('assets/img/media/page-title-bg.png')}}">
        <div class="container">
            <h1 class="absolute-white text-center">{{translate('Cancellation_Policy')}}</h1>
        </div>
    </div>
    <div class="container">
        <div class="card my-4">
            <div class="card-body p-lg-4 text-dark page-paragraph">
                {!! $cancellation_policy !!}
            </div>
        </div>
    </div>
</main>
<!-- End Main Content -->

@endsection
