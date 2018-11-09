<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ url('/') }}">Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          @foreach($categories as $category)
            <a class="dropdown-item" href="{{ url('/') }}/category/{{ $category->id }}">{{ $category->title }}</a>
          @endforeach
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}/sale">Sale</a>
      </li>
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <li class="nav-item">
          @if (Route::has('register'))
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          @endif
        </li>
      @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if(Auth::user()->isAdmin())
              <a class="dropdown-item" href="{{ url('/') }}/admin">Admin Panel</a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <a class="dropdown-item" id="cart" href="{{ url('/') }}/cart">
              @if(!$cart<=0)
                Cart: {{ $cart }}
              @else
                No products in cart
              @endif
            </a>
          </div>
        </li>
      @endguest
    </ul>
    <form method="get" action="{{ url('/') }}/search" class="form-inline my-2 my-lg-0">
      {{ csrf_field() }}
      <input class="form-control mr-sm-2" type="text" name="search" id="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
