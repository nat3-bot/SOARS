@extends('navbar.navbar_student')
@section('content')

</head>
<body>
<main style="overflow-x: hidden;">
    @foreach($announce as $announcement)
        <div class="announcement" style="margin: 8% 5% 5% 5%;">
            <div class="announcement-header">
                <h3 class="announcement-title">
                    <i class="fa-regular fa-clipboard"></i> Title: {{ $announcement->title }}
                </h3>
                <p class="announcement-date">Posted on {{ $announcement->created_at }}</p>
                <p class="author">Author: {{ $announcement->author }}. {{ $announcement->author_org }}</p>
            </div>
            <div class="announcement-body">
                {{ $announcement->message }}
            </div>
        </div>
    @endforeach
</main>

 
 </body>
 </html>
 
@endsection
