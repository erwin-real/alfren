<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'active-item' : '' }}" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('stocks') || request()->is('stocks/*') || request()->is('guides/stocks') ? 'active-item' : '' }}" href="/stocks">
            <i class="fas fa-fw fa-list"></i>
            <span>Inventory</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('products') || request()->is('products/*') || request()->is('guides/products') ? 'active-item' : '' }}" href="/products">
            <i class="fas fa-fw fa-cube"></i>
            <span>Bill Of Materials</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('orders') || request()->is('orders/*') || request()->is('guides/orders') ? 'active-item' : '' }}" href="/orders">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('capacities') || request()->is('capacities/*') || request()->is('guides/capacities') ? 'active-item' : '' }}" href="/capacities">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>Daily Capacities</span>
        </a>
    </li>
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link {{ request()->is('safety_stocks') ? 'active-item' : '' }}" href="/safety_stocks">--}}
            {{--<i class="fas fa-fw fa-exclamation-triangle"></i>--}}
            {{--<span>Safety Stocks</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    <li class="nav-item mt-auto">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i><span> {{ __('Logout') }}</span>
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</ul>