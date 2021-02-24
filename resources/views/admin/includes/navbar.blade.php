<header class="main-header">
    <a href="{{url('admin/dashboard')}}" class="logo"><b>Nitya SMS</b></a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">
                        <i class="fa fa-user"><span> Hello {{Auth::user()->name}}</span></i>
                    </a>
                </li>
                <li>
                  <a href="{{url('/')}}">
                    <i class="fa fa-dashboard"></i> <span>View Website</span>
                  </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>                
            </ul>
        </div>
    </nav>
</header>