@extends("layouts.admin")

@section('title')
    Assign Test Setup | ADEQA
@endsection


@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="exampleModalLabel">ASSIGN TEST</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/save-assign-tests" method="POST">

                    {{ csrf_field() }}

                    <div class="mb-3 row">
                        <label for="department_id" class="col-sm-3 col-form-label">Department:</label>
                        <div class="col-sm-9">
                            <select name="department_id" class="form-control dynamic" id="department_id" data-dependent="instrument_id">
                                <option value="">-- Select Department --</option> <!-- Added this line for the initial option -->
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->department }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="lab_id" class="col-sm-3 col-form-label">Lab:</label>
                        <div class="col-sm-9">
                            <select name="lab_id" class="form-control" id="lab_id">
                                @foreach($labs as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->labname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="prog_id" class="col-sm-3 col-form-label">Program:</label>
                        <div class="col-sm-9">
                            <select name="prog_id" class="form-control" id="prog_id" >
                                @foreach($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->programname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="instrument_id" class="col-sm-3 col-form-label">Instrument:</label>
                        <div class="col-sm-9">
                            <select name="instrument_id" class="form-control dynamic" id="instrument_id" data-dependent="reagent_id">
                                <option>-- Select instrument id --</option>
                                @foreach($instruments as $inst)
                                    <option value="{{ $inst->id }}">{{ $inst->instrumentname }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="reagent_id" class="col-sm-3 col-form-label">Reagent:</label>
                        <div class="col-sm-9">
                            <select name="reagent_id" class="form-control dynamic" id="reagent_id" data-dependent="testcode">
                                <option>-- Select reagent id --</option>
                                @foreach($reagents as $reag)
                                    <option value="{{ $reag->id }}">{{ $reag->reagent }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="testcode" class="col-sm-3 col-form-label">Test:</label>
                        <div id="testcode-container" class="col-sm-9" style="display: none;">
                            <div class="row">
                                @foreach($tests as $test)
                                    <div class="col-sm-6">
                                        <div class="form-check1">
                                            <input type="checkbox" class="form-check-input1" name="testcodes[]" value="{{ $test->testcode }}" id="test_{{ $test->testcode }}" {{ in_array($test->testcode, old('testcodes', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="test_{{ $test->testcode }}">{{ $test->testname }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
                <button type="submit" class="btn btn-success">SAVE</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<!-- Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">DELETE</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form id="delete_modal_Form" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="modal-body">
                    <input type="hidden" id="delete_assignuser_id">
                    <h5>Are you sure you want to delete this Assign Test ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes. Delete It.</button>
                </div>
            </form>
      </div>
    </div>
  </div>
{{-- End Delete Modal --}}

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">ASSIGN TESTS SETUP
            <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
             <i class="now-ui-icons ui-1_simple-add"></i>
            </button>
          </h4>
          <br>
          <br>

        </div>
        <style>
            .w-10p
            {
                width: 10% !important;
            }
            .w-1p
            {
                width: 1% !important;
            }
        </style>

        <div class="card-body">
          <div class="table-responsive">
            <table id="datatable" class="table">
              <thead class=" text-primary">
                <th class="w-1p">ID </th>
                <th class="w-10p">Lab</th>
                <th class="w-10p">Program </th>
                <th class="w-10p">Instrument </th>
                <th class="w-10p">Test </th>

                {{-- <th class="w-10p">Added By</th>
                <th class="w-10p">Updated By</th> --}}
                <th class="w-10p" style="text-align: center;">ACTIONS</th>
              </thead>
              <tbody>
                @foreach ($assignTests as $data)
                <tr>
                  <td>{{ $data->id }}</td>

                  <td>
                      @if ($data->lab)
                      {{ $data->lab->labname}}
                      @else
                          No User
                      @endif
                  </td>

                    <td>
                        @if ($data->program)
                        {{ $data->program->programname}}
                        @else
                            No User
                        @endif
                    </td>

                    <td>
                        @if ($data->instrument)
                        {{ $data->instrument->instrumentname}}
                        @else
                            No User
                        @endif
                    </td>

                    <td>
                        @foreach($data->tests as $test)
                            {{ $test->testname }}
                            @if(!$loop->last) {{-- Add line break if not the last item --}}
                                <br>
                            @endif
                        @endforeach
                    </td>


                  {{--<td>
                    @if ($data->addedBy)
                        {{ $data->addedBy->username }}
                    @else
                        N/A
                    @endif
                </td>

                <td>
                    @if ($data->updateBy)
                        {{ $data->updateBy->username }}
                    @else
                        N/A
                    @endif
                </td>--}}

                <td style="display: flex; justify-content: center;">
                    <a href="{{ url('assign-tests/'.$data->id)}}" class="btn btn-success">
                        <i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="btn btn-danger deletebtn">
                        <i class="fas fa-trash"></i></a>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#datatable').DataTable();

            $('#datatable').on('click', '.deletebtn', function () {

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#delete_assignuser_id').val(data[0]);

                $('#delete_modal_Form').attr('action', '/assign-tests-delete/'+data[0]);

                $('#deletemodalpop').modal('show');
            });
        });
    </script>

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

    function fetchReagents(token, select, value, dependent, instrument_id) {
        $.ajax({
            url: "{{ route('assign-tests.fetchReagents') }}",
            method: "POST",
            data: {
                select: select,
                value: value,
                _token: token,
                dependent: dependent,
                instrument_id: instrument_id
            },
            success: function(result) {
                console.log(result);

                var dependentDropdown = $('#' + dependent);
                dependentDropdown.empty().append('<option value="">-- Select ' + dependent.replace('_', ' ') + ' --</option>');

                if (result.reagents) {
                    console.log(result.reagents);

                    $.each(result.reagents, function(key, reagent) {
                        dependentDropdown.append('<option value="' + key + '">' + reagent.reagent + '</option>');
                    });

                    // Show the dependent container
                    dependentDropdown.show();
                }

                // Update: Check if the dependent dropdown is 'reagent_id'
                if (dependent === 'reagent_id') {
                    // Fetch test codes based on the selected reagent
                    fetchTestCodes(value);
                }
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
                            '<input type="checkbox" class="form-check-input1" name="testcodes[]" value="' + test.id + '" id="test_' + test.id + '">' +
                            '<label class="form-check-label" for="test_' + test.id + '">' + test.testcode + '</label>' +
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
@endsection
