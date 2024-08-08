@extends('navbar.navbar_student')
@section('content')
</head>
<body>
<main>
    <a href="/student" class="btn btn-primary" style="margin: 6% 0 10px 1%;">Go Back </a>
    <div class="card" style="text-align:left;">
        <h5 class="card-header">Petition for New Organization</h5>
        <div class="card-body">
        <form method="POST" action="/petition_new/" enctype="multipart/form-data">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

          <div style="margin-bottom:2%;">
            <button type="button" class="btn btn-primary" onclick="showAll()">Show All</button>
            <button type="button" class="btn btn-primary" onclick="showInformation()">Information</button>
            <button type="button" class="btn btn-primary" onclick="showOrganizationInformation()">Attachments</button>
          </div>
        <div id="all">
          <div id="information" style="display: none;">
            <!--Name-->
            <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            <input type="text" class="form-control" name="name" id="name" placeholder="Insert here the name of the Organization" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--Nickname-->
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nickname</span>
                <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Insert here the Nickname of the Organization" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
            
            

            <!--Adviser Name-->
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Adviser Name</span>
                <input type="text" class="form-control" name="advisername" id="advisername" placeholder="Insert Adviser's Name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>

            <!--Adviser Email-->
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Adviser Email</span>
                <input type="email" class="form-control" name="adviseremail" id="adviseremail" placeholder="Insert Adviser's Email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>

            <!--President Student Number-->
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">President Student Number</span>
                <input type="number" maxlength="9" class="form-control" name="president" id="president" placeholder="Insert here your Student Number" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
        </div>


        <div id="Organization Information" style="display:none;">
            <!--Type of Organization-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="type_of_organization">Type of Organization</label>
                <select class="form-select" id="type_of_organization" name="type_of_organization">
                    <option selected>What type of Organization is this?</option>
                    <option value="Academic">Academic</option>
                    <option value="Co-Academic">Co-Academic</option>
                    <option value="Socio Civic">Socio Civic</option>
                    <option value="Religious">Religious</option>
                </select>
              </div>
            <!--Academic Course Based-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="academic_course_based">Academic Course Based</label>
                <select class="form-select" id="academic_course_based" name="academic_course_based">
                    <option selected>Is it based on a academic course?</option>
                    <option value="Not Academic Course Based">Not Academic Course Based</option>
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

            <!--Letter of Intent-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="letter_of_intent">Letter of Intent</label>
                <input type="file" class="form-control" id="letter_of_intent" name="letter_of_intent" required>
              </div>

            <!--Admin Endorsement-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="admin_endorsement">Endorsement Letter</label>
                <input type="file" class="form-control" id="admin_endorsement" name="admin_endorsement" required>
              </div>

            <!--Signees-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="signees">30 Student Signees</label>
                <input type="file" class="form-control" id="signees" name="signees" required>
              </div>

            <!--Constitution and ByLaws-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="consti_and_byLaws">Constitution and Bylaws</label>
                <input type="file" class="form-control" id="consti_and_byLaws" name="consti_and_byLaws" required>
              </div>
        </div>
          <button type="submit" id="submitBtn" style="display: none;" class="btn btn-primary">Submit</a>
        </div>
        </form>
        </div>
    </div>
</main>
</body>

<script>
    $(document).ready(function() {
    $('#president').on('input', function() {
        // Remove non-numeric characters
        $(this).val($(this).val().replace(/\D/g,''));
        
        // Enforce 9-character limit
        if ($(this).val().length > 9) {
            $(this).val($(this).val().substr(0, 9));
        }
        });
    });

    function showInformation(){
        document.getElementById('information').style.display = 'block';
        document.getElementById('Organization Information').style.display = 'none';
        document.getElementById('submitBtn').style.display = 'block'
    }

    function showOrganizationInformation(){
        document.getElementById('information').style.display = 'none';
        document.getElementById('Organization Information').style.display = 'block';
        document.getElementById('submitBtn').style.display = 'block'
    }

    function showAll(){
        document.getElementById('information').style.display = 'block';
        document.getElementById('Organization Information').style.display = 'block';
        document.getElementById('submitBtn').style.display = 'block'
    }


</script>
@endsection