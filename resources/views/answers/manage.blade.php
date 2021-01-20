@extends('layouts.main')

@section('body')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Manage Answers for "{{$question->prompt}}"</h1>
        </div>
        <div class="col">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnswerModal" style="float: right">Add Answer</a>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Content</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @forelse($question->answers as $answer)
                  <tr>
                    <td>{{$answer->content}}</td>
                    <td>
                        <form action="{{route('quizzes.answers.destroy', ['id' => $answer->id])}}" method="POST" style="display: inline-block">
                            @csrf 
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to IRREVERSIBLY delete this item?');">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @empty 
                  <tr>
                      <td>No answers exist yet.</td>
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
<div class="modal fade" id="addAnswerModal" tabindex="-1" aria-labelledby="addAnswerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAnswerModalLabel">Add Answer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('quizzes.answers.add', ['question' => $question->id])}}" method="POST">
            @csrf 
            <div class="mb-3">
              <label for="content" class="col-form-label">Answer Content:</label>
              <input name="content" type="text" class="form-control" id="prompt" placeholder="e.g. Four" value="{{old('content')}}">
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