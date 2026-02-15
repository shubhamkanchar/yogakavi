<!-- 🌟 SIDEBAR -->
<div id="sidebar" class="sidebar collapsed">
    <a href="{{route('dashboard')}}" class="@if(request()->routeIs('dashboard')) active @endif"><i class="bi bi-speedometer2"></i> <span class="text">Dashboard</span></a>
    
    @if(Auth::user()->role === 'admin')
    <a href="{{route('admin.users.index')}}" class="@if(request()->routeIs('admin.users.*')) active @endif"><i class="bi bi-people"></i> <span class="text">Users</span></a>
    <!-- <a href="{{route('admin.broadcast.create')}}" class="@if(request()->routeIs('admin.broadcast.*')) active @endif"><i class="bi bi-megaphone"></i> <span class="text">Broadcast Class</span></a> -->
    <a href="{{route('admin.plans.index')}}" class="@if(request()->routeIs('admin.plans.*')) active @endif"><i class="bi bi-bag"></i> <span class="text">Plans</span></a>
    <a href="{{route('admin.blogs.index')}}" class="@if(request()->routeIs('admin.blogs.*')) active @endif"><i class="bi bi-journal-text"></i> <span class="text">Blogs</span></a>
    <a href="{{route('admin.live_classes.index')}}" class="@if(request()->routeIs('admin.live_classes.*')) active @endif"><i class="bi bi-camera-video"></i> <span class="text">Live Classes</span></a>
    <a href="{{route('admin.subscriptions.index')}}" class="@if(request()->routeIs('admin.subscriptions.*')) active @endif"><i class="bi bi-credit-card"></i> <span class="text">Subscriptions</span></a>
    <a href="{{route('admin.gallery.index')}}" class="@if(request()->routeIs('admin.gallery.*')) active @endif"><i class="bi bi-images"></i> <span class="text">Gallery</span></a>
    @else
    <a href="{{route('admin.users.profile', ['uuid' => Auth::user()->uuid])}}" class="@if(request()->routeIs('admin.users.profile')) active @endif"><i class="bi bi-person"></i> <span class="text">Profile</span></a>
    <a href="{{route('form.yoga')}}" class="@if(request()->routeIs('form.yoga')) active @endif"><i class="bi bi-person-walking"></i> <span class="text">Yoga Form</span></a>
    <a href="{{route('form.diet')}}" class="@if(request()->routeIs('form.diet')) active @endif"><i class="bi bi-egg-fried"></i> <span class="text">Diet Form</span></a>
    @endif
    {{-- <a href="#"><i class="bi bi-receipt"></i> <span class="text">Orders</span></a>
    <a href="#"><i class="bi bi-bar-chart"></i> <span class="text">Reports</span></a>
    <a href="#"><i class="bi bi-chat-dots"></i> <span class="text">Leads</span></a>
    <a href="#"><i class="bi bi-gear"></i> <span class="text">Settings</span></a>
    <a href="#"><i class="bi bi-box-arrow-right"></i> <span class="text">Logout</span></a> --}}
</div>