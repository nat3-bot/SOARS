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
       
        <div class="card" style="height: auto; width: 740px;">
        <center>
            <h1>Organization Information Form</h1> <br><br>
        </center>
        
        <form action="/osaemp/organization_list/pending_edit_save/{{$org->id}}" method="POST" enctype="multipart/form-data" style="text-align:start;">
            @csrf
            
            
            <label><h2>Requirement Status: <?php
            if($org->requirement_status == "complete"){
                echo "Requirement Complete";
            }
            
            if($org->requirement_status != "complete" || $org->requirement_status <= '100'){
                echo round($org->requirement_status) . '%';
            }
            ?>
            
                @if($org->requirement_status == 100)
                <button type="submit" name="complete" value="{{$org->id}}" style="background-color: 
                #007bff; color: #fff; padding: 10px 15px; border-radius: 5px; cursor: pointer;">Publish for Completion</button><br>
                @endif
            </h2>
            
            </label>
            <br>
            <label for="OrgId"><h2>Org ID: {{$org->id}}</h2></label><br>
            <label for="OrgName"><h2>Organization Name:</h2></label><br>
            <textarea id="name" name="name" rows="2" cols="80" required>{{$org->name}}</textarea><br><br>
            <label for="OrgName"><h2>Nickame :</h2></label><br>
            <textarea id="nameickname" name="nickname" rows="2" cols="80" required>{{$org->nickname}}</textarea><br><br>
            <label for="Mission"><h2>Insert Mission :</h2></label><br>
            <textarea id="mission" name="mission" rows="4" cols="80" >{{$org->mission}}</textarea><br><br>

            <label for="Vision"><h2>Insert Vision:</h2> </label><br>
            <textarea id="vision" name="vision" rows="4" cols="80" >{{$org->vision}}</textarea><br><br>

            <label for="Vision"><h2> Organization Email:</h2></label> <br>
            <input type="org_email" id="org_email" name="org_email"  placeholder="{{$org->org_email}}" value="{{$org->org_email}}"><br><br>

            <label for="Vision"><h2>Organization Facebook:</h2> </label><br>
            <input type="org_fb" id="org_fb" name="org_fb"  placeholder="{{$org->org_fb}}" value="{{$org->org_fb}}"><br><br>

            <label for="OrganizationType"><h2>First Select Organization Type</h2></label>
             <select id="type_of_organization" name="type_of_organization" onchange="showHideOthers(this);" required>
                <option value="Academic"{{$org->type_of_organization == 'Academic' ? 'selected' : ' '}}>Academic</option>
                <option value="Co-Academic" {{$org->type_of_organization == 'Co-Academic' ? 'selected' : ' '}}>Co-Academic</option>
                <option value="Socio Civic" {{$org->type_of_organization == 'Socio Civic' ? 'selected' : ' '}}>Socio Civic</option>
                <option value="Religious" {{$org->type_of_organization == 'Religious' ? 'selected' : ' '}}>Religious</option>
             </select><br></br>

             <label for="AcademicCourseBased"><h2>Select, if Org is based on Academic Course</h2></label><br>
             <select id="academic_course_based" name="academic_course_based" onchange="showHideOthers(this);" required>
                <option value="Not Academic Couse Based" {{$org->academic_course_based == 'Not Academic Couse Based' ? 'selected' : ' '}}>None</option>
                <option value="ACT"{{$org->academic_course_based == 'ACT' ? 'selected' : ' '}}>Associate in Computer Technology</option>
                <option value="BAComm"{{$org->academic_course_based == 'BAComm' ? 'selected' : ' '}}>Bachelor of Arts in Communication</option>
                <option value="BAPhilo"{{$org->academic_course_based == 'BAPhilo' ? 'selected' : ' '}}>Bachelor of Arts in Philosophy</option>
                <option value="BAPolSci"{{$org->academic_course_based == 'BAPolSci' ? 'selected' : ' '}}>Bachelor of Arts in Political Science</option>
                <option value="BEEd"{{$org->academic_course_based == 'BEEd' ? 'selected' : ' '}}>Bachelor of Elementary Education</option>
                <option value="BPEd"{{$org->academic_course_based == 'BPEd' ? 'selected' : ' '}}>Bachelor of Physical Education</option>
                <option value="BPE-SWM"{{$org->academic_course_based == 'BPE-SWM' ? 'selected' : ' '}}>Bachelor of Physical Education Major in Sports and Wellness Management</option>
                <option value="BSA"{{$org->academic_course_based == 'BSA' ? 'selected' : ' '}}>Bachelor of Science in Accountancy</option>
                <option value="BSArchi"{{$org->academic_course_based == 'BSArchi' ? 'selected' : ' '}}>Bachelor of Science in Architecture</option>
                <option value="BSBio"{{$org->academic_course_based == 'BSBio' ? 'selected' : ' '}}>Bachelor of Science in Biology</option>
                <option value="BSBAFM"{{$org->academic_course_based == 'BSBAFM' ? 'selected' : ' '}}>Bachelor of Science in Business Administration Major in Financial Management</option>
                <option value="BSBAMM"{{$org->academic_course_based == 'BSBAMM' ? 'selected' : ' '}}>Bachelor of Science in Business Administration Major in Marketing Management</option>
                <option value="BSBAOM"{{$org->academic_course_based == 'BSBAOM' ? 'selected' : ' '}}>Bachelor of Science in Business Administration Major in Operations Management</option>
                <option value="BSChE"{{$org->academic_course_based == 'BSChE' ? 'selected' : ' '}}>Bachelor of Science in Chemical Engineering</option>
                <option value="BSCPT"{{$org->academic_course_based == 'BSCPT' ? 'selected' : ' '}}>Bachelor of Science in Chemical Process Technology</option>
                <option value="BSChem"{{$org->academic_course_based == 'BSChem' ? 'selected' : ' '}}>Bachelor of Science in Chemistry</option>
                <option value="BSCE"{{$org->academic_course_based == 'BSCE' ? 'selected' : ' '}}>Bachelor of Science in Civil Engineering</option>
                <option value="BSCooE"{{$org->academic_course_based == 'BSCooE' ? 'selected' : ' '}}>Bachelor of Science in Computer Engineering</option>
                <option value="BSCS"{{$org->academic_course_based == 'BSCS' ? 'selected' : ' '}}>Bachelor of Science in Computer Science</option>
                <option value="BSCA"{{$org->academic_course_based == 'BSCA' ? 'selected' : ' '}}>Bachelor of Science in Customs Administration</option>
                <option value="BSEE"{{$org->academic_course_based == 'BSEE' ? 'selected' : ' '}}>Bachelor of Science in Electrical Engineering</option>
                <option value="BSGeo"{{$org->academic_course_based == 'BSGeo' ? 'selected' : ' '}}>Bachelor of Science in Geology</option>
                <option value="BSHM"{{$org->academic_course_based == 'BSHM' ? 'selected' : ' '}}>Bachelor of Science in Hospitality Management</option>
                <option value="BSIE"{{$org->academic_course_based == 'BSIE' ? 'selected' : ' '}}>Bachelor of Science in Industrial Engineering</option>
                <option value="BSIS"{{$org->academic_course_based == 'BSIS' ? 'selected' : ' '}}>Bachelor of Science in Information System</option>
                <option value="BSIT"{{$org->academic_course_based == 'BSIT' ? 'selected' : ' '}}>Bachelor of Science in Information Technology</option>
                <option value="BSME"{{$org->academic_course_based == 'BSME' ? 'selected' : ' '}}>Bachelor of Science in Mechanical Engineering</option>
                <option value="BSMining"{{$org->academic_course_based == 'BSMining' ? 'selected' : ' '}}>Bachelor of Science in Mining Engineering</option>
                <option value="BSNursing"{{$org->academic_course_based == 'BSNursing' ? 'selected' : ' '}}>Bachelor of Science in Nursing</option>
                <option value="BSPE"{{$org->academic_course_based == 'BSPE' ? 'selected' : ' '}}>Bachelor of Science in Petroleum Engineering</option>
                <option value="BSPharma"{{$org->academic_course_based == 'BSPharma' ? 'selected' : ' '}}>Bachelor of Science in Pharmacy</option>
                <option value="BSPsych"{{$org->academic_course_based == 'BSPsych' ? 'selected' : ' '}}>Bachelor of Science in Psychology</option>
             </select><br></br>


            <!--Logo-->
            <label for="logoFile"><h3>Logo:</h3></label>
            @if (isset($org->logo))
            <h6>File already uploaded:
            <img src="/storage/logo/{{$org->logo}}" alt="{{$org->logo}}" style="max-width: 200px; padding-bottom:10px;">
            </h6>
            <label for="logo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Change Logo</span>
                <input type="file" id="logo" name="logo" accept=".png, .jpg, .jpeg" style="display: none;">
            </label><br><br>
            @endif
            @if ($org->logo == null)
            <label for="logo" style="background-color: #007bff; color: #fff; margin-right:550px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload logo</span>
                <input type="file" id="logo" name="logo" accept=".png, .jpg, .jpeg" style="display: none;">
            </label><br><br>
            @endif


            <!--Constitution and By Laws-->
            <label for="Constitutions"><h2>Upload Constitutions & ByLaws:</h2></label>
            @if (isset($org->consti_and_byLaws))
            <h6>File already uploaded:
                <iframe src="/storage/consti_and_bylaws/{{$org->consti_and_byLaws}}" width="100%" height="600px"></iframe>
                </h6>

                <label for="consti_and_byLaws" style="background-color: #007bff; color: #fff; margin-right:400px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                    <span>Change Constitution and By Laws</span>
                    <input type="file" id="consti_and_byLaws" name="consti_and_byLaws" accept=".pdf" style="display: none;">
                </label><br><br>
                
            @endif
            @if ($org->consti_and_byLaws == null)
            <label for="consti_and_byLaws" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload Constitution-Bylaws</span>
                <input type="file" id="consti_and_byLaws" name="consti_and_byLaws" accept=".pdf" style="display: none;"><br><br>
            </label>
            <br><br>
            @endif
            
            
            
            <!--Letter of Intent--->
            <label for="letterOfIntentFile"><h2>Letter of Intent:</h2></label>
            @if (isset($org->letter_of_intent))
            <h6>File already uploaded:
                <iframe name="letter_of_intent" src="/storage/letter_of_intent/{{$org->letter_of_intent}}" width="100%" height="600px"></iframe>
                </h6>

                <label for="letter_of_intent" style="background-color: #007bff; color: #fff; margin-right:400px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                    <span>Change Letter of Intent</span>
                    <input type="file" id="letter_of_intent" name="letter_of_intent" accept=".pdf" style="display: none;">
                </label><br><br>
            @endif
            @if ($org->letter_of_intent == null)
            <label for="letter_of_intent" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload Letter of Intent</span>
                <input type="file" id="letter_of_intent" name="letter_of_intent" accept=".pdf" style="display: none;">
            </label><br><br>
            @endif


            <!---Admin Endorsement--->
            <label for="admin_endorsement"><h2>Admin Endorsement</h2></label>
            @if (isset($org->admin_endorsement))
            <h6>File already uploaded:
                <iframe src="/storage/admin_endorsement/{{$org->admin_endorsement}}" width="100%" height="600px"></iframe>
                </h6>

                <label for="admin_endorsement" style="background-color: #007bff; color: #fff; margin-right:400px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                    <span>Change Admin Endorsement</span>
                    <input type="file" id="admin_endorsement" name="admin_endorsement" accept=".pdf" style="display: none;">
                </label><br><br>
                
            @endif
            
            @if ($org->admin_endorsement == null)
            <label for="admin_endorsement" style="background-color: #007bff; color: #fff; margin-right:400px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                <span>Upload Admin Endorsement</span>
                <input type="file" id="admin_endorsement" name="admin_endorsement" accept=".pdf" style="display: none;">
            </label><br><br>
            @endif


            <label for="advisersInfoText">
                <h2>Edit Advisers and Officers Information:</h2>
            </label>
            
            <div id="listOfOfficersContent" class="card mt-4 mb-4" style="height: auto; text-align:start;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;" ><h3>Adviser:</h3></label><br>
                                    <label for="janeName" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="adviser_name" name="adviser_name"  placeholder="{{$org->adviser_name}}" value="{{$org->adviser_name}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="adviser_name" name="adviser_email" placeholder="{{$org->adviser_email}}" value="{{$org->adviser_email}}" style="width: 100%;"><br>
                                    @if (isset($org->adviser_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/adviser_photo/{{$org->adviser_photo}}" alt="{{$org->adviser_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="adviser_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Adviser Photo</span>
                                        <input type="file" id="adviser_photo" name="adviser_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->adviser_photo == null)
                                    <label for="adviser_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="adviser_photo" name="adviser_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <br><br>
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>AUSG Representative:</h3></label><br>
                                    <label for="ausg_rep_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="text" id="ausg_rep_studno" name="ausg_rep_studno" maxlength="9"placeholder="{{$org->ausg_rep_studno}}" value="{{$org->ausg_rep_studno}}"style="width: 100%;"><br><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="ausg_rep_name" name="ausg_rep_name" placeholder="{{$org->ausg_rep_name}}" value="{{$org->ausg_rep_name}}"style="width: 100%;"><br><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="ausg_rep_email" name="ausg_rep_email" placeholder="{{$org->ausg_rep_email}}" value="{{$org->ausg_rep_email}}"style="width: 100%;"><br>
                                    @if (isset($org->ausg_rep_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/ausg_rep_photo/{{$org->ausg_rep_photo}}" alt="{{$org->ausg_rep_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="ausg_rep_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change AUSG Representative Photo</span>
                                        <input type="file" id="ausg_rep_photo" name="ausg_rep_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->ausg_rep_photo == null)
                                    <label for="ausg_rep_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="ausg_rep_photo" name="ausg_rep_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>President:</h3></label><br>
                                    <label for="president_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="president_studno" name="president_studno" maxlength="9"placeholder="{{$org->president_studno}}" value="{{$org->president_studno}}"style="width: 100%;"><br><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="president_name" name="president_name" placeholder="{{$org->president_name}}" value="{{$org->president_name}}"style="width: 100%;"><br><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="president_email" name="president_email" placeholder="{{$org->president_email}}" value="{{$org->president_email}}"style="width: 100%;"><br>
                                    @if (isset($org->president_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/president_photo/{{$org->president_photo}}" alt="{{$org->president_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="president_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change President Photo</span>
                                        <input type="file" id="president_photo" name="president_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->president_photo == null)
                                    <label for="president_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="president_photo" name="president_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>Vp Internal:</h3></label><br>
                                    <label for="vp_internal_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="vp_internal_studno" name="vp_internal_studno" maxlength="9" placeholder="{{$org->vp_internal_studno}}" value="{{$org->vp_internal_studno}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="vp_internal_name" name="vp_internal_name" placeholder="{{$org->vp_internal_name}}" value="{{$org->vp_internal_name}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="vp_internal_email" name="vp_internal_email" placeholder="{{$org->vp_internal_email}}" value="{{$org->vp_internal_email}}"style="width: 100%;"><br>
                                    @if (isset($org->vp_internal_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/vp_internal_photo/{{$org->vp_internal_photo}}" alt="{{$org->vp_internal_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="vp_internal_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Vice President Internal Photo</span>
                                        <input type="file" id="vp_internal_photo" name="vp_internal_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->vp_internal_photo == null)
                                    <label for="vp_internal_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="vp_internal_photo" name="vp_internal_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>Vp External:</h3></label><br>
                                    <label for="vp_external_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="vp_external_studno" name="vp_external_studno" maxlength="9" placeholder="{{$org->vp_external_studno}}" value="{{$org->vp_external_studno}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="vp_external_name" name="vp_external_name" placeholder="{{$org->vp_external_name}}" value="{{$org->vp_external_name}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="vp_external_email" name="vp_external_email" placeholder="{{$org->vp_external_email}}" value="{{$org->vp_external_email}}"style="width: 100%;"><br>
                                    @if (isset($org->vp_external_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/vp_external_photo/{{$org->vp_external_photo}}" alt="{{$org->vp_external_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="vp_external_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Vice President External Photo</span>
                                        <input type="file" id="vp_external_photo" name="vp_external_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->vp_external_photo == null)
                                    <label for="vp_external_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="vp_external_photo" name="vp_external_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>Secretary:</h3></label><br>
                                    <label for="secretary_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="secretary_studno" name="secretary_studno" maxlength="9" placeholder="{{$org->secretary_studno}}" value="{{$org->secretary_studno}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="secretary_name" name="secretary_name" placeholder="{{$org->secretary_name}}" value="{{$org->secretary_name}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="secretary_email" name="secretary_email" placeholder="{{$org->secretary_email}}" value="{{$org->secretary_email}}"style="width: 100%;"><br>
                                    @if (isset($org->secretary_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/secretary_photo/{{$org->secretary_photo}}" alt="{{$org->secretary_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="secretary_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Secretary Photo</span>
                                        <input type="file" id="secretary_photo" name="secretary_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->secretary_photo == null)
                                    <label for="secretary_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="secretary_photo" name="secretary_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>Treasurer:</h3></label><br>
                                    <label for="treasurer_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="treasurer_studno" name="treasurer_studno" maxlength="9" placeholder="{{$org->treasurer_studno}}" value="{{$org->treasurer_studno}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="treasurer_name" name="treasurer_name" placeholder="{{$org->treasurer_name}}" value="{{$org->treasurer_name}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="treasurer_email" name="treasurer_email" placeholder="{{$org->treasurer_email}}" value="{{$org->treasurer_email}}"style="width: 100%;"><br>
                                    @if (isset($org->treasurer_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/treasurer_photo/{{$org->treasurer_photo}}" alt="{{$org->treasurer_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="treasurer_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Treasurer Photo</span>
                                        <input type="file" id="treasurer_photo" name="treasurer_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->treasurer_photo == null)
                                    <label for="treasurer_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="treasurer_photo" name="treasurer_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>Auditor:</h3></label><br>
                                    <label for="auditor_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="auditor_studno" name="auditor_studno" maxlength="9" placeholder="{{$org->auditor_studno}}" value="{{$org->auditor_studno}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="auditor_name" name="auditor_name" placeholder="{{$org->auditor_name}}" value="{{$org->auditor_name}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="auditor_email" name="auditor_email" placeholder="{{$org->auditor_email}}" value="{{$org->auditor_email}}" style="width: 100%;"><br>
                                    @if (isset($org->auditor_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/auditor_photo/{{$org->auditor_photo}}" alt="{{$org->auditor_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="auditor_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Auditor Photo</span>
                                        <input type="file" id="auditor_photo" name="auditor_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->auditor_photo == null)
                                    <label for="auditor_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="auditor_photo" name="auditor_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="col-md-15">
                            <div class="officer-card">
                                    <label for="janePosition" style="text-align:left;"><h3>PRO:</h3></label><br>
                                    <label for="pro_studno" style="text-align:left;">Student No:</label><br>
                                    <input type="number" id="pro_studno" name="pro_studno" maxlength="9" placeholder="{{$org->pro_studno}}" value="{{$org->pro_studno}}"style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Name:</label><br>
                                    <input type="text" id="pro_name" name="pro_name" placeholder="{{$org->pro_name}}" value="{{$org->pro_name}}" style="width: 100%;"><br>
                                    <label for="janeContact" style="text-align:left;">Email:</label><br>
                                    <input type="email" id="pro_email" name="pro_email" placeholder="{{$org->pro_email}}" value="{{$org->pro_email}}" style="width: 100%;"><br>
                                    @if (isset($org->pro_photo))
                                    <br><h6 style="text-align: start;">
                                    <img src="/storage/organization_officer_photo/pro_photo/{{$org->pro_photo}}" alt="{{$org->pro_photo}}" style="max-width: 200px; padding-bottom:10px;">
                                    </h6>
                                    <h5 style="text-align: start;"> File already uploaded:</h5><br>
                                    <label for="pro_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Change Pro Photo</span>
                                        <input type="file" id="pro_photo" name="pro_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                                    @if ($org->pro_photo == null)
                                    <label for="pro_photo" style="background-color: #007bff; color: #fff; margin-right:450px; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                                        <span>Upload Photo</span>
                                        <input type="file" id="pro_photo" name="pro_photo" accept=".png, .jpg, .jpeg" style="display: none;">
                                    </label><br><br>
                                    @endif
                            </div>
                        </div>
                        <br><br>
                        <button type="submit" name="edited" value="{{$org->id}}" style="background-color: #007bff; color: #fff; margin-right:550px; margin-bottom: 10px;padding: 10px 15px; border-radius: 5px; cursor: pointer;">Save</button><br>
                        @if ($org->requirement_status == 'complete')
                        <button type="submit" name="org_page" style="background-color: #7e7e7e; color: #fff; padding: 10px 15px; border-radius: 5px; cursor: pointer;margin-right:450px;">Go Back</button>
                        @endif
                        @if ($org->requirement_status != 'complete')
                        <button type="submit" name="cancel" style="background-color: #7e7e7e; color: #fff; padding: 10px 15px; border-radius: 5px; cursor: pointer;margin-right:550px;">Cancel</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </main>
</center>
            

<script>
    var officerContainer = document.getElementById('officerContainer');
    var originalForm = officerContainer.innerHTML;

    function addOfficerForm() {
        var newForm = document.createElement('form');
        newForm.innerHTML = originalForm; // Copy the original form's structure

        officerContainer.parentNode.insertBefore(newForm, officerContainer.nextSibling);

        // Show the Undo button
        document.getElementById('undoButton').style.display = 'inline';
    }
</script>

<script>
    function undoAddOfficerForm() {
        // Remove the last added form
        var forms = document.getElementsByTagName('form');
        if (forms.length > 1) {
            forms[forms.length - 1].remove();
        } else {
            // If there's only one form, reset its content to the original
            officerContainer.innerHTML = originalForm;

            // Hide the Undo button
            document.getElementById('undoButton').style.display = 'none';
        }
    }
</script>
<script>
function confirmSubmission() {
    // Show a confirmation dialog
    var isConfirmed = window.confirm("Are you sure you want to proceed with the submission?");

    // If the user clicks "OK" in the confirmation dialog, submit the form
    if (isConfirmed) {
        document.forms[0].submit(); // Assuming the form is the first form in your document
    }
}
</script>






@endsection