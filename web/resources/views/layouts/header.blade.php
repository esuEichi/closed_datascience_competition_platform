    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="/users/{{Auth::user()->name}}/">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
                <a href="{{route('competitions')}}">Competitions</a>
                <a href="{{route('users')}}">Users</a>

        </div>
    @endif
