<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">Roles and Permission</li>
            <li>
                <a href="{{route('view-roles')}}">
                    <i class="fa fa-dashboard"></i> <span>Roles/Permissions</span>
                </a>
            </li> 

            <li class="header">User Management </li>
            <li>
                <a href="{{route('view-users')}}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li class="header">Payment Management</li>

            <li>
                <a href="{{route('view-default-rate')}}">
                    <i class="fa fa-money"></i> <span>Default Rate per sms</span>
                </a>
            </li>
            <li>
                <a href="{{route('view-payments-status')}}">
                    <i class="fa fa-money"></i> <span>Payment Status</span>
                </a>
            </li>
            <li>
                <a href="{{route('view-payment-types')}}">
                    <i class="fa fa-money"></i> <span>Payment Type</span>
                </a>
            </li>

            <li>
                <a href="{{route('view-payments')}}">
                    <i class="fa fa-money"></i> <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="{{route('payment-report')}}"><i class="fa fa-file"></i><span>Payment Report </span></a>
            </li>
            <li>
                <a href="{{route('balance-report')}}"><i class="fa fa-file"></i><span>Balance Report </span></a>
            </li>
            <li class="header">Token Management</li>

            <li>
                <a href="{{route('view-tokens')}}">
                    <i class="fa fa-key"></i> <span>Token</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
