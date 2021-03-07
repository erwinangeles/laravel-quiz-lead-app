@extends('layouts.public')

@section('head')
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Lato', sans-serif;
    }
    #secondLogo{
        width: 200px;
        height: auto;
    }
    @media only screen and (max-width: 600px) {
  #secondLogo {
    width: 40%;
    height: auto;
  }
}
</style>
@endsection
@section('body')
{{-- @if(!request()->get('lightbox'))

    <div class="container" style="margin-top: 20px">
        <div class="row">
          <div style="text-align: center">
            <img id="secondLogo" src="{{env("SECOND_LOGO")}}"/>
            <h1>Thank you!</h1>

          </div>
        </div>
    </div>
@endif --}}

    <div class="container">
        <div class="row">
            <div class="col" style="text-align: center; padding: 20px;">
              <iframe width="100%" height="500px" src="{{env('THANKYOU_VIDEO_URL')}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <div class="container" style="margin-top: 20px">
          <div class="row">
            <div style="text-align: center">
             <a href="{{env("THANKU_URL")}}" class="btn btn-primary" style="width: 50%">Sign Up Now</a>

            </div>
          </div>
      </div>
    {{-- <div class="container" style="padding: 30px">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">55%</div>
          </div>
    </div> --}}
@endsection
