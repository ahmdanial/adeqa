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
                        <label for="instrument_id" class="col-sm-3 col-form-label">Instrument:</label>
                        <div class="col-sm-9">
                            <select name="instrument_id" class="form-control dynamic" id="instrument_id" data-dependent="reagent_id" disabled>
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
                            <select name="reagent_id" class="form-control dynamic" id="reagent_id" data-dependent="testcode" disabled>
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

                <th class="w-10p">Lab</th>
                <th class="w-10p">Program </th>
                <th class="w-10p">Instrument </th>
                <th class="w-10p">Reagent </th>
                <th class="w-10p">Test </th>

                {{-- <th class="w-10p">Added By</th>
                <th class="w-10p">Updated By</th> --}}
                <th class="w-10p" style="text-align: center;">ACTIONS</th>
              </thead>
              <tbody>
                {{--@foreach ($subAssignTests as $data)--}}
                <?php
                $conn = new mysqli("localhost", "root", "","adeqa");

                $sql = "SELECT A.id,B.labname,C.programname,D.instrumentname,E.testname,G.reagent
                        FROM assign_test A, labs B, programs C, instruments D, tests E, subassigntest F, reagents G
                        WHERE A.lab_id = B.id AND A.prog_id = C.id AND A.instrument_id = D.id
                        AND F.testcode = E.testcode AND A.id = F.assign_test_id AND B.department_id=D.department_id
                        AND A.reagent_id = G.id
                        group by A.id,B.labname,C.programname,D.instrumentname,E.testname,G.reagent
                        order by A.id;";
                $result = $conn->query($sql);

                while($row = $result -> fetch_object()){
                    $assignTestID = $row->id;
                    $labname = $row->labname;
                    $progname = $row->programname;
                    $instrumentname = $row->instrumentname;
                    $testname = $row->testname;
                    $reagent = $row->reagent;

                ?>
                <tr>

                  <td> {{$labname}}</td>
                  <td> {{$progname}}</td>
                  <td> {{$instrumentname}}</td>
                  <td> {{$reagent}}</td>
                  <td> {{$testname}}</td>
                  <td style="display: flex; justify-content: center;">
                    <a href="{{ url('assign-tests/'.$assignTestID)}}" class="btn btn-success">
                        <i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="btn btn-danger deletebtn">
                        <i class="fas fa-trash"></i></a>
                </td>
                </tr>
                <?php
                }
                ?>

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

            // Add change event for the "Department" dropdown
            $('#department_id').change(function() {
                // Enable the "Instrument" dropdown when a department is selected
                $('#instrument_id').prop('disabled', false);
            });

            // Add change event for the "Department" dropdown
            $('#instrument_id').change(function() {
                // Enable the "Instrument" dropdown when a department is selected
                $('#reagent_id').prop('disabled', false);
            });
        });
    </script>
@endsection
