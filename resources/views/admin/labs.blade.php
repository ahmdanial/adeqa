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
                <label for="recipient-name" class="col-form-label">Institution:</label>
                <select name="institution_id" class="form-control" id="institution">
                    @foreach($institution as $inst)
                        <option value="{{ $inst->id }}">{{ $inst->institution }}</option>
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
                    <input type="hidden" id="delete_labs_id">
                    <h5>Are you sure you want to delete this Lab ?</h5>
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
                <th class="w-10p">Institution</th>
                <th class="w-10p">Added By</th>
                <th class="w-10p">Updated By</th>
                <th class="w-10p" style="text-align: center;">ACTIONS</th>
              </thead>
              <tbody>
                @foreach ($lab as $data)
                <tr>
                  <td>{{ $data->id }}</td>
                  <td>{{ $data->labname }}</td>
                  <td>
                    @if ($data->institution)
                        {{ $data->institution->institution}}
                    @else
                        No Institution
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
                  <td style="display: flex; justify-content: center;">
                <a href="{{ url('labs/'.$data->id)}}" class="btn btn-success">
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

                $('#delete_labs_id').val(data[0]);

                $('#delete_modal_Form').attr('action', '/labs-delete/'+data[0]);

                $('#deletemodalpop').modal('show');
            });
        });
    </script>
@endsection
