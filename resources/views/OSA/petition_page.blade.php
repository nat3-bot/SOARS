@extends('navbar.navbar_osa')
@section('content')
</head>
<body>
<main>
    <a href="/student" class="btn btn-primary" style="margin: 6% 0 10px 1%;">Go Back </a>
    <div class="card" style=" text-align:start;">
        <h5 class="card-header">Organization Petition Information </h5>
        <div class="card-body">
          <h5 class="card-title">Name: {{$petition->name}} ({{$petition->nickname}}) </h5>
          <p class="card-text"><strong>Type:</strong> {{$petition->type_of_organization}}</p>
          <p class="card-text"><strong>Course Based:</strong> {{$petition->academic_course_based}}</p>
          <p class="card-text"><strong>Adviser:</strong> {{$petition->adviser_name}}</p>
          <p class="card-text"><strong>Adviser Email:</strong> {{$petition->adviser_email}}</p>
          <p class="card-text"><strong>President:</strong> {{$petition->president_name}}</p>
          

          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-primary" onclick="showConsti()">Constitution and By Laws</button>
            <button type="button" class="btn btn-outline-primary" onclick="showLOI()">Letter of Intent</button>
            <button type="button" class="btn btn-outline-primary" onclick="showAE()">Admin Endorsement</button>
            <button type="button" class="btn btn-outline-primary" onclick="showSignees()">Signees</button>
          </div>
          <div id="consti" style="display:none;">
            @if ($petition->consti_and_byLaws)
            <h5 class="card-title" style="margin-top:1%;">Constitution and Bylaws</h5>
                <iframe src="{{ asset('petitions/' . $petition->consti_and_byLaws) }}" width="100%" height="600px" style="border: none;"></iframe>
            @endif
          </div>

          <div id="loi" style="display:none;">
            @if ($petition->letter_of_intent)
            <h5 class="card-title" style="margin-top:1%;">Letter of Intent</h5>
                <iframe src="{{ asset('petitions/' . $petition->letter_of_intent) }}" width="100%" height="600px" style="border: none;"></iframe>
            @endif
          </div>

          <div id="ae" style="display:none;">
            @if ($petition->admin_endorsement)
            <h5 class="card-title" style="margin-top:1%;">Admin Endorsement</h5>
                <iframe src="{{ asset('petitions/' . $petition->admin_endorsement) }}" width="100%" height="600px" style="border: none;"></iframe>
            @endif
          </div>

          <div id="signee" style="display:none;">
            @if ($petition->signees)
            <h5 class="card-title" style="margin-top:1%;">Signees</h5>
                <iframe src="{{ asset('petitions/' . $petition->signees) }}" width="100%" height="600px" style="border: none;"></iframe>
            @endif
          </div>

        </div>
      </div>
</main>
</body>

<script>
    function showConsti(){
        document.getElementById('consti').style.display = 'block';
        document.getElementById('loi').style.display = 'none';
        document.getElementById('ae').style.display = 'none';
        document.getElementById('signee').style.display = 'none';
    }

    function showLOI(){
        document.getElementById('consti').style.display = 'none';
        document.getElementById('loi').style.display = 'block';
        document.getElementById('ae').style.display = 'none';
        document.getElementById('signee').style.display = 'none';
    }

    function showAE(){
        document.getElementById('consti').style.display = 'none';
        document.getElementById('loi').style.display = 'none';
        document.getElementById('ae').style.display = 'block';
        document.getElementById('signee').style.display = 'none';
    }

    function showSignees(){
        document.getElementById('consti').style.display = 'none';
        document.getElementById('loi').style.display = 'none';
        document.getElementById('ae').style.display = 'none';
        document.getElementById('signee').style.display = 'block';
    }

</script>
@endsection
