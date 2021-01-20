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
    <div class="container" style="margin-top: 20px">
        <div class="row">
          <div style="text-align: center">
            <img id="secondLogo" src="{{env("SECOND_LOGO")}}"/>
          </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col" style="text-align: center; padding: 20px;">
                <h2>Great job! You've finished the quiz!</h2>
                <h3> Now confirm your email!</h3>
            </div>
        </div>

                <div class="row justify-content-md-center">
                    <div class="col-lg-6" style="margin-bottom: 20px;"> 
                      <div style="display: none">
                        <form id="form" action="{{route('mail.send', ['quiz' => $quiz->id])}}" method="POST">
                          @csrf
                          <input name="name" value="" id="name">
                          <input name="email" value="" id="email">
                          @foreach($quiz->questions as $question)
                            <input name="{{$question->id}}" id="{{$question->id}}"  value=""/>
                            <script>
                              var val = localStorage.getItem("{{$question->id}}");
                              document.getElementById("{{$question->id}}").setAttribute('value', val);
                            </script>
                          @endforeach
                        </form>
                      </div>
                        <form action="{{env('CONTACTLIST_FORM_URL')}}" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup">
                                <div id="mc_embed_signup_scroll">
                            <!-- <div class="indicates-required"><span class="asterisk">*</span> indicates required</div> -->
                            <div class="mc-field-group mb-3">
                                <label for="mce-EMAIL">Name  <span class="asterisk">*</span>
                              </label>
                                <input type="text" value="" name="MMERGE6" class="required form-control" id="mce-MMERGE6" aria-required="true">
                              </div>
                              <div class="mc-field-group mb-3">
                                <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                              </label>
                                <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" aria-required="true">
                              </div>
                              <div id="mce-responses" class="clear">
                                <div class="response alert alert-danger" role="alert" id="mce-error-response" style="display:none"></div>
                                <div class="response alert alert-success" role="alert" id="mce-success-response" style="display:none"></div>
                              </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_5b880f38003650153672f9ee6_e57dab55f0" tabindex="-1" value=""></div>
               
                                </div>
                                
                                  <!-- <div class="clear"> -->
                                    <input type="submit" value="TAKE ME TO THE NEXT STEP" name="subscribe" id="mc-embedded-subscribe" class="btn btn-success" style="width: 100%; margin-top: 5px">
                                  <!-- </div> -->
                            </div>
                            <script type="text/javascript" src="https://s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                            <!--End mc_embed_signup-->
                        </form>
                    </div>
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

            $('body').on('DOMSubtreeModified', '#mce-success-response', function(){
              let name = $("#mce-MMERGE6").val();
              let email = $("#mce-EMAIL").val();

              $("#name").val(name);
              $("#email").val(email);
              $( "#form" ).submit();

            });

        });
    </script>
@endsection