@extends('navbar.admin_nav')

@section('content')    

<main>
    <div class="container mt-4">
        <div class="btn-group mb-4" role="group" aria-label="Basic example">
            <button type="button" style="margin-left: 230px;" class="btn btn-primary" onclick="showMissionVision()">Mission and Vision</button>
            <button type="button" class="btn btn-primary" onclick="showListOfOfficers()">List of Officers</button>
            <button type="button" class="btn btn-primary" onclick="showContactUs()">Contact Us</button>
            <button type="button" class="btn btn-primary" onclick="showEvents()">Events</button>
            <button type="button" class="btn btn-primary" onclick="showMoreInfo()">More Info</button>
            
        </div> <br>

       

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                <!-- ... other content ... -->
        
                <div id="missionVisionContent" class="card mt-1" style="height: 500px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="photos/aubs-logo.png" alt="Vision and Mission Image" class="img-fluid mb-3">
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title">Vision and Mission</h4>
                                <p class="card-text">
                                    <strong>Vision</strong><br><br>
                                    We envision AUBS as a nurturing, caring and learning RSO that promotes scientific interests, awareness and action among the youth especially in the fields of biology, health, environment, and technology.<br><br>
                                    <strong>Mission</strong><br><br>
                                    It is a non-sectarian academe organization that aims to promote camaraderie and good will among its members, thus, fostering cooperation and readiness to serve; works closely with the Department of Natural Sciences and the University Health Services on relevant academic and health activities and services
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        
               <!-- ... rest of the content ... -->
               <div id="listOfOfficersContent" class="card mt-4" style="height: auto ;">
                <div class="card-body">
                    <h4 class="card-title">List of Officers</h4><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jerome Alvez" class="img-fluid" width="100">
                                <p class="officer-name">Jane smith</p>
                                <p class="officer-position"> Adviser </p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">AUSG Representative </p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">President </p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">Vice President for Internal Affairs </p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">Vice President for External Affairs</p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">Secretary </p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">Treasurer</p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">Auditor</p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                <img src="icon.jpg" alt="Jane Smith" class="img-fluid" width="100">
                                <p class="officer-name">Jane Smith</p>
                                <p class="officer-position">PRO</p>
                                <p class="email">sampleemail.@adu.edu.ph </p> <br>
                            </div>
                        </div>
                        <!-- Add more columns as needed -->
                    </div>
                </div>
            </div>

            <div id="ContactUs" class="card mt-4" style="display: none;">
                <div class="card-body">
                    <h4 class="card-title">Contact Us</h4>
                    For inquiries and further information, please feel free to contact us:<br>
                    Email: <a href="mailto:aubs@adamson.edu.ph">aubs@adamson.edu.ph</a><br>
                    FB: <a href="https://www.facebook.com/adamsonbiologysociety/" target="_blank">
                        Adamson University Biology Society</a>
                </div>
            </div>
            
            <div id="Events" class="card mt-4" style="height: auto;">
                <div class="card-body">
                    <h2 class="mb-4">What is your favorite animal?</h2>
                    <form action="" method="post">
                        <div class="mb-2">
                            <input type="radio" id="option1" name="language" value="option1">
                            <label for="option1">Monkey</label>
                        </div>
            
                        <div class="mb-2">
                            <input type="radio" id="option2" name="language" value="option2">
                            <label for="option2">Python</label>
                        </div>
            
                        <div class="mb-2">
                            <input type="radio" id="option3" name="language" value="option3">
                            <label for="option3">Dog</label>
                        </div>
            
                        <div class="mb-2">
                            <input type="radio" id="option4" name="language" value="option4">
                            <label for="option4">Cat</label>
                        </div>
            
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>  <br>
            
                    <H2>Images</H2>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <img src="icon.jpg" alt="Image 1" class="img-fluid mb-3">
                        </div>
                        <div class="col-md-4">
                            <img src="icon.jpg" alt="Image 2" class="img-fluid mb-3">
                        </div>
                        <div class="col-md-4">
                            <img src="icon.jpg" alt="Image 3" class="img-fluid mb-3">
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div id="MoreInfo" class="card mt-1" style="height: auto;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <!-- Details for Constitutional Bylaws -->
                            <h5 class="mb-3">Constitutional Bylaws</h5>
                            <p>
                                Your content for constitutional bylaws goes here. Provide information about the rules and regulations that govern your organization.
                            </p>
            
                            <!-- Details for Letter of Intent -->
                            <h5 class="mt-4 mb-3">Letter of Intent</h5>
                            <p>
                                Include details about the letter of intent, its purpose, and any specific requirements or guidelines for submitting a letter of intent.
                            </p>
            
                            <!-- Details for Adviser Endorsement -->
                            <h5 class="mt-4 mb-3">Adviser Endorsement</h5>
                            <p>
                                Provide information about the process of obtaining adviser endorsement, its importance, and any criteria that advisers need to meet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            
    </main>
        
        

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        function showMissionVision() {
            document.getElementById('missionVisionContent').style.display = 'block';
            document.getElementById('listOfOfficersContent').style.display = 'none';
            document.getElementById('ContactUs').style.display = 'none';
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MoreInfo').style.display = 'none';
        }

        function showListOfOfficers() {
            document.getElementById('missionVisionContent').style.display = 'none';
            document.getElementById('listOfOfficersContent').style.display = 'block';
            document.getElementById('ContactUs').style.display = 'none';
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MoreInfo').style.display = 'none';
        }
        function showContactUs() {
            document.getElementById('missionVisionContent').style.display = 'none';
            document.getElementById('listOfOfficersContent').style.display = 'none';
            document.getElementById('ContactUs').style.display = 'block';
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MoreInfo').style.display = 'none';
        }
        function showEvents() {
            document.getElementById('missionVisionContent').style.display = 'none';
            document.getElementById('listOfOfficersContent').style.display = 'none';
            document.getElementById('ContactUs').style.display = 'none';
            document.getElementById('Events').style.display = 'block';
            document.getElementById('MoreInfo').style.display = 'none';
        }
        function showMoreInfo() {
            document.getElementById('missionVisionContent').style.display = 'none';
            document.getElementById('listOfOfficersContent').style.display = 'none';
            document.getElementById('ContactUs').style.display = 'none';
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MoreInfo').style.display = 'block';
        }

    </script>

             

        
        
    
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

@endsection