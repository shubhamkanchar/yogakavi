<!-- 🌟 SIDEBAR -->
<div id="sidebar" class="sidebar collapsed">
    <a href="{{route('admin.dashboard')}}" class="@if(request()->is('dashboard')) active @endif"><i class="bi bi-speedometer2"></i> <span class="text">Dashboard</span></a>
    <a href="{{route('admin.users.index')}}" class="@if(request()->is('users')) active @endif"><i class="bi bi-people"></i> <span class="text">Users</span></a>
    {{-- <a href="#"><i class="bi bi-bag"></i> <span class="text">Plans</span></a>
    <a href="#"><i class="bi bi-receipt"></i> <span class="text">Orders</span></a>
    <a href="#"><i class="bi bi-bar-chart"></i> <span class="text">Reports</span></a>
    <a href="#"><i class="bi bi-chat-dots"></i> <span class="text">Leads</span></a>
    <a href="#"><i class="bi bi-gear"></i> <span class="text">Settings</span></a>
    <a href="#"><i class="bi bi-box-arrow-right"></i> <span class="text">Logout</span></a> --}}
</div>