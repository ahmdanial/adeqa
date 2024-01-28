@extends("layouts.user")

@section('title')
    Entry Results Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA ENTRY</h4>

                <form action="{{ route('entry-results.update', ['assignTestId' => $assignTestId]) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="lab_id" class="col-form-label">Lab:</label>
                        <input type="text" name="lab_id" class="form-control" value="{{ $assignTest->lab->labname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="prog_id" class="col-form-label">Program:</label>
                        <input type="text" name="prog_id" class="form-control" value="{{ $assignTest->program->programname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="instrument_id" class="col-form-label">Instrument:</label>
                        <input type="text" name="instrument_id" class="form-control" value="{{ $assignTest->instrument->instrumentname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="reagent_id" class="col-form-label">Reagent:</label>
                        <input type="text" name="reagent_id" class="form-control" value="{{ $assignTest->reagent->reagent }}" readonly>
                    </div>

                    <!-- Listing table for results -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Test Code</th>
                                <th>Result</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subAssignTests as $subAssignTest)
                                <tr>
                                    <td>{{ $subAssignTest->testcode }}</td>
                                    <td>
                                        <input type="text" name="results[{{ $subAssignTest->testcode }}]" class="form-control">
                                    </td>
                                    <td>{{ $subAssignTest->unit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ENTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
