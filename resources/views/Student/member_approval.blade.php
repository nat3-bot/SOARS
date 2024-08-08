@extends('navbar.navbar_student')
@section('content')

<main>
   

    <div class="container-tbl-up" style="padding-top: 50px;">
        <table class="table">
            <thead>
                <tr>
                    <th>Organization</th>
                    <th>Name</th>
                    <th>Student Number</th>
                    <th>Contact Number</th>
                    <th>Year Level</th>
                    <th>Program</th>
                    <th>Actions</th>

                    
                    
                </tr>
            </thead>
            <tbody>
                <!-- Table rows with event details and actions -->
<tr>
                    <td>TNT</td>
                    <td>john Loyd</td>
                    <td>201942069</td>
                    <td>0967696969</td>
                    <td>4th</td>
                    <td>BSIT</td>
                    
                    
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#approveModal">Approve</button>
                       
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>

                      </td>
                </tr>
                <tr>
                    <td>TNT</td>
                    <td>john Loyd</td>
                    <td>201942069</td>
                    <td>0967696969</td>
                    <td>4th</td>
                    <td>BSIT</td>
                    
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#approveModal">Approve</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>

                      </td>
                </tr>
            </tbody>
        </table>

@endsection