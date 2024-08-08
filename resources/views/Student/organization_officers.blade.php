@extends('navbar.navbar_student')
@section('content')
<form action="/checkOfficers/president" method="POST" style="margin-top: 7%;">
    @csrf
    <input type="hidden" id="clickedButton" name="clickedButton" value="">
    <center>
        <div id="label" class="card" style="height: auto; width: 700px; text-align:left;">
            
            <label style="text-align: center; margin-top:3%; margin-bottom:4%;"><h1>Manage Officers ({{$org->nickname}})</h1></label>

                <div class="card-body">
                    <!--President-->
                    <div class="form-group">
                        <label for=""><h3>President:</h3></label><br>
                        <label for=""><h5>Name: {{$org->president_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='president_studno'">
                                Verify:
                            </button>
                            <input type="text" placeholder="{{$org->president_studno}}" value="{{$org->president_studno}}" class="form-control" id="president_studno" name="president_studno" maxlength="9">
                        </div>
                        @if (session('error') && session('field') === 'president_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>
                    <!-- AUSG -->
                    <div class="form-group">
                        <label for="ausg_rep_studno"><h3>AUSG:</h3></label><br>
                        <label for="ausg_rep_name"><h5>Name: {{$org->ausg_rep_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='ausg_rep_studno'">
                                    Verify:
                            </button>
                            <input type="text" value="{{$org->ausg_rep_studno}}" class="form-control" id="ausg_rep_studno" name="ausg_rep_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'ausg_rep_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @elseif (session('error') && session('field') === 'ausg_rep_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>
                    <!-- Vice Presidents -->
                    <div class="form-group">
                        <label for="vp_internal_studno"><h3>Vice President (Internal):</h3></label><br>
                        <label for="vp_internal_name"><h5>Name: {{$org->vp_internal_name}}</h5>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='vp_internal_studno'">
                                    Verify:
                            </button>
                            <input type="text" value="{{$org->vp_internal_studno}}"  class="form-control" id="vp_internal_studno" name="vp_internal_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'vp_internal_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @elseif (session('error') && session('field') === 'vp_internal_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>
                    <div class="form-group">
                        <label for="vp_external_studno"><h3>Vice President (External):</h3></label><br>
                        <label for="vp_external_name"><h5>Name: {{$org->vp_external_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='vp_external_studno'">
                                    Verify:
                            </button>
                            <input type="text" value="{{$org->vp_external_studno}}" class="form-control" id="vp_external_studno" name="vp_external_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'vp_external_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @elseif (session('error') && session('field') === 'vp_external_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div>
                    <br><br>
                    <!-- Secretaries -->
                    <div class="form-group">
                        <label for="secretary_studno"><h3>Secretary:</h3></label><br>
                        <label for="secretary_name"><h5>Name: {{$org->secretary_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='secretary_studno'">
                                    Verify:
                            </button>
                            <input type="text" value="{{$org->secretary_studno}}" class="form-control" id="secretary_studno" name="secretary_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'secretary_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @elseif (session('error') && session('field') === 'secretary_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>

                    <!-- Treasurers -->
                    <div class="form-group">
                        <label for="treasurer_studno"><h3>Treasurer:</h3></label><br>
                        <label for="treasurer_name"><h5>Name: {{$org->treasurer_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='treasurer_studno'">
                                    Verify:
                            </button>
                            <input type="text" value="{{$org->treasurer_studno}}" class="form-control" id="treasurer_studno" name="treasurer_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'treasurer_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @elseif (session('error') && session('field') === 'treasurer_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>

                    <!-- Auditors -->
                    <div class="form-group">
                        <label for="auditor_studno"><h3>Auditor:</h3></label><br>
                        <label for="auditor_name"><h5>Name: {{$org->auditor_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='auditor_studno'">
                                    Verify:
                            </button>
                            <input type="text" value="{{$org->auditor_studno}}" class="form-control" id="auditor_studno" name="auditor_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'auditor_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @elseif (session('error') && session('field') === 'auditor_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>

                    <!-- PRO -->
                    <div class="form-group">
                        <label for="pro_studno"><h3>PRO:</h3></label><br>
                        <label for="pro_name"><h5>Name: {{$org->pro_name}}</h5></label>
                        <div class="input-group mb-3">
                            <button class="btn btn-success" type="submit" id="button-addon1" 
                                    onclick="document.getElementById('clickedButton').value='pro_studno'">
                                    Verify
                            </button>
                            <input type="text" value="{{$org->pro_studno}}" class="form-control" id="pro_studno" name="pro_studno" maxlength="9">
                        </div>
                        @if (session('success') && session('field') === 'pro_studno')
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                            <a class="btn btn-success" type="submit" href="/student" style="text-align: end;">
                                Next
                            </a>
                        @elseif (session('error') && session('field') === 'pro_studno')
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div><br><br>
                </div>
            </form>
            <form action="/save_officers/president/{{$org->id}}">
                <input type="text" placeholder="{{$org->president_studno}}" value="{{$org->president_studno}}" class="form-control" id="president_studno" name="president_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->ausg_rep_studno}}" value="{{$org->ausg_rep_studno}}" class="form-control" id="ausg_rep_studno" name="ausg_rep_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->vp_internal_studno}}" value="{{$org->vp_internal_studno}}"  class="form-control" id="vp_internal_studno" name="vp_internal_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->vp_external_studno}}" value="{{$org->vp_external_studno}}" class="form-control" id="vp_external_studno" name="vp_external_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->secretary_studno}}" value="{{$org->secretary_studno}}" class="form-control" id="secretary_studno" name="secretary_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->treasurer_studno}}" value="{{$org->treasurer_studno}}" class="form-control" id="treasurer_studno" name="treasurer_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->auditor_studno}}" value="{{$org->auditor_studno}}" class="form-control" id="auditor_studno" name="auditor_studno" maxlength="9" hidden>
                <input type="text" placeholder="{{$org->pro_studno}}" value="{{$org->pro_studno}}" class="form-control" id="pro_studno" name="pro_studno" maxlength="9" hidden>
            <button type="submit" class="btn btn-success">Save Officers</a>
            </form>
        </div>
    </center>

@endsection