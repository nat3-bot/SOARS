@extends('navbar.admin_nav')

@section('content')

<main style="padding-top: 30px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/14059d6bc2.js" crossorigin="anonymous"></script>
<div class="container mt-2">
    <div class="row">
        <div class="col-6 margin-tb">
            <div class="pull-left">
                <h2>STUDENT LIST</h2>
            </div>
            <form action="{{ route('import.students') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-bottom:10px;">
                    Import Students
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Students Via CSV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="csv_file">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import Students</button>
                        </div>
                    </div>
                    </div>
                </div>
                
            </form>
            
            <div class="pull-right mb-2">
                <a href="javascript:void(0)" class="btn btn-success" onClick="add()">New Student <i class="fa-solid fa-user-plus"></i></a>
            </div>
        </div>
    </div>
@if (session('success'))
    <div class="alert alert-success">
        <p>{{session('success')}}</p>
    </div>
@endif
<div class="card-body">
    <table class="table table-bordered" id="student-list">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>Middle Initial</th>
                <th>First Name</th>
                <th>Course ID</th>
                <th>Email</th>
                <th>Organization 1</th>
                <th>Organization 2</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="studentModalLabel">Student Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!--Form-->
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <!-- First column -->
            <div class="col-md-6">
            <form action="javascript:void(0)" id="studentForm" name="studentForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="student_id" class="col-sm-4 control-label"><span style="color: red;">*</span>Student ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required maxlength="9">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-sm-4 control-label"><span style="color: red;">*</span>Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle_initial" class="col-sm-4 control-label"><span style="color: red;">*</span>Middle Initial</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="Enter Middle Initial(put NA if none)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="first_name" class="col-sm-4 control-label"><span style="color: red;">*</span>First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="course_id" class="col-sm-4 control-label"><span style="color: red;">*</span>Course ID</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="course_id" name="course_id" >
                                    <option value="">Select Course</option>
                                    <option value="academic_course_based">Not Academic Course Based</option>
                                    <option value="ACT">Associate in Computer Technology</option>
                                    <option value="BAComm">Bachelor of Arts in Communication</option>
                                    <option value="BAPhilo">Bachelor of Arts in Philosophy</option>
                                    <option value="BAPolSci">Bachelor of Arts in Political Science</option>
                                    <option value="BEEd">Bachelor of Elementary Education</option>
                                    <option value="BPEd">Bachelor of Physical Education</option>
                                    <option value="BPE-SWM">Bachelor of Physical Education Major in Sports and Wellness Management</option>
                                    <option value="BSA">Bachelor of Science in Accountancy</option>
                                    <option value="BSArchi">Bachelor of Science in Architecture</option>
                                    <option value="BSBio">Bachelor of Science in Biology</option>
                                    <option value="BSBAFM">Bachelor of Science in Business Administration Major in Financial Management</option>
                                    <option value="BSBAMM">Bachelor of Science in Business Administration Major in Marketing Management</option>
                                    <option value="BSBAOM">Bachelor of Science in Business Administration Major in Operations Management</option>
                                    <option value="BSChE">Bachelor of Science in Chemical Engineering</option>
                                    <option value="BSCPT">Bachelor of Science in Chemical Process Technology</option>
                                    <option value="BSChem">Bachelor of Science in Chemistry</option>
                                    <option value="BSCE">Bachelor of Science in Civil Engineering</option>
                                    <option value="BSCooE">Bachelor of Science in Computer Engineering</option>
                                    <option value="BSCS">Bachelor of Science in Computer Science</option>
                                    <option value="BSCA">Bachelor of Science in Customs Administration</option>
                                    <option value="BSEE">Bachelor of Science in Electrical Engineering</option>
                                    <option value="BSGeo">Bachelor of Science in Geology</option>
                                    <option value="BSHM">Bachelor of Science in Hospitality Management</option>
                                    <option value="BSIE">Bachelor of Science in Industrial Engineering</option>
                                    <option value="BSIS">Bachelor of Science in Information System</option>
                                    <option value="BSIT">Bachelor of Science in Information Technology</option>
                                    <option value="BSME">Bachelor of Science in Mechanical Engineering</option>
                                    <option value="BSMining">Bachelor of Science in Mining Engineering</option>
                                    <option value="BSNursing">Bachelor of Science in Nursing</option>
                                    <option value="BSPE">Bachelor of Science in Petroleum Engineering</option>
                                    <option value="BSPharma">Bachelor of Science in Pharmacy</option>
                                    <option value="BSPsych">Bachelor of Science in Psychology</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label"><span style="color: red;">*</span>Email</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter the email in the end @adamson.edu.ph" required 
                                pattern=".*@adamson\.edu\.ph$" 
                                title="Please enter a valid email address ending with @adamson.edu.ph">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="organization1" class="col-sm-4 control-label"><span style="color: red;">*</span>Organization 1</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="organization1" name="organization1">
                                    <option value="">Select Organization</option>
                                    <!-- Organizations will be dynamically populated here -->
                                </select>
                            </div>
                        </div>


                </div>

                <!--Second Column-->
                <div class="col-md-6">

                <div class="form-group">
                    <label for="organization2" class="col-sm-4 control-label">Organization 2</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="organization2" name="organization2">
                            <option value="" disabled selected>Select Organization</option>
                            <!-- Organizations will be dynamically populated here -->
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label"><span style="color: red;">*</span>Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                </div>


                <div class="form-group">
                    <label for="org1_member_status" class="col-sm control-label"><span style="color: red;">*</span>Org 1 Membership Status</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="org1_member_status" name="org1_member_status" required>
                            <option value="" disabled selected>Choose Status</option>
                            <option value="Member">Member</option>
                            <option value="Student Leader">Student Leader</option>
                            <option value="President">President</option>
                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="org2_member_status" class="col-sm control-label">Org 2 Membership Status</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="org2_member_status" name="org2_member_status">
                            <option value="" disabled selected>Choose Status</option>
                            <option value="">None</option>
                            <option value="Applying Member">Applying Member</option>
                            <option value="Paid">Paid</option>
                            <option value="Member">Member</option>
                            <option value="Student Leader">Student Leader</option>
                            <option value="President">President</option>
                            
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="phone_number" class="col-sm-4 control-label">Phone Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" maxlength="11">
                    </div>
                </div>

                <div class="col-sm-offset-2 col-sm-10"><br/>
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
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

        $('#student-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('student-list') }}",
            columns: [
                {data: 'student_id', name: 'student_id'},
                {data: 'last_name', name: 'last_name'},
                {data: 'middle_initial', name: 'middle_initial'},
                {data: 'first_name', name: 'first_name'},
                {data: 'course_id', name: 'course_id'},
                {data: 'email', name: 'email'},
                {data: 'organization1', name: 'organization1'},
                {data: 'organization2', name: 'organization2'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });

    });

     // Function to populate Organization 1 dropdown based on the selected course ID
        $('#course_id').change(function() {
            var courseId = $(this).val();
            if (courseId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getOrganizations') }}",
                    data: {course_id: courseId},
                    success: function(data) {
                        $('#organization1').empty();
                        $('#organization1').append('<option value="">Select Organization</option>');
                        $.each(data, function(key, value) {
                            $('#organization1').append('<option value="' + value.id + '">' + value.nickname + '</option>');
                        });
                    }
                });
            } else {
                $('#organization1').empty();
            }
        });


    //for updating students info
    function editF(id){
        $.ajax({
            type: "POST",
            url: "{{ url('edit') }}",
            data: {student_id: id},
            
            success: function(res){
                console.log(res);
                $('#student-Modal').html("Edit Information");
                $('#studentModal').modal('show');
                $('#student_id').val(res.student_id);
                $('#last_name').val(res.last_name);
                $('#middle_initial').val(res.middle_initial);
                $('#first_name').val(res.first_name);
                $('#course_id').val(res.course_id).change();
                $('#email').val(res.email);
                $('#organization1').val(res.organization1);
                $('#organization2').val(res.organization2);
                $('#org1_member_status').val(res.org1_member_status);
                $('#org2_member_status').val(res.org2_member_status);
                $('#phone_number').val(res.phone_number);

                if (res.password) {
                $('#password').val(res.password); // Assuming the password field has an ID 'password'
            }
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            
        }
        });
    }
    //for deleting students
    function deleteF(id){
        if (confirm("Delete Student Record?") == true){
            var id = id;

            $.ajax({
                type: "POST",
                url: "{{ url('delete') }}",
                data: { student_id:id },
                
                success: function(res){
                    var oTable = $("#student-list").dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }
    

    function add(){
        $('#studentForm').trigger("reset");
        $('#student-Modal').html("Add Student");
        $('#studentModal').modal('show');
        $('#id').val('');
    }

    
    


// For submitting the form for adding or updating
// Function to handle form submission
    function submitForm() {
        var actionUrl = "{{ isset($student) ? url('update') : url('store') }}";
        var formData = new FormData($('#studentForm')[0]);
        var email = $('#email').val();
        var organization2 = $('#organization2').val();


        if (email.toLowerCase().endsWith("@adamson.edu.ph")) {

        formData.append('student_id', $('#student_id').val());
        formData.append('organization2', organization2);
        var org1MemberStatus = $('#org1_member_status').val();

        // If the value is 'Choose Status', set it to null
        if (org1MemberStatus === 'Choose Status') {
            org1MemberStatus = null;
        }

        // Append org1_member_status to formData
        formData.append('org1_member_status', org1MemberStatus);

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.message);
                $('#studentModal').modal('hide'); // Close the modal
                $('#student-list').DataTable().ajax.reload(); // Reload the DataTable
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                // Handle error or log the details for troubleshooting
            }
        }).done(function() {
            $('#student-list').DataTable().ajax.reload(); // Reload the DataTable after modal is closed
        });
    } else {
        // Alert user that only Adamson University email addresses are allowed
        alert("Please enter a valid Adamson University email address ending with '@adamson.edu.ph'");
    }
    }

    $('#studentModal').on('hide.bs.modal', function (e) {
    $('#studentForm').trigger('reset');
    });

    
    $('#btn-save').on('click', function(event) {
        event.preventDefault();
        submitForm(); 
    });

    
    $('#studentForm').on('keypress', function(event) {
        if (event.which === 13) { // Check if Enter key is pressed
            event.preventDefault();
            submitForm(); 
        }
    });

    function fetchOrganizations() {
        $.ajax({
            type: "GET",
            url: "{{ route('fetchOrganizations') }}", 
            success: function(data) {
                $('#organization2').empty();
                $('#organization2').append('<option value="">Select Organization</option>');
                $.each(data, function(key, value) {
                    $('#organization2').append('<option value="' + value.id + '">' + value.nickname + '</option>');
                });
            }
        });
    }

    fetchOrganizations();


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