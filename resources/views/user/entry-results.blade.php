@extends("layouts.user")

@section('title')
    Entry Results | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA ENTRY</h4>

                <form action="{{ route('entry-results.showEntryResults', ['assignTestId' => $assignTestId]) }}" method="GET">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="lab_id" class="col-form-label">Lab:</label>
                        <select name="lab_id" class="form-control" id="lab_id">
                            @foreach ($assignTests as $assignTest)
                                @if ($assignTest->lab)
                                    <option value="{{ $assignTest->lab->id }}">{{ $assignTest->lab->labname }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="prog_id" class="col-form-label">Program:</label>
                        <select name="prog_id" class="form-control" id="prog_id">
                            @foreach ($assignTests as $assignTest)
                                @if ($assignTest->program)
                                    <option value="{{ $assignTest->program->id }}">
                                        {{ $assignTest->program->programname }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="instrument_id" class="col-form-label">Instrument:</label>
                        <select name="instrument_id" class="form-control" id="instrument_id">
                            @foreach ($assignTests as $assignTest)
                                @if ($assignTest->instrument)
                                    <option value="{{ $assignTest->instrument->id }}">
                                        {{ $assignTest->instrument->instrumentname }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="reagent_id" class="col-form-label">Reagent:</label>
                        <select name="reagent_id" class="form-control" id="reagent_id">
                            @foreach ($assignTests as $assignTest)
                                @if ($assignTest->reagent)
                                    <option value="{{ $assignTest->reagent->id }}">
                                        {{ $assignTest->reagent->reagent }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Listing table for results (initially hidden) -->
                    <table class="table" id="listingTable" style="display: none;">
                        <thead>
                            <tr>
                                <th>Test Code</th>
                                <th>Result</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entryResults as $test)
                                <tr>
                                    <td>{{ $test->testcode }}</td>
                                    <td>
                                        <input type="text" name="results[{{ $test->testcode }}]" class="form-control">
                                    </td>
                                    <td>{{ $test->unit }}</td>
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

<script>
    function fetchAssignTestId() {
        const assignTestId = {{ $assignTestId }}; // Pass the assignTestId from the controller

        // Perform an AJAX request to fetch lab_id based on assignTestId
        fetch(`/get-assign-test-id/${assignTestId}`)
            .then(response => response.json())
            .then(data => {
                if (data.assignTestId) {
                    window.location.href = `/entry-results/${data.assignTestId}`;
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

@endsection
