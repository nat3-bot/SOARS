@extends('navbar.admin_nav')

@section('content')    

<!-- Your main content goes here -->
    <main >
       <div class="mt-4">
            <h3>Recently Created User Accounts</h3>
                <div class="list-group">
                @forelse ($recentUsers as $user)
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $user->name }}</h5>
                                            <small>{{ $user->created_at->format('F j, Y') }}</small>
                                        </div>
                                        <p class="mb-1">{{ $user->email }}</p>
                                        <small class="text-muted">User ID: {{ $user->id }}</small>
                                    </a>
                                @empty
                                    <div class="alert alert-info" role="alert">
                                        No recently created users found.
                                    </div>
                                @endforelse
                </div>
        </div>
       
    </main>

    <script>
        let lastScrollTop = 0;
        window.addEventListener("scroll", () => {
            let st = window.pageYOffset || document.documentElement.scrollTop;
            if (st > lastScrollTop) {
                // Scrolling down, hide the header
                document.querySelector(".scroll-header").classList.add("hidden");
            } else {
                // Scrolling up, show the header
                document.querySelector(".scroll-header").classList.remove("hidden");
            }
            lastScrollTop = st;
        });
    </script>
    

    <!-- Add Bootstrap JavaScript (optional) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
@endsection
