<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('admin/beranda') || request()->is('admin/beranda/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master</h4>
                </li>
                @if(permission([1,2,3,5]))
                <li class="nav-item {{ request()->is('admin/master/gudang') || request()->is('admin/master/gudang/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.gudang.index') }}">
                        <i class="fas fa-warehouse"></i>
                        <p>Master Gudang</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/master/supplier') || request()->is('admin/master/supplier/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.supplier.index') }}">
                        <i class="fas fa-truck"></i>
                        <p>Master Supplier</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>