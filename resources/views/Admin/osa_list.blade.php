@extends('navbar.admin_nav')
@section('content')

<main style="padding-top: 30px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<div class="container mt-2">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="alert alert-success" id="success" style="display: none;">
                A new user has been created
            </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-left">
                <h2>OSA PERSONNEL LIST</h2>
            </div>

            
                
            <div class="pull-right mb-2">
                <a href="javascript:void(0)" class="btn btn-success" onClick="add()">Add Employee</a>
            </div>
            
        </div>
    </div>

    

<div class="card-body">
    <table class="table table-bordered" id="osa_list">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Last Name</th>
                <th>Middle Initial</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="osaModal" tabindex="-1" aria-labelledby="osaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="osaModalLabel">Employee Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!--Form-->
      <div class="modal-body">
      <form action="javascript:void(0)" id="osaForm" name="osaForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id">

    <div class="form-group">
        <label for="employee_id" class="col-sm-2 control-label">Employee ID</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Enter Employee ID" required maxlength="9">
        </div>
    </div>

    <div class="form-group">
        <label for="last_name" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
        </div>
    </div>

    <div class="form-group">
        <label for="middle_initial" class="col-sm-2 control-label">Middle Initial</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="Enter Middle Initial (NA if none)">
        </div>
    </div>

    <div class="form-group">
        <label for="first_name" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-12" style="position: relative;">
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter the email in the end @adamson.edu.ph" 
            required 
                   pattern=".*@adamson\.edu\.ph$" 
                   title="Please enter a valid email address ending with @adamson.edu.ph"
                   style="padding-right: 120px;">
        </div>
    </div>
    

    <div class="form-group">
        <label for="password" id="lbl_password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-12">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
        
            <a href="reset_password" id="reset_pass" style="display: none; padding: 10px 0 10px 0;">Reset Password</a>
            
        </div>
    </div>

    <div class="form-group">
        <label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" maxlength="11">
        </div>
    </div>


</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </form>
      </div>
    </div>
  </div>
</div>
</main>

<script type="text/javascript">
$(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $('#osa_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('osa_list') }}",
            columns: [
                {data: 'employee_id', name: 'employee_id'},
                {data: 'last_name', name: 'last_name'},
                {data: 'middle_initial', name: 'middle_initial'},
                {data: 'first_name', name: 'first_name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });
});

    //for updating students info
    function editsF(id){
            $.ajax({
                type: "POST",
                url: "{{ url('edits') }}",
                data: {employee_id: id},
                success: function(res){
                    console.log(res);
                    $('#osa-Modal').html("Edit Employee Information");
                    $('#osaModal').modal('show');
                    $('#employee_id').val(res.employee_id);
                    $('#last_name').val(res.last_name);
                    $('#middle_initial').val(res.middle_initial);
                    $('#first_name').val(res.first_name);
                    $('#email').val(res.email);
                    $('#phone_number').val(res.phone_number);
                    if (res.password) {
                    $('#password').val(res.password);
                    document.getElementById('lbl_password').style.display = "none";
                    document.getElementById('password').style.display = "none";
                    document.getElementById('reset_pass').style.display = 'block';
                    window.location.href = "{{ url('reset_password') }}" + "?employee_id=" + id;
                }
                },
                error: function (xhr, status, error) {
                console.log(xhr.responseText);
                // Handle error or log the details for troubleshooting
                }
            });
        }

    function showEventModal(content) {
        // Set the HTML content in the modal body
        document.getElementById('eventDescriptionModalBody').innerHTML = content;

        // Show the modal
        $('#eventDescriptionModal').modal('show');
        }

        //for deleting students
    function deletesF(id){
        if (confirm("Delete Employee Record?") == true){
            var id = id;

            $.ajax({
                type: "POST",
                url: "{{ url('deletes') }}",
                data: { 
                    employee_id:id,
                    _token: '{{ csrf_token() }}' },
                
                success: function(res){
                    var oTable = $("#osa_list").dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }

    function add(){
        $('#osaForm').trigger("reset");
        $('#osa-Modal').html("Add OSA Employee");
        $('#osaModal').modal('show');
        $('#id').val('');
    }

    // For submitting the form for adding or updating
$('#osaForm').submit(function(event){
    event.preventDefault();
    var actionUrl = "{{ isset($employee) ? url('updates') : url('stores') }}"; 

    $.ajax({
        type:'POST',
        url: actionUrl,
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response.message);
            $('#osaModal').modal('hide');
            document.getElementById('success').style.display = 'block';
            $('#osa_list').DataTable().ajax.reload(); 
        },
        error: function(xhr, status, error){ 
            console.log(xhr.responseText);
            // Handle error or log the details for troubleshooting
        }
    });
});

</script>

@endsection

@push('styles')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

@endpush

@push('jquery')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
@endpush

@push('scripts')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush