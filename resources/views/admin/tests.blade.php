@extends("layouts.master")

@section('title')
    Test Setup | ADEQA
@endsection


@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="exampleModalLabel">ADD TEST</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/save-tests" method="POST">
            {{ csrf_field() }}

            <div class="mb-3">
              <label for="testcode" class="col-form-label">Test Code:</label>
              <input type="text" name="testcode" class="form-control" id="testcode">
            </div>

            <div class="mb-3">
                <label for="testname" class="col-form-label">Test Name:</label>
                <input type="text" name="testname" class="form-control" id="testname">
              </div>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Reagent:</label>
                <select name="reagent_id" class="form-control" id="reagent_id">
                    @foreach($reagents as $reags)
                        <option value="{{ $reags->id }}">{{ $reags->reagent }}</option>
                    @endforeach
                </select>
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

            <div class="mb-3">
                <label for="expected_result" class="col-form-label">Expected Result:</label>
                <select name="expected_result" class="form-control" id="expected_result">
                    <option value="POSITIVE">POSITIVE</option>
                    <option value="NEGATIVE">NEGATIVE</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="low_range" class="col-form-label">Low Range:</label>
                <input type="text" name="low_range" class="form-control" id="low_range">
              </div>

            <div class="mb-3">
                <label for="high_range" class="col-form-label">High Range:</label>
                <input type="text" name="high_range" class="form-control" id="high_range">
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
                    <input type="hidden" id="delete_tests_id">
                    <h5>Are you sure you want to delete this Test ?</h5>
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
          <h4 class="card-title">TEST SETUP
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
                <th class="w-10p">Test Code</th>
                <th class="w-10p">Test Name</th>
                <th class="w-10p">Reagent</th>
                <th class="w-10p">Method</th>
                <th class="w-10p">Unit</th>
                <th class="w-10p">Low Range</th>
                <th class="w-10p">High Range</th>
                <th class="w-10p">Expected Result</th>
                <th class="w-10p" style="text-align: center;">ACTIONS</th>
              </thead>
              <tbody>
                @foreach ($test as $data)
                <tr>
                  <td>{{ $data->testcode }}</td>
                  <td>{{ $data->testname }}</td>
                  <td>
                    @if ($data->reagent)
                        {{ $data->reagent->reagent}}
                    @else
                        No Reagent
                    @endif
                  </td>
                  <td>
                    @if ($data->method)
                        {{ $data->method->methodname}}
                    @else
                        No Method
                    @endif
                  </td>
                  <td>
                    @if ($data->unit)
                        {{ $data->unit->unit}}
                    @else
                        No Unit
                    @endif
                  </td>
                <td>{{ $data->expected_result }}</td>
                  <td>{{ $data->low_range }}</td>
                  <td>{{ $data->high_range }}</td>
                  <td style="display: flex; justify-content: center;">
                <a href="{{ url('tests/'.$data->testcode)}}" class="btn btn-success">
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

                $('#delete_tests_id').val(data[0]);

                $('#delete_modal_Form').attr('action', '/tests-delete/'+data[0]);

                $('#deletemodalpop').modal('show');
            });
        });
    </script>
@endsection
