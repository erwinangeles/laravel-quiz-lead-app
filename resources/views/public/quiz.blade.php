@extends('layouts.public')

@section('head')
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Lato', sans-serif;
    }
    #secondLogo{
        width: 250px;
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
    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div style="text-align: center">
                <img id="secondLogo" src="{{asset('img/logo.png')}}" />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" style="padding: 30px">
            <a class="btn btn-primary btn-lg" href="{{route('view.quizstep', ['slug' => $quiz->slug,'question' => $quiz->questions()->first()->id])}}@if(request()->get('lightbox'))?lightbox=true @endif">Start Quiz</a>
        </div>
    </div>

    {{-- <div class="container" style="padding: 30px">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">55%</div>
          </div>
    </div> --}}
@endsection

@section('scripts')
    <script>
        $( document ).ready(function() {
            localStorage.clear();
        });
    </script>
@endsection