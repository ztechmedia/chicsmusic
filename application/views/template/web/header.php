<?php $url = current_url(); ?>

<!-- Start Header Area -->
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h"><img height="65px" src="<?=base_url("assets/joli/img/logo.png")?>"
                        alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item <?php if(strpos($url, base_url('home')) === 0) echo "active"; ?>"><a class="nav-link" href="<?=base_url("home")?>">Beranda</a></li>
                        <li class="nav-item submenu dropdown <?php if(strpos($url, base_url('products')) === 0) echo "active"; ?>">
                            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Produk</a>

                            <ul class="dropdown-menu">
                                <li class="nav-item <?php if(strpos($url, base_url('products')) === 0) echo "active"; ?>"><a class="nav-link"
                                        href="<?=base_url("products?page=1&limit=12&sort=min")?>">Kategori Produk</a></li>
                                <li class="nav-item <?php if(strpos($url, base_url('products/brands')) === 0) echo "active"; ?>"><a class="nav-link" href="<?=base_url("products-brand")?>">Brand
                                        (Merek)</a></li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Akun</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="<?=base_url("login")?>">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?=base_url("register")?>">Daftar</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?=base_url("contacts")?>">Kontak</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
                    </ul>
                    <div class="count-cart"></div>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- End Header Area -->