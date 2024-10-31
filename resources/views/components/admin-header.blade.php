<header class="dash-header">
    <a href="{{ route('dashboard')}}">
        <h1>admin dashboard</h1>
    </a>
    <div>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button>log out</button>
        </form>
    </div>
</header> 