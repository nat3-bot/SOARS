@extends('navbar.navbar_student')
@section('content')

<div class="container-tbl-up" style="padding: 0px 100px; margin-top:7%;">
            
            
    <table class="table"> <br>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <center>
            
            <div class="card-table-title" style="padding: 30px 0px 0px 0px;"> 
                <H1>ACADEMIC</H1><br> 
            </div>
                <div class="card-table" style="margin: 0 0 0 0;">
                    @foreach ($organizationAcademic as $orgAcads)
                    @if($orgAcads != NUll)
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="card" style="position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img src="/storage/logo/{{$orgAcads->logo }}" alt="{{$orgAcads->logo}}" style="max-width: 200px;">
                            <div class="card-body" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); overflow: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                <a href="{{url('/student/organization_list/organization_page/'.$orgAcads->id)}}" style="text-decoration: none; display: block;">
                                    <h1 class="card-title" style="color: white; margin: 0; padding: 10px; max-height: 100%; overflow: hidden; text-overflow: ellipsis; text-align: center; text-shadow: -1px -1px 0 #000,  1px -1px 0 #000, -1px  1px 0 #000, 1px  1px 0 #000;">
                                        {{$orgAcads->name}}<br>
                                        
                                    </h1>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                
            
            <div class="card-table-title" style="padding: 30px 0px 0px 0px;"> 
                <H1>CO-ACADEMIC</H1><br> </div>
            <div class="card-table" style="margin: 0 0 0 0;">
                @foreach ($organizationCoAcademic as $orgCoAcad)
                @if($orgCoAcad != Null)
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="card" style="position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <img src="/storage/logo/{{$orgCoAcad->logo }}" alt="{{$orgCoAcad->logo}}" style="max-width: 200px;">
                        <div class="card-body" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); overflow: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <a href="{{url('/student/organization_list/organization_page/'.$orgCoAcad->id)}}" style="text-decoration: none; display: block;">
                                <h1 class="card-title" style="color: white; margin: 0; padding: 10px; max-height: 100%; overflow: hidden; text-overflow: ellipsis; text-align: center; text-shadow: -1px -1px 0 #000,  1px -1px 0 #000, -1px  1px 0 #000, 1px  1px 0 #000;">
                                    {{$orgCoAcad->name}}<br>
                                    
                                </h1>
                            </a>
                        </div>
                        
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="card-table-title" style="padding: 30px 0px 0px 0px;"> 
                <H1>SOCIO-CIVIC</H1><br> </div>
                <div class="card-table" style="margin: 0 0 0 0;">
                @foreach ($organizationSocioCivic as $orgSocioCivic)
                @if($orgSocioCivic != Null)
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="card" style="position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <img src="/storage/logo/{{$orgSocioCivic->logo }}" alt="{{$orgSocioCivic->logo}}" style="max-width: 200px;">
                        <div class="card-body" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); overflow: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <a href="{{url('/student/organization_list/organization_page/'.$orgSocioCivic->id)}}" style="text-decoration: none; display: block;">
                                <h1 class="card-title" style="color: white; margin: 0; padding: 10px; max-height: 100%; overflow: hidden; text-overflow: ellipsis; text-align: center; text-shadow: -1px -1px 0 #000,  1px -1px 0 #000, -1px  1px 0 #000, 1px  1px 0 #000;">
                                    {{$orgSocioCivic->name}}<br>
                                    
                                </h1>
                            </a>
                        </div>
                        
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            
            <div class="card-table-title" style="padding: 30px 0px 0px 0px;"> <H1>RELIGIOUS</H1><br> </div>
            <div class="card-table" style="margin: 0 0 0 0;">
                @foreach ($organizationReligious as $orgRel)
                @if($orgRel != Null)
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="card" style="position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <img src="/storage/logo/{{$orgRel->logo }}" alt="{{$orgRel->logo}}" style="max-width: 200px;">
                        <div class="card-body" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); overflow: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <a href="{{url('/student/organization_list/organization_page/'.$orgRel->id)}}" style="text-decoration: none; display: block;">
                                <h1 class="card-title" style="color: white; margin: 0; padding: 10px; max-height: 100%; overflow: hidden; text-overflow: ellipsis; text-align: center; text-shadow: -1px -1px 0 #000,  1px -1px 0 #000, -1px  1px 0 #000, 1px  1px 0 #000;">
                                    {{$orgRel->name}}<br>
                                    
                                </h1>
                            </a>
                        </div>
                        
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </Center>
        
    </table>
    
     </div>
     

</div>



</div>

<script>
    // Show the modal when the button is clicked
    document.getElementById("createUserButton").addEventListener("click", function() {
        $('#createUserModal').modal('show');
    });
</script>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

