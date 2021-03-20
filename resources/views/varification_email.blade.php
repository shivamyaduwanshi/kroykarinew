@extends('layouts.app')
@section('content')

    <div class="navcigation padding-top">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">{{__('Home')}}</a></li>
                <li><a href="javascript:void(0)">{{__('Email Verification')}}</a></li>
            </ul>
        </div>
    </div>

    <!--post add-->
    <section class="post-ad-form">
    <div class="container" style="text-align: center;color:#c9c9c9;font-weight: bold;font-size: 64px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($status == '1')
                <div>
                  <h2>{{__('Email successfully Verified')}}<h2>
                </div>
            @endif
            @if($status == '2')
                <div>
                   <h2>{{__('This page is no longer')}}<h2>
                </div>
            @endif
            @if($status == 3)
                <div> 
                 <h2> {{__('Faild to verify email')}} </h2>
                </div>
            @endif
        </div>
    </div>
</div>
    </section> <!--end-->

    <div class="google-ads google-ads2">
        <div class="container">
            <img src="{{asset('frontend')}}/images/ad3.jpg" alt="google ad" class="img-fluid">
        </div>
    </div>
@endsection