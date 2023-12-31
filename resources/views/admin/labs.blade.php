@extends("layouts.master")

@section('title')
    Lab Setup | ADEQA
@endsection


@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="exampleModalLabel">ADD LAB</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/save-labs" method="POST">
            {{ csrf_field() }}

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Lab Name:</label>
              <input type="text" name="labname" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Department:</label>
                <select name="department_id" class="form-control" id="department">
                    @foreach($departments as $deps)
                        <option value="{{ $deps->id }}">{{ $deps->department }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Address:</label>
                <input type="text" name="address" class="form-control" id="recipient-name">
              </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">City:</label>
                <input type="text" name="city" class="form-control" id="recipient-name">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">State:</label>
                <input type="text" name="state" class="form-control" id="recipient-name">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Postal Code:</label>
                <input type="text" name="postalcode" class="form-control" id="recipient-name">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Country:</label>
                <input type="text" name="country" class="form-control" id="recipient-name">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Contact No:</label>
                <input type="text" name="contactno" class="form-control" id="recipient-name">
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
                    <input type="hidden" id="delete_labs_id">
                    <h5>Are you sure you want to delete this lab ?</h5>
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
          <h4 class="card-title">LAB SETUP
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
                <th class="w-10p">Lab ID</th>
                <th class="w-10p">Lab Name</th>
                <th class="w-10p">Department</th>
                <th class="w-10p">Address</th>
                <th class="w-10p">City</th>
                <th class="w-10p">State</th>
                <th class="w-10p">Postal Code</th>
                <th class="w-10p">Country</th>
                <th class="w-10p">Contact No</th>
                <th class="w-10p">EDIT</th>
                <th class="w-10p">DELETE</th>
              </thead>
              <tbody>
                @foreach ($labs as $data)
                <tr>
                  <td>{{ $data->id }}</td>
                  <td>{{ $data->labname }}</td>
                  <td>
                    @if ($data->department)
                        {{ $data->department->department}}
                    @else
                        No Department
                    @endif
                </td>
                  <td>
                    <div style="width: 200px; overflow: hidden; ">
                        {{ $data->address }}
                    </div>
                </td>
                  <td>{{ $data->city }}</td>
                  <td>{{ $data->state }}</td>
                  <td>{{ $data->postalcode }}</td>
                  <td>{{ $data->country }}</td>
                  <td>{{ $data->contactno }}</td>
                  <td>
                    <a href="{{ url('labs/'.$data->id)}}" class="btn btn-success">
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

                $('#delete_labs_id').val(data[0]);

                $('#delete_modal_Form').attr('action', '/labs-delete/'+data[0]);

                $('#deletemodalpop').modal('show');
            });
        });
    </script>
@endsection
