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
@if(!request()->get('lightbox'))
    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div style="text-align: center">
                <img id="secondLogo" src="{{asset("img/logo.png")}}"/>
            </div>
        </div>
    </div>
@endif
    <div class="container">

        <div class="row">
            <div class="col" style="text-align: center; padding: 40px 0px;">
                <h2>{{$currentStep->prompt}}</h2>
            </div>
        </div>

                <div class="row" style="margin-bottom: 50px">
                    @foreach($currentStep->answers as $answer)
                    <div class="col" style="margin-bottom: 5px;">
                        <button type="button" class="btn btn-lg btn-outline-success btn-answer" data-answer="{{$answer->id}}" data-question="{{$currentStep->id}}" data-final="@if(!$nextStep)true @endif" style="width: 100%">{{$answer->content}}</button>
                    </div>
                    @endforeach

                    @if($currentStep->allowCustomAnswer)
                    <div class="col" style="margin-bottom: 5px;">
                        <input id="customAnswer" type="text" class="form-control" style="width: 100%; margin-bottom: 5px" placeholder="Type your answer...">
                        <button id="submitCustomAnswer" class="btn btn-primary btn-custom" data-question="{{$currentStep->id}}" data-final="@if(!$nextStep)true @endif" style="width: 100%">Next</button>
                    </div>
                    @endif
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
            $(document).on('click', '.btn-answer', function(){
                let question = $(this).data('question');
                let answer = $(this).data('answer');

                localStorage.setItem(question, answer);
                
                if($(this).data('final')){
                    window.location = "{{route('quiz.complete', ['quiz' => $quiz->slug])}}" @if(request()->get('lightbox')) + "?lightbox=true" @endif;

                }else{
                    window.location = "{{route('view.quizstep', ['slug' => $quiz->slug,'question' => $nextStep])}}" @if(request()->get('lightbox')) + "?lightbox=true" @endif;

                }
            });


            $(document).on('click', '.btn-custom', function(){
                let question = $(this).data('question');
                let answer = $('#customAnswer').val();

                if(answer){
                    localStorage.setItem(question, "CUSTOM-" + answer);
                    if($(this).data('final')){
                        window.location = "{{route('quiz.complete', ['quiz' => $quiz->slug])}}" @if(request()->get('lightbox')) + "?lightbox=true" @endif;

                    }else{
                        window.location = "{{route('view.quizstep', ['slug' => $quiz->slug,'question' => $nextStep])}}" @if(request()->get('lightbox')) + "?lightbox=true" @endif;

                    }
                }else{
                    alert('Please enter a valid answer.');
                }
            });

            $('#customAnswer').keyup(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $('#submitCustomAnswer').click();
                    return false;  
                }
            });   



        });
    </script>
@endsection