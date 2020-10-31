<li class="xn-title">Navigation</li>

<li class="dashboard">
    <a class="side-menu" data-url="<?=base_url("admin/dashboard")?>" data-menu=".dashboard"><span
            class="fa fa-desktop"></span> <span class="xn-text">Beranda</span></a>
</li>

<li class="users">
    <a class="side-menu" data-url="<?=base_url("admin/users")?>" data-menu=".users"><span
            class="fa fa-users"></span> <span class="xn-text">Users</span></a>
</li>

<li class="xn-openable products-menu">
    <a><span class="fa fa-shopping-cart"></span> <span class="xn-text">Produk</span></a>
    <ul>

        <li class="categories"><a class="side-submenu" data-url="<?=base_url("admin/categories")?>" data-menu=".products-menu"
                data-submenu=".categories"><span class="fa fa-filter"></span> Kategori Produk</a></li>

        <li class="products"><a class="side-submenu" data-url="<?=base_url("admin/products-grid")?>" data-menu=".products-menu"
                data-submenu=".products"><span class="fa fa-shopping-cart"></span> Produk</a></li>

    </ul>
</li>

<li class="xn-openable stores-menu">
    <a><span class="fa fa-music"></span> <span class="xn-text">Manajemen Toko</span></a>
    <ul>

        <li class="banners"><a class="side-submenu" data-url="<?=base_url("admin/banners")?>" data-menu=".stores-menu"
                data-submenu=".banners"><span class="fa fa-toggle-right"></span> Banner Produk</a></li>

        <li class="shop-categories"><a class="side-submenu" data-url="<?=base_url("admin/shop-categories")?>" data-menu=".stores-menu"
                data-submenu=".shop-categories"><span class="fa fa-filter"></span> Kategori Produk</a></li>

        <li class="bank"><a class="side-submenu" data-url="<?=base_url("admin/banks")?>" data-menu=".stores-menu"
                data-submenu=".bank"><span class="fa fa-money"></span> Rekening Bank</a></li>

        <li class="store-address"><a class="side-submenu" data-url="<?=base_url("admin/store-address")?>" data-menu=".stores-menu"
                data-submenu=".store-address"><span class="fa fa-shopping-cart"></span> Alamat Toko</a></li>

        <li class="brands"><a class="side-submenu" data-url="<?=base_url("admin/brands")?>" data-menu=".stores-menu"
                data-submenu=".brands"><span class="fa fa-flag-o"></span> Daftar Merek</a></li>

    </ul>
</li>

<li class="orders">
    <a class="side-menu" data-url="<?=base_url("admin/orders")?>" data-menu=".orders"><span
            class="fa fa-money"></span> <span class="xn-text">Pemesanan</span></a>
</li>

<li class="xn-openable settings">
    <a><span class="fa fa-gear"></span> <span class="xn-text">Pengaturan</span></a>
    <ul>

        <li class="roles"><a class="side-submenu" data-url="<?=base_url("admin/roles")?>" data-menu=".settings"
                data-submenu=".roles"><span class="fa fa-lock"></span> Roles</a></li>

    </ul>
</li>