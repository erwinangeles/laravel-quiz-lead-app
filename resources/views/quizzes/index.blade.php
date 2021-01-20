@extends('layouts.main')

@section('body')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Quizzes</h1>
        </div>
        <div class="col">
            <a class="btn btn-primary" style="float: right" href="{{route('quizzes.create')}}">Create Quiz</a>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->id}}</td>
                        <td>{{$quiz->title}}</td>
                        <td>{{$quiz->slug}}</td>
                        <td>
                            @switch($quiz->active)
                                @case(true)
                                <span class="badge bg-success">ACTIVE</span>
                                    @break
                                @case(false)
                                <span class="badge bg-danger">NOT ACTIVE</span>
                                    @break
                                @default
                                <span class="badge bg-secondary">NULL</span>
                            @endswitch
                        </td>
                        <td>
                            <a href="{{route('quizzes.edit', ['quiz' => $quiz->id])}}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{route('quizzes.questions.manage', ['quiz' => $quiz->id])}}" class="btn btn-sm btn-info text-white">Manage Questions ({{$quiz->questions->count()}})</a>

                            <form action="{{route('quizzes.destroy', ['quiz' => $quiz->id])}}" method="POST" style="display: inline-block">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to IRREVERSIBLY delete this item?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Nothing found</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
    </div>
</div>
@endsection