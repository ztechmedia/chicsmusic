<li class="xn-title">Navigation</li>
<li class="dashboard">
    <a class="side-menu" data-url="<?=base_url("dashboard")?>" data-menu=".dashboard"><span
            class="fa fa-desktop"></span> <span class="xn-text">Beranda</span></a>
</li>

<li class="xn-openable master">
    <a><span class="fa fa-hdd-o"></span> <span class="xn-text">Master</span></a>
    <ul>
        <li class="users"><a class="side-submenu" data-url="<?=base_url("users")?>" data-menu=".master"
                data-submenu=".users"><span class="fa fa-users"></span> Users</a></li>
        <li class="categories"><a class="side-submenu" data-url="<?=base_url("categories")?>" data-menu=".master"
                data-submenu=".categories"><span class="fa fa-filter"></span> Kategori Produk</a></li>
        <li class="products"><a class="side-submenu" data-url="<?=base_url("products")?>" data-menu=".master"
                data-submenu=".products"><span class="fa fa-shopping-cart"></span> Produk</a></li>
        <li class="roles"><a class="side-submenu" data-url="<?=base_url("roles")?>" data-menu=".master"
                data-submenu=".roles"><span class="fa fa-lock"></span> Roles</a></li>
    </ul>
</li>