@extends('navbar.admin_nav')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>COURSE LIST</h2>
            </div>
            <div class="pull-right mb-2">
                <a href="javascript:void(0)" class="btn btn-success" onClick="add()">Add Course</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="course-list">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="courseModalLabel">Course Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!--Form-->
      <div class="modal-body">
        <!--@csrf-->
        <form action="javascript:void(0)" id="courseForm" name="courseForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="course_name" class="col-sm-2 control-label">Course Name</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter Course Name" required>
                </div>

                <div class="col-sm-offset-2 col-sm-10"><br/>
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#course-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('course-list') }}",
        columns: [
                {data: 'id', name: 'id'},
                {data: 'course_name', name: 'course_name'},
                {data: 'action', name: 'action', orderable: false},

            ],
            order: [[0, 'desc']]
    });
});

function add(){
    $('#courseForm').trigger("reset");
    $('#course-Modal').html("Add Course");
    $('#courseModal').modal('show');
    $('#id').val('');
    
}

function editFun(id){
    $.ajax({
        method: "POST",
        url: "{{ url('edits') }}",
        data: {id:id},
        dataType: 'json',
            success: function(res){
                console.log(res);
                $('#course-Modal').html("Edit Information");
                $('#courseModal').modal('show');
                $('#id').val(res.id);
                $('#course_name').val(res.course_name);
        }
    });
}

function deleteFun(id){
        if (confirm("Delete Student Record?") == true){
            var id = id;

            $.ajax({
                type: "POST",
                url: "{{ url('deletes') }}",
                data: { id:id },
                dataType: 'json',
                success: function(res){
                    var oTable = $("#student-list").dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
}

$('#courseForm').submit(function(c){
    c.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ url('stores') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            console.log(data);  
            $('#courseModal').modal('hide');
            var oTable=  $('#course-list').dataTable();
            oTable.fnDraw(false);
            $('#btn-save').html('Submit');
            $('#btn-save').attr("disabled", false);
        },
        error: function(data){ 
            console.log(data);
        }
    });
});


</script>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
@endpush

@push('jquery')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush