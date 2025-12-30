<!-- 🌟 SIDEBAR -->
<div id="sidebar" class="sidebar collapsed">
    <a href="{{route('dashboard')}}" class="@if(request()->is('dashboard')) active @endif"><i class="bi bi-speedometer2"></i> <span class="text">Dashboard</span></a>
    
    @if(Auth::user()->role === 'admin')
    <a href="{{route('admin.users.index')}}" class="@if(request()->is('admin/users*')) active @endif"><i class="bi bi-people"></i> <span class="text">Users</span></a>
    <a href="{{route('admin.broadcast.create')}}" class="@if(request()->is('admin/broadcast*')) active @endif"><i class="bi bi-megaphone"></i> <span class="text">Broadcast Class</span></a>
    <a href="{{route('admin.plans.index')}}" class="@if(request()->is('admin/plans*')) active @endif"><i class="bi bi-bag"></i> <span class="text">Plans</span></a>
    @else
    <a href="{{route('admin.users.profile', ['uuid' => Auth::user()->uuid])}}" class="@if(request()->is('users/'.Auth::user()->uuid)) active @endif"><i class="bi bi-person"></i> <span class="text">Profile</span></a>
    <a href="{{route('form.yoga')}}" class="@if(request()->is('yoga')) active @endif"><i class="bi bi-person-walking"></i> <span class="text">Yoga Form</span></a>
    <a href="{{route('form.diet')}}" class="@if(request()->is('diet')) active @endif"><i class="bi bi-egg-fried"></i> <span class="text">Diet Form</span></a>
    @endif
    {{-- <a href="#"><i class="bi bi-receipt"></i> <span class="text">Orders</span></a>
    <a href="#"><i class="bi bi-bar-chart"></i> <span class="text">Reports</span></a>
    <a href="#"><i class="bi bi-chat-dots"></i> <span class="text">Leads</span></a>
    <a href="#"><i class="bi bi-gear"></i> <span class="text">Settings</span></a>
    <a href="#"><i class="bi bi-box-arrow-right"></i> <span class="text">Logout</span></a> --}}
</div>