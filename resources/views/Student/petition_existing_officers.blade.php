@extends('navbar.navbar_student')
@section('content')
<style>
    form {
        text-align: left;
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
        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example" style="margin-top:5%; margin-bottom:2%;">
        </div><br>
        <form action="{{ route('student.check') }}" method="POST">
            @csrf
            <input type="hidden" id="clickedButton" name="clickedButton" value="">
            <center>
                <div id="label" class="card" style="height: auto; width: 700px; text-align:left;">
                    <label for="advisersInfoText">
                        <center>
                            <h1>Officers Information:</h1>
                        </center>
                    </label>
                    

                    @if($pres == 1)
                    <div id="president" class="card mt-4 mb-4" style="height: auto; text-align: left;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="president_studno"><h5>President:</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='president_studno'"
                                            @if(session('success') && session('field') === 'president_studno') disabled @endif>
                                        Check:
                                    </button>
                                    <input type="text" class="form-control" id="president_studno" name="president_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'president_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'president_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                    <a class="btn btn-success" type="submit" href="/petition/officers/2" style="text-align: end;">
                                        Next
                                    </a>
                                @elseif (session('error') && session('field') === 'president_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($officers == 1)
                    <div id="officers" class="card " style=" text-align: left;" >
                        <div class="card-body">
                            <!-- AUSG -->
                            <div class="form-group">
                                <label for="vp_internal_studno"><h5>AUSG:</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='ausg_rep_studno'"
                                            @if(session('success') && session('field') === 'asug_rep_studno') disabled @endif>
                                            Check:
                                    </button>
                                    <input type="text" class="form-control" id="ausg_rep_studno" name="ausg_rep_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'ausg_rep_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'ausg_rep_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                @elseif (session('error') && session('field') === 'ausg_rep_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>
                            <!-- Vice Presidents -->
                            <div class="form-group">
                                <label for="vp_internal_studno"><h5>Vice President (Internal):</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='vp_internal_studno'"
                                            @if(session('success') && session('field') === 'vp_internal_studno') disabled @endif>
                                            Check:
                                    </button>
                                    <input type="text" class="form-control" id="vp_internal_studno" name="vp_internal_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'vp_internal_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'vp_internal_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                @elseif (session('error') && session('field') === 'vp_internal_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="vp_external_studno"><h5>Vice President (External):</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='vp_external_studno'"
                                            @if(session('success') && session('field') === 'vp_external_studno') disabled @endif>
                                            Check:
                                    </button>
                                    <input type="text" class="form-control" id="vp_external_studno" name="vp_external_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'vp_external_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'vp_external_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                @elseif (session('error') && session('field') === 'vp_external_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>

                            <!-- Secretaries -->
                            <div class="form-group">
                                <label for="secretary_studno"><h5>Secretary:</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='secretary_studno'"
                                            @if(session('success') && session('field') === 'secretary_studno') disabled @endif>
                                            Check:
                                    </button>
                                    <input type="text" class="form-control" id="secretary_studno" name="secretary_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'secretary_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'secretary_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                @elseif (session('error') && session('field') === 'secretary_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>

                            <!-- Treasurers -->
                            <div class="form-group">
                                <label for="treasurer_studno"><h5>Treasurer:</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='treasurer_studno'"
                                            @if(session('success') && session('field') === 'treasurer_studno') disabled @endif>
                                            Check:
                                    </button>
                                    <input type="text" class="form-control" id="treasurer_studno" name="treasurer_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'treasurer_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'treasurer_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                @elseif (session('error') && session('field') === 'treasurer_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>

                            <!-- Auditors -->
                            <div class="form-group">
                                <label for="auditor_studno"><h5>Auditor:</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='auditor_studno'"
                                            @if(session('success') && session('field') === 'auditor_studno') disabled @endif>
                                            Check:
                                    </button>
                                    <input type="text" class="form-control" id="auditor_studno" name="auditor_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'auditor_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'auditor_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                @elseif (session('error') && session('field') === 'auditor_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>

                            <!-- PRO -->
                            <div class="form-group">
                                <label for="pro_studno"><h5>PRO:</h5></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success" type="submit" id="button-addon1" 
                                            onclick="document.getElementById('clickedButton').value='pro_studno'"
                                            @if(session('success') && session('field') === 'pro_studno') disabled @endif>
                                            Check
                                    </button>
                                    <input type="text" class="form-control" id="pro_studno" name="pro_studno" maxlength="9"
                                           @if(session('success') && session('field') === 'pro_studno') disabled @endif>
                                </div>
                                @if (session('success') && session('field') === 'pro_studno')
                                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                                    <a class="btn btn-success" type="submit" href="/student" style="text-align: end;">
                                        Next
                                    </a>
                                @elseif (session('error') && session('field') === 'pro_studno')
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

        </form>
    </main>
</center>
@endsection
