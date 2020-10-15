<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1>Produk Chic's Musik</h1>
				<nav class="d-flex align-items-center">
					<a href="<?=base_url('home')?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
					<a href="#">Produk<span class="lnr lnr-arrow-right"></span></a>
				</nav>
			</div>
		</div>
	</div>
</section>

<!-- End Banner Area -->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-md-5">
			<div class="sidebar-categories">
				<div class="head">Kategori</div>
				<ul class="main-categories">
					<li class="main-nav-list"><a class="<?=$data['categories'] === "all" ? "active-sub" : null?>" onclick="searchEngine(null, 'all')" data-toggle="collapse" href="#categories" aria-expanded="true"
							aria-controls="categories"><span class="lnr lnr-arrow-right"></span>Semua Kategori</a>
					</li>
					<?php foreach ($categories as $cat) { ?>
					<li class="main-nav-list"><a data-toggle="collapse" id="<?=$cat['id']?>" href="#categories" aria-expanded="true"
							aria-controls="categories"><span class="lnr lnr-arrow-right"></span><?=$cat['name']?><span class="number">(<?=count($cat['subcategories'])?>)</span></a>
						<ul class="collapse" id="categories" data-toggle="collapse" aria-expanded="false"
							aria-controls="categories">
							<?php foreach($cat["subcategories"] as $sub) {?>
								<li class="main-nav-list child"><a class="<?=$data['subcategories'] === $sub["sub_id"] ? "active-sub" : null?>" href="javascript:(0)" onclick="searchEngine(null, '<?=$sub['sub_id']?>')"><?=$sub['sub_name']?><span class="number">(<?= $sub['total_product'] !== NULL ? $sub['total_product'] : 0 ?>)</span></a></li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="sidebar-filter mt-50">
				<div class="top-filter-head">Filter Produk</div>
				<div class="common-filter">
					<div class="head">Cari Produk</div>
                    <div class="col-md-12 form-group p_star">
                        <input type="text" class="form-control" id="search-product" value="<?=$data["search"]?>" onchange="searchEngine()" placeholder="Nama Produk">
                    </div>
				</div>

				<div class="common-filter">
					<div class="head">Merk</div>
					<form>
						<ul>
							<fieldset>
								<li class="filter-list">
									<input value="" <?=$data["brand"] === "" || !isset($data['brand']) ? "checked" : null?> class="pixel-radio" type="radio" name="brand" onchange="search(null)">
										<label for="radio">
										Semua Merek
									</label>
								</li>
								<?php $num = 1; foreach($brands as $brand){ ?>
									<li class="filter-list">
										<input value="<?=$brand->brand?>" <?=$data["brand"] === $brand->brand ? "checked" : null?> class="pixel-radio" type="radio" name="brand" onchange="search(null)">
											<label for="radio">
												<?=$brand->brand?><span>(<?=$brand->total_product?>)</span>
										</label>
									</li>
								<?php } ?>
							</fieldset>
						</ul>
					</form>
				</div>
				<div class="common-filter">
					<div class="head">Harga</div>
                    <div class="col-md-12 form-group p_star">
                        <input type="number" class="form-control" id="min" value="<?=$data["min"]?>" onchange="searchEngine()" placeholder="Harga Minimal">
                    </div>
                    <div class="col-md-12 form-group p_star">
                        <input type="number" class="form-control" value="<?=$data["max"]?>" id="max" onchange="searchEngine()" placeholder="Harga Maximal">
                    </div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 col-md-7">
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting">
					<select id="sort" onchange="searchEngine()">
						<option <?=$data["sort"] === "min" ? "selected" : null?> value="min">Harga Termurah</option>
						<option <?=$data["sort"] === "max" ? "selected" : null?> value="max">Harga Termahal</option>
						<option <?=$data["sort"] === "latest" ? "selected" : null?> value="latest">Produk Terbaru</option>
						<option <?=$data["sort"] === "oldest" ? "selected" : null?> value="oldest">Produk Terlama</option>
					</select>
				</div>
				<div class="sorting mr-auto">
					<select id="limit" onchange="searchEngine()">
						<option <?=$data["limit"] === "12" ? "selected" : null?> value="12">Tampilkan 12</option>
						<option <?=$data["limit"] === "24" ? "selected" : null?> value="24">Tampilkan 24</option>
						<option <?=$data["limit"] === "48" ? "selected" : null?> value="48">Tampilkan 48</option>
					</select>
				</div>

				<div class="pagination">
					<?php if(array_key_exists("prev", $data["pagination"])) {?>
						<a onclick="searchEngine('<?=$data['pagination']['prev']['page']?>')" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<?php } else{ ?>
						<a class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<?php } ?>

					<p class="active-custom"><?="Halaman {$data['page']} - {$data['totalPage']} Data {$data['start']} - {$data['end']} "?></p>
					
					<?php if(array_key_exists("next", $data["pagination"])) {  ?>
						<a onclick="searchEngine('<?=$data['pagination']['next']['page']?>')" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					<?php } else{ ?>
						<a class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					<?php } ?>
				</div>

			</div>
			<!-- End Filter Bar -->

			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					<?php if(count($data["products"]) > 0){ ?>
						<?php foreach ($data["products"] as $product) { 
							$covers = unserialize($product->cover); ?>
						<!-- single product -->
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<a href="<?=base_url("products/$product->id/detail")?>">
									<img class="img-fluid img-product" src="<?=base_url("assets/images/products/$covers[0]")?>" alt="">
								</a>
								<div class="product-details">
									<a href="<?=base_url("products/$product->id/detail")?>">
										<h6><?=$product->name?></h6>
									</a>
									<div class="price">
										<h6><?=toRp($product->price)?></h6>
									</div>
									<div class="prd-bottom">
										<a href="" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">Add To Bag</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">View More</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php } }else { ?>
							<div class="empty-product">
								<h3>Tidak ada produk dalam filter ini</h3>
							</div>
						<?php } ?>
				</div>
			</section>
			<!-- End Best Seller -->

		</div>
	</div>
</div>

<script>
	function searchEngine(page = null, subcategories = null) {
		const limit = $("#limit").val();
		const sort = $("#sort").val();
		const min = $("#min").val();
		const max = $("#max").val();
		const brand = $("input[name=brand]:checked").val();
		const search = $("#search-product").val();
		
		const newPage = page !== null ? page : <?=$data["page"]?>;
		const newSubcategories = subcategories !== null ? subcategories : '<?=$data["subcategories"]?>';

		let url = `<?=base_url()?>products?page=${newPage}&limit=${limit}&sort=${sort}`

		if(search !== "") {
			url = `${url}&search=${search}`;
		}

		if(brand !== "") {
			url = `${url}&brand=${brand}`;
		}

		if(min > 0) {
			url = `${url}&min=${min}`;
		}

		if(max > 0) {
			url = `${url}&max=${max}`;
		}

		if(min > 0 && max > 0 && min > max) {
			alert("Harga minimal harus lebih besar dari haraga maksimal");
			return;
		}

		if(subcategories && subcategories !== "all") {
			url = `${url}&subcategories=${newSubcategories}`;
		}

		window.location = url;
	}

	function toggleCategories() {
		const categoriesId = '<?=$data['categories']?>';
		if(categoriesId !== "all") {
			const categories = document.getElementById(categoriesId);
			setTimeout(() => {
				categories.click();
			}, 100)
		}
	}

	toggleCategories();
</script>


<style>
	.empty-product {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;	
		height: 500px;
		width: 100%;
	}

	.empty-product h3 {
		color: #f5a601;
	}
</style>