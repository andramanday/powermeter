<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">St</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
      @if(Auth::user()->can('manage-users'))
      <li class="menu-header">Users</li>
      <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
      @endif
      @if(Auth::user()->can('manage-companies'))
      <li class="{{ Request::route()->getName() == 'admin.companies' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.companies') }}"><i class="fa fa-building"></i> <span>Companies</span></a></li>
      @endif

      <li class="{{ Request::route()->getName() == 'admin.devices' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.devices') }}"><i class="fa fa-tablet"></i> <span>Devices</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.sensors' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.sensors') }}"><i class="fa fa-desktop"></i> <span>Sensors</span></a></li>
    </ul>
</aside>
