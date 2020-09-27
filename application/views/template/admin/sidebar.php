<li class="xn-title">Navigation</li>

<li class="dashboard">
    <a class="side-menu" data-url="<?=base_url("dashboard")?>" data-menu=".dashboard"><span
            class="fa fa-desktop"></span> <span class="xn-text">Beranda</span></a>
</li>

<li class="users">
    <a class="side-menu" data-url="<?=base_url("users")?>" data-menu=".users"><span
            class="fa fa-users"></span> <span class="xn-text">Users</span></a>
</li>

<li class="xn-openable products-menu">
    <a><span class="fa fa-shopping-cart"></span> <span class="xn-text">Produk</span></a>
    <ul>

        <li class="categories"><a class="side-submenu" data-url="<?=base_url("categories")?>" data-menu=".products-menu"
                data-submenu=".categories"><span class="fa fa-filter"></span> Kategori Produk</a></li>

        <li class="products"><a class="side-submenu" data-url="<?=base_url("products-grid")?>" data-menu=".products-menu"
                data-submenu=".products"><span class="fa fa-shopping-cart"></span> Produk</a></li>

    </ul>
</li>

<li class="xn-openable settings">
    <a><span class="fa fa-gear"></span> <span class="xn-text">Pengaturan</span></a>
    <ul>

        <li class="roles"><a class="side-submenu" data-url="<?=base_url("roles")?>" data-menu=".settings"
                data-submenu=".roles"><span class="fa fa-lock"></span> Roles</a></li>

    </ul>
</li>