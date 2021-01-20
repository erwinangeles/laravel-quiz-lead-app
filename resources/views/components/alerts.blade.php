
@if ($errors->any())
    <div>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops! The following errors occured:</strong>
           <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
           </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session()->has('message'))
<div>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@section('scripts')

<script>
    $(".alert").delay(4000).slideUp(200, function() {
        $(this).alert('close');
    });
</script>
@endsection