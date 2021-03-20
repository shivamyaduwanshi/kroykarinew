@extends('layouts.app')
@section('content')

    <div class="navcigation padding-top">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">{{__('Home')}}</a></li>
                <li><a href="javascript:void(0)">{{__('Registration Success')}}</a></li>
            </ul>
        </div>
    </div>

    <!--post add-->
    <section class="post-ad-form">
    <div class="container" style="color:#c9c9c9;font-weight: bold">
    <div class="row justify-content-center">
        <div class="col-md-12">
                @if($status)
                  <div>
                    <h1 style="color: green">{{__('Registration successfully')}}</h1>
                    {{-- <h2 style="color:#132a5b">{{__('A verification link has been sent to your given email address')}}</h2> --}}
                      {{-- <p>{{__('Please click on the link that just has been sent to your registered email to verify email address to contune you registration process')}}</p> --}}
                  </div>
                @else
                   <div>
                    <h2>{{__('This page is no longer')}}<h2>
                  </div>
                @endif
        </div>
    </div>
</div>
    </section> <!--end-->
@endsection
