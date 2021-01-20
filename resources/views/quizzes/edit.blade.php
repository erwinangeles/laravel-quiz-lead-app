@extends('layouts.main')

@section('body')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-6">
                <h1>Edit Quiz - ID {{$quiz->id}}</h1>
                <div style="margin-top: 20px">

                    <form action="{{route('quizzes.update', ['quiz' => $quiz->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="e.g. How Can I Help You?" value="{{$quiz->title}}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug:</label>
                            <input type="text" name="slug" id="slug" class="form-control"  placeholder="e.g. how-can-i-help-you" value="{{$quiz->slug}}">
                        </div>
                        
                        <div class="form-check">
                            <input name="active" class="form-check-input" type="checkbox" id="active" @if($quiz->active) checked @endif>
                            <label class="form-check-label" for="active">
                              Quiz Active
                            </label>
                          </div>

                        <button type="submit" class="btn btn-primary float-end">Update</button>

                    </form>
                </div>
            </div>
    </div>
</div>
@endsection