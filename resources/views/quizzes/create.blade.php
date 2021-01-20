@extends('layouts.main')

@section('body')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-6">
                <h1>Create Quiz</h1>
                <div style="margin-top: 20px">

                    <form action="{{route('quizzes.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="e.g. How Can I Help You?">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug:</label>
                            <input type="text" name="slug" id="slug" class="form-control"  placeholder="e.g. how-can-i-help-you">
                        </div>

                        <button type="submit" class="btn btn-primary float-end">Create</button>

                    </form>
                </div>
            </div>
    </div>
</div>
@endsection