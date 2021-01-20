@extends('layouts.main')

@section('body')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Manage Quiz Questions for "{{$quiz->title}}"</h1>
        </div>
        <div class="col">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal" style="float: right">Add Question</a>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Prompt</th>
                  <th>Allow Custom Answer</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @forelse($quiz->questions as $question)
                  <tr>
                    <td><a href="{{route('quizzes.questions.edit', ['question' => $question->id])}}">{{$question->prompt}}</a></td>
                    <td>
                      @switch($question->allowCustomAnswer)
                      @case(true)
                      <span class="badge bg-primary">Yes</span>
                          @break
                      @case(false)
                      <span class="badge bg-secondary">No</span>
                          @break
                      @default
                      <span class="badge bg-secondary">NULL</span>
                  @endswitch
                    </td>
                    <td>
                        <a href="{{route('quizzes.answers.manage', ['question' => $question->id])}}" class="btn btn-sm btn-warning text-white">Manage Answers ({{$question->answers->count()}})</a>

                        <form action="{{route('quizzes.questions.destroy', ['id' => $question->id])}}" method="POST" style="display: inline-block">
                            @csrf 
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to IRREVERSIBLY delete this item?');">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @empty 
                  <tr>
                      <td>No questions exist yet.</td>
                      <td>

                      </td>
                  </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
    </div>
</div>



{{-- Modal to add new question --}}
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addQuestionModalLabel">Add new Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('quizzes.questions.add', ['quiz' => $quiz->id])}}" method="POST">
            @csrf 
            <div class="mb-3">
              <label for="prompt" class="col-form-label">Prompt:</label>
              <input name="prompt" type="text" class="form-control" id="prompt" placeholder="e.g. What is 2+2?" value="{{old('prompt')}}">
            </div>
            <button type="submit" class="btn btn-primary">Save & Close</button>
          </form>
        </div>
        <div class="modal-footer">
          <a data-bs-dismiss="modal" href="#">Cancel</a>
        </div>
      </div>
    </div>
  </div>


@endsection