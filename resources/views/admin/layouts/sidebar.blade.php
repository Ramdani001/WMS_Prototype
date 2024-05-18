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
                    <h4 class="text-section">Master Data</h4>
                </li>
                @if(permission([1,2,3,5]))
                <li class="nav-item {{ request()->is('admin/master/gudang') || request()->is('admin/master/gudang/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.gudang.index') }}">
                        <i class="fas fa-warehouse"></i>
                        <p>Gudang</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/master/supplier') || request()->is('admin/master/supplier/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.supplier.index') }}">
                        <i class="fas fa-truck"></i>
                        <p>Supplier</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/master/barang') || request()->is('admin/master/barang/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.barang.index') }}">
                        <i class="fas fa-box"></i>
                        <p>Barang</p>
                    </a>
                </li>
                @endif
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Transaksi</h4>
                </li>
                @if(permission([1,2,3,5]))
                
                <li class="nav-item {{ request()->is('admin/transaksi/purchasing') || request()->is('admin/transaksi/purchasing/*') ? 'active' : 'Tidak' }}">
                    <a href="{{ route('admin.master.purchasing.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Purchasing Order</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/transaksi/pengiriman') || request()->is('admin/transaksi/pengiriman/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.supplier.index') }}">
                        <i class="fas fa-truck"></i>
                        <p>Pengiriman</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/transaksi/report') || request()->is('admin/transaksi/report/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.master.barang.index') }}">
                        <i class="fas fa-clipboard"></i>
                        <p>Report</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>