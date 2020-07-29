<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('companies.index') }}" class="nav-link">{{ __('Companies') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('employees.index') }}" class="nav-link">{{ __('Employees') }}</a>
    </li>
  </ul>

  <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" role="button"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            {{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
</nav>
<!-- /.navbar -->