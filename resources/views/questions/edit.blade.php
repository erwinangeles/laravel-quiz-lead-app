@extends('layouts.main')

@section('body')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-6">
                <h1>Edit Question - ID {{$question->id}}</h1>
                <div style="margin-top: 20px">

                    <form action="{{route('quizzes.questions.update', ['question' => $question->id])}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Prompt:</label>
                            <input type="text" name="prompt" id="prompt" class="form-control" placeholder="e.g. What is 2+2?" value="{{$question->prompt}}">
                            </div>
                        </div>
                        
                        <div class="form-check">
                            <input name="allowCustomAnswer" class="form-check-input" type="checkbox" id="allowCustomAnswer" @if($question->allowCustomAnswer) checked @endif>
                            <label class="form-check-label" for="allowCustomAnswer">
                                Allow custom answer?
                            </label>
                          </div>

                        <button type="submit" class="btn btn-primary float-end">Update</button>

                    </form>
                </div>
            </div>
    </div>
</div>
@endsection