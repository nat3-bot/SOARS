@extends('navbar.navbar_osa')

@section('content')

<main>
    <div class="container-report-list" style="padding: 0px 200px 0px 200px;">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="btn-group">
            <a class="btn btn-create" type="button" id="createUserButton" style="margin-left: 10px; margin-top: 5%; text-align:end" 
            href="{{url('/osaemp/organization_list')}}">Go to Manage Organization</a>
        </div>
        <center>
        <div class="card-table-title" style="padding: 30px 0px 0px 0px;"> 
            <H1>Pending Organizations</H1><br> 
        </div>
        </center>
        <div class="table-responsive" style="overflow-x: auto;"> <!-- Add this div to make the table responsive -->
            <table class="table table-bordered table-center"> <!-- Added table-center class -->
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Organization Name</th>
                        <th>Organization Type</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($org_activation as $org)
                        
                    @if($org->requirement_status != "complete")
                    <tr>
                        <td>
                            @if ($org->requirement_status != 'Approved' && $org->requirement_status != 'complete')
                            @php
                                $rounded = $org->requirement_status;
                            @endphp
                            {{$rounded}}% out of 100
                            @endif

                            @if ($org->requirement_status == 'complete')
                            Complete
                            @endif
                        </td>
                        <td>{{$org->name}}</td>
                        <td>{{$org->type_of_organization}}</td>
                        <td>
                            @if($org->requirement_status == 'complete')
                            <a href="{{url('/osaemp/organization_list/organization_edit/'.$org->id)}}" style="text-align:end; margin-bottom:5px;" class="btn btn-primary">Edit Page</a><br>
                            <form method="GET" action="{{url('osaemp/organization_list/organization_page/'.$org->id)}}">
                            <button class="btn btn-create" style="padding-bottom:10px; margin-bottom: 5px;">View Organization Page</button>
                            </form>
                            
                            @endif


                            @if($org->requirement_status != 'complete')
                            <form method="GET" action="{{url('/osaemp/organization_list/pending_edit/'.$org->id)}}">
                            <button class="btn btn-warning" style="padding-bottom:10px; margin-bottom: 5px;">Edit</button>
                            </form>
                            <form method="POST" action="{{url('/osaemp/organization_list/delete/'.$org->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"class= "btn btn-danger"style="padding-bottom:10px;">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    
    
<div class="container-tbl-up" style="padding: 0px 100px;">
        
        
<table class="table"> <br>
    
    
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
                                <a href="{{url('/osaemp/organization_list/organization_page/'.$orgAcads->id)}}" style="text-decoration: none; display: block;">
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
                            <a href="{{url('/osaemp/organization_list/organization_page/'.$orgCoAcad->id)}}" style="text-decoration: none; display: block;">
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
                            <a href="{{url('/osaemp/organization_list/organization_page/'.$orgSocioCivic->id)}}" style="text-decoration: none; display: block;">
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
                            <a href="{{url('/osaemp/organization_list/organization_page/'.$orgRel->id)}}" style="text-decoration: none; display: block;">
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

  
</main>
  


@endsection