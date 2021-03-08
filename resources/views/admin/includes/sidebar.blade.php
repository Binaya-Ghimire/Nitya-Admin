<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            @can('role-list')
            <li class="header">Roles and Permission</li>
            <li>
                <a href="{{route('view-roles')}}">
                    <i class="fa fa-dashboard"></i> <span>Roles/Permissions</span>
                </a>
            </li>
            @endcan
            @can('user-list')
            <li class="header">User Management </li>
            <li>
                <a href="{{route('view-users')}}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            @endcan

             @canany(['payment-type-list', 'payment-status-list', 'default-rate-list', 'payment-list', 'paymen-report', 'balance-report'])
            <li class="header">Payment Management</li>
            @endcan

            @can('default-rate-list')
            <li>
                <a href="{{route('view-default-rate')}}">
                    <i class="fa fa-money"></i> <span>Default Rate per sms</span>
                </a>
            </li>
            @endcan

            @can('payment-status-list')
            <li>
                <a href="{{route('view-payments-status')}}">
                    <i class="fa fa-money"></i> <span>Payment Status</span>
                </a>
            </li>
            @endcan

            @can('payment-type-list')
            <li>
                <a href="{{route('view-payment-types')}}">
                    <i class="fa fa-money"></i> <span>Payment Type</span>
                </a>
            </li>
            @endcan

            @can('payment-list')
            <li>
                <a href="{{route('view-payments')}}">
                    <i class="fa fa-money"></i> <span>Payments</span>
                </a>
            </li>
            @endcan

            @can('payment-report')
            <li>
                <a href="{{route('payment-report')}}"><i class="fa fa-file"></i><span>Payment Report </span></a>
            </li>
            @endcan

            @can('balance-report')
            <li>
                <a href="{{route('balance-report')}}"><i class="fa fa-file"></i><span>Balance Report </span></a>
            </li>
            @endcan

            @can('token-list')
            <li class="header">Token Management</li>

            <li>
                <a href="{{route('view-tokens')}}">
                    <i class="fa fa-key"></i> <span>Token</span>
                </a>
            </li>
            @endcan

            <li class="header">Send Message</li>
            <li>
                <a href="{{route('create.sms')}}">
                    <i class="fa fa-key"></i> <span>Send Message</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
