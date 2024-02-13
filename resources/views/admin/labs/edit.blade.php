@extends("layouts.master")

@section('title')
    Edit - Lab | ADEQA
@endsection

@section('scripts')
<script>
    // Check if the current URL contains "/programs"
    if (window.location.href.includes("./programs")) {
        // Disable the "Program Setup" sidebar link
        document.getElementById("program-setup-link").removeAttribute("href");
    }
</script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - LAB</h4>

                <form action="{{ url('labs-update/'.$lab->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Lab Name:</label>
                      <input type="text" name="labname" class="form-control" value="{{ $lab->labname }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Institution:</label>
                        <select name="institution_id" class="form-control" id="institution_id">
                            @foreach($institution as $inst)
                                <option value="{{ $inst->id }}" {{ $inst->id == $lab->institution_id ? 'selected' : '' }}>
                                    {{ $inst->institution }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('labs') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
