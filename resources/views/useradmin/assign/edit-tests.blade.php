@extends("layouts.admin")

@section('title')
    Assign Test - Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT ASSIGN TEST </h4>

              <form action="{{ url('assign-tests-update/'.$assignTest->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Lab:</label>
                    <select name="lab_id" class="form-control" id="lab_id">
                        @foreach($labs as $lab)
                            <option value="{{ $lab->id }}" {{ $lab->id == $assignTest->lab_id ? 'selected' : '' }}>
                                {{ $lab->labname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Program:</label>
                    <select name="prog_id" class="form-control" id="prog_id">
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ $program->id == $assignTest->prog_id ? 'selected' : '' }}>
                                {{ $program->programname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="institution_id" class=" col-form-label">Institution:</label>
                        <select name="institution_id" class="form-control dynamic" id="institution_id" data-dependent="instrument_id">
                            <option value="">-- Select Institution --</option> <!-- Added this line for the initial option -->
                            @foreach($institutions as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->institution }}</option>
                            @endforeach
                        </select>
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Instrument:</label>
                    <select name="instrument_id" class="form-control dynamic" id="instrument_id" data-dependent="reagent_id">
                        <option>-- Select instrument id --</option>
                        @foreach($instruments as $instrument)
                            <option value="{{ $instrument->id }}">
                                {{ $instrument->instrumentname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Reagent:</label>
                    <select name="reagent_id" class="form-control dynamic" id="reagent_id" data-dependent="testcode" disabled>
                        <option>-- Select reagent id --</option>
                        @foreach($reagents as $reagent)
                            <option value="{{ $reagent->id }}">
                                {{ $reagent->reagent }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="testcode" class="col-sm-3 col-form-label">Test:</label>
                    <div class="col-sm-9" id="testcode-container" style="display: none;">
                        <div class="row">
                            @foreach($tests as $test)
                                <div class="col-sm-3">
                                    <div class="form-check1">
                                        <input type="checkbox" class="form-check-input1" name="testcodes[]" value="{{ $test->testcode }}" id="test_{{ $test->testcode }}" {{ in_array($test->testcode, old('testcodes', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="test_{{ $test->testcode }}">{{ $test->testname }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{ url('assign-tests') }}" class="btn btn-primary">BACK</a>
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
     $('.dynamic').change(function() {
         var select = $(this).attr("id");
         var value = $(this).val();
         var dependent = $(this).data('dependent');
         var _token = $('input[name="_token"]').val();

         // Clear existing options in the dependent dropdown
         $('#' + dependent).empty().append('<option value="">-- Select ' + dependent.replace('_', ' ') + ' --</option>');

         // Clear and hide the testcode container
         var testcodeContainer = $('#testcode-container');
         testcodeContainer.empty().hide();

         // Make separate AJAX requests based on the selected dropdown
         if (dependent === 'instrument_id') {
             fetchInstruments(_token, select, value, dependent);
         } else if (dependent === 'reagent_id') {
             var instrument_id = $('#instrument_id').val();
             fetchReagents(_token, select, value, dependent, instrument_id);
         }
     });

     function fetchInstruments(token, select, value, dependent) {
         $.ajax({
             url: "{{ route('assign-tests.fetchInstruments') }}",
             method: "POST",
             data: {
                 select: select,
                 value: value,
                 _token: token,
                 dependent: dependent
             },
             success: function(result) {
                 console.log(result);
                 if (result.instruments) {
                     $.each(result.instruments, function(key, value) {
                         $('#' + dependent).append('<option value="' + key + '">' + value + '</option>');
                     });
                 }
             },
             error: function(xhr, status, error) {
                 console.error(xhr.responseText);
             }
         });
     }

     function fetchReagents(token, select, value, dependent) {
         $.ajax({
             url: "{{ route('assign-tests.fetchReagents') }}",
             method: "POST",
             data: {
                 select: select,
                 value: value,
                 _token: token,
                 dependent: dependent,
             },
             success: function(result) {
                 console.log(result);

                 var dependentDropdown = $('#' + dependent);
                 dependentDropdown.empty().append('<option value="">-- Select ' + dependent.replace('_', ' ') + ' --</option>');

                 if (result.reagents) {
                     $.each(result.reagents, function(key, reagent) {
                         dependentDropdown.append('<option value="' + key + '">' + reagent + '</option>');
                     });

                     // Show the dependent container
                     dependentDropdown.show();
                 }

                 // Add a change event handler for the 'reagent_id' dropdown
             $('#reagent_id').change(function() {
                 var reagentId = $(this).val();
                 if (reagentId) {
                     // Fetch test codes based on the selected reagent
                     fetchTestCodes(reagentId);
                 }
             });
             },
             error: function(xhr, status, error) {
                 console.error(xhr.responseText);
             }
         });
     }

     function fetchTestCodes(reagentId) {
         var _token = $('input[name="_token"]').val();

         $.ajax({
             url: "{{ route('assign-tests.fetchTestCodes') }}",
             method: "POST",
             data: {
                 reagent_id: reagentId,
                 _token: _token
             },
             success: function(result) {
                 console.log(result);

                 var testcodeContainer = $('#testcode-container');
                 testcodeContainer.empty();

                 if (result.testcodes) {
                     $.each(result.testcodes, function(key, test) {
                         var checkbox = $('<div class="col-sm-6">' +
                             '<div class="form-check1">' +
                             '<input type="checkbox" class="form-check-input1" name="testcodes[]" value="' + test.testcode + '" id="test_' + test.testcode + '">&nbsp&nbsp' +
                             '<label class="form-check-label" for="test_' + test.testcode + '">' + test.testname + '</label>' +
                             '</div>' +
                             '</div>');

                         testcodeContainer.append(checkbox);
                     });

                     // Show the dependent container
                     testcodeContainer.show();
                 } else {
                     // Hide the dependent container if no data is available
                     testcodeContainer.hide();
                 }
             },
             error: function(xhr, status, error) {
                 console.error(xhr.responseText);
             }
         });
     }
 });
 </script>

    <script>
        $(document).ready(function() {
            // Disable the "Instrument" dropdown initially
            $('#instrument_id').prop('disabled', true);
            $('#reagent_id').prop('disabled', true);

            // Add change event for the "Institution" dropdown
            $('#institution_id').change(function() {
                // Enable the "Instrument" dropdown when a institution is selected
                $('#instrument_id').prop('disabled', false);
            });

            // Add change event for the "Institution" dropdown
            $('#instrument_id').change(function() {
                // Enable the "Instrument" dropdown when a institution is selected
                $('#reagent_id').prop('disabled', false);
            });
        });
    </script>

@endsection
