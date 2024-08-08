@extends('navbar.navbar_student')
@section('content')
<style>
    form {
        text-align: left; /* Align text in the form to the left */
    }

    form label {
        display: block;
        margin-bottom: 8px;
    }

    form textarea,
    form input {
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 0px;
    }
    
</style>

<center>
    
    <main>
        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example" style=" margin-top:8%; margin-bottom:2%; ">
            <button type="button" class="btn btn-outline-primary" style="font-weight:bold;" onclick="showInformation()">Information</button>
            <button type="button" class="btn btn-outline-primary" style="font-weight:bold;" onclick="showFiles()">Attachment Files</button>
            <button type="button" class="btn btn-outline-primary" style="font-weight:bold;" onclick="showAdviser()">Adviser</button>
        </div> <br>
        <form action="/petition_old" method="post" enctype="multipart/form-data">
        <center>

    <div id="information" class="card" style="height: auto; width: 700px; text-align:left;">
        <center><h1>Organization Information</h1></center> <br><br>
        
            @csrf
            <h4>All fields with (<span style="color: red;">*</span>) are required for initial submission.</h4><br>
            <label for="OrgName"><h2><span style="color: red;">*</span>Organization Name :</h2></label><br>
            <textarea id="name" name="name" rows="2" cols="4" required></textarea><br><br>
            <label for="OrgName"><h2><span style="color: red;">*</span>Nickame :</h2></label><br>
            <textarea id="name" name="nickname" rows="2" cols="4" required></textarea><br><br>
            <label for="Mission"><h2>Insert Mission :</h2></label><br>
            <textarea id="mission" name="mission" rows="4" cols="50" required></textarea><br><br>

            <label for="Vision"><h2>Insert Vision:</h2> </label><br>
            <textarea id="vision" name="vision" rows="4" cols="50" ></textarea><br><br>

            <label for="janeContact" style="text-align:left;"> Organization Email:</label>
            <input type="org_email" id="org_email" name="org_email" required><br>

            <label for="janeContact" style="text-align:left;"> Organization Facebook:</label>
            <input type="org_fb" id="org_fb" name="org_fb" required><br>

            <label for="OrganizationType"><h2>First Select Organization Type</h2></label><br>
             <select id="type_of_organization" name="type_of_organization" onchange="showHideOthers(this);" required>
                <option value="Academic">Academic</option>
                <option value="Co-Academic">Co-Academic</option>
                <option value="Socio Civic">Socio Civic</option>
                <option value="Religious">Religious</option>
             </select><br></br>
            
             <label for="AcademicCourseBased"><h2>Select, if Org is based on Academic Course</h2></label><br>
             <select id="academic_course_based" name="academic_course_based" onchange="showHideOthers(this);" required>
                <option value="Not Academic Couse Based">None</option>
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
             </select><br></br>
            </div>
            <div id="attachmentfiles" class="card" style="height: auto; width: 700px; text-align:left;">
            <!--Logo-->
            <center>
            <h1>Attachment Files</h1>
            </center>
            <label for="logoFile"><h3>Logo:</h3></label>
            <label for="logo" style="background-color: #007bff; color: #fff; margin-right:550px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload logo</span>
                <input type="file" id="logo" name="logo" accept=".png, .jpg, .jpeg" style="display: none;" required>
            </label><br><br>
            


            <!--Constitution and By Laws-->
            <label for="Constitutions"><h2>Upload Constitutions & ByLaws:</h2></label>
           
            
            <label for="consti_and_byLaws" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload Constitution-Bylaws</span>
                <input type="file" id="consti_and_byLaws" name="consti_and_byLaws" accept=".pdf" style="display: none;" required><br><br>
            </label>
            <br><br>
            
            
            
            
            <!--Letter of Intent--->
            <label for="letterOfIntentFile"><h2>Letter of Intent:</h2></label>
            
            
            <label for="letter_of_intent" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload Letter of Intent</span>
                <input type="file" id="letter_of_intent" name="letter_of_intent" accept=".pdf" style="display: none;" required>
            </label><br><br>
            


            <!---Admin Endorsement--->
            <label for="admin_endorsement"><h2>Admin Endorsement</h2></label>
            <label for="admin_endorsement" style="background-color: #007bff; color: #fff; margin-right:400px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload Admin Endorsement</span>
                <input type="file" id="admin_endorsement" name="admin_endorsement" accept=".pdf" style="display: none;" required>
            </label><br><br>
            </div>
        <div id="label" class="card" style="height: auto; width: 700px; text-align:left;">
            <label for="advisersInfoText">
                <center>
                <h1>Enter Advisers and Officers Information:</h1>
                </center>
            </label>
            
            <div id="adviser" class="card mt-4 mb-4" style="height: auto; text-align:left;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;" ><h2><span style="color: red;">*</span>Adviser:</h2></label>
                                    <label for="janeName" style="text-align:left;"><span style="color: red;">*</span>Name:</label>
                                    <input type="text" id="adviser_name" name="adviser_name" required><br>
                                    <label for="janeContact" style="text-align:left;"><span style="color: red;">*</span>Email:</label>
                                    <input type="text" id="adviser_name" name="adviser_email" required><br>
                                    <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Next" class="btn btn-primary"></input>
        </form>
    </main>
</center>

<script>
    function showOverall(){
        document.getElementById('information').style.display = 'block';
        document.getElementById('attachmentfiles').style.display = 'block';
        document.getElementById('adviser').style.display = 'block';
        document.getElementById('president').style.display = 'block';
        document.getElementById('officers').style.display = 'block';
    }
    function showInformation(){
        document.getElementById('information').style.display = 'block';
        document.getElementById('attachmentfiles').style.display = 'none';
        document.getElementById('label').style.display = 'none'
        document.getElementById('adviser').style.display = 'none';
        document.getElementById('president').style.display = 'none';
        document.getElementById('officers').style.display = 'none';
    }
    function showFiles(){
        document.getElementById('information').style.display = 'none';
        document.getElementById('attachmentfiles').style.display = 'block';
        document.getElementById('label').style.display = 'none'
        document.getElementById('adviser').style.display = 'none';
        document.getElementById('president').style.display = 'none';
        document.getElementById('officers').style.display = 'none';
    }
    function showAdviser(){
        document.getElementById('information').style.display = 'none';
        document.getElementById('attachmentfiles').style.display = 'none';
        document.getElementById('label').style.display = 'block'
        document.getElementById('adviser').style.display = 'block';
        document.getElementById('president').style.display = 'none';
        document.getElementById('officers').style.display = 'none';
    }
    function showPresident(){
        document.getElementById('information').style.display = 'none';
        document.getElementById('attachmentfiles').style.display = 'none';
        document.getElementById('label').style.display = 'block'
        document.getElementById('adviser').style.display = 'none';
        document.getElementById('president').style.display = 'block';
        document.getElementById('officers').style.display = 'none';
    }
    function showOfficers(){
        document.getElementById('information').style.display = 'none';
        document.getElementById('attachmentfiles').style.display = 'none';
        document.getElementById('label').style.display = 'block'
        document.getElementById('adviser').style.display = 'none';
        document.getElementById('president').style.display = 'none';
        document.getElementById('officers').style.display = 'block';
    }
</script>

@endsection