@extends("layouts.admin")

@section('title')
    Assign Test Setup | ADEQA
@endsection


@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="exampleModalLabel">ASSIGN TEST</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/save-assign-tests" method="POST">

            {{ csrf_field() }}

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Lab:</label>
                <select name="lab_id" class="form-control" id="lab_id">
                    @foreach($labs as $lab) {{-- Assuming $labs is the collection of labs --}}
                        <option value="{{ $lab->id }}">{{ $lab->labname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Instrument:</label>
                <select name="instrument_id" class="form-control" id="instrument_id">
                    @foreach($instruments as $instrument)
                        <option value="{{ $instrument->id }}">{{ $instrument->instrumentname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Reagent:</label>
                <select name="reagent_id" class="form-control" id="reagent_id">
                    @foreach($reagents as $reagent)
                        <option value="{{ $reagent->id }}">{{ $reagent->reagent }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Test:</label>
                <select name="testcode" class="form-control" id="testcode">
                    @foreach($tests as $test)
                    <div class="form-check1">
                        <input type="checkbox" class="form-check-input1" name="testcode[]" value="{{ $test->testcode }}" id="test_{{ $test->testcode }}">
                        <label class="form-check-label" for="test_{{ $test->testcode }}">{{ $test->testname }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Method:</label>
                <select name="method_id" class="form-control" id="method_id">
                    @foreach($methods as $method)
                        <option value="{{ $method->id }}">{{ $method->methodname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Unit:</label>
                <select name="unit_id" class="form-control" id="unit_id">
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                    @endforeach
                </select>
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
        </style>

        <div class="card-body">
          <div class="table-responsive">
            <table id="datatable" class="table">
              <thead class=" text-primary">
                <th class="w-10p">ID </th>
                <th class="w-10p">Lab</th>
                <th class="w-10p">Program </th>
                <th class="w-10p">Instrument </th>
                <th class="w-10p">Reagent </th>
                <th class="w-10p">Test </th>
                <th class="w-10p">Method </th>
                <th class="w-10p">Unit </th>
                <th class="w-10p">Added By</th>
                <th class="w-10p">Updated By</th>
                <th class="w-10p">EDIT</th>
                <th class="w-10p">DELETE</th>
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
                        @if ($data->reagent)
                        {{ $data->reagent->reagent}}
                        @else
                            No User
                        @endif
                    </td>

                    <td>
                        @if ($data->test)
                        {{ $data->test->testname}}
                        @else
                            No User
                        @endif
                    </td>

                    <td>
                        @if ($data->method)
                        {{ $data->method->methodname}}
                        @else
                            No User
                        @endif
                    </td>

                    <td>
                        @if ($data->unit)
                        {{ $data->unit->unit}}
                        @else
                            No User
                        @endif
                    </td>

                  <td>
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
                </td>

                  <td>
                    <a href="{{ url('assign-tests/'.$data->id) }}" class="btn btn-success">
                        <i class="now-ui-icons ui-1_settings-gear-63"></i></a>
                    </td>
                  <td>
                    <a href="javascript:void(0)" class="btn btn-danger deletebtn">
                        <i class="now-ui-icons ui-1_simple-remove"></i></a>
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
@endsection
