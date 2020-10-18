 <!-- Start Banner Area -->
 <section class="banner-area organic-breadcrumb">
     <div class="container">
         <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
             <div class="col-first">
                 <h1>Keranjang Belanja</h1>
                 <nav class="d-flex align-items-center">
                     <a href="<?=base_url()?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
                     <a href="<?=base_url("products")?>">Produk<span class="lnr lnr-arrow-right"></span></a>
                     <a href="javascript:(0)">Keranjang Belanja</a>
                 </nav>
             </div>
         </div>
     </div>
 </section>
 <!-- End Banner Area -->

 <!--================Cart Area =================-->
 <section class="cart_area">
     <div class="container">
         <div class="cart_inner">
             <div class="table-responsive">
                 <?php if(count($carts) > 0){ ?>
                 <table class="table">
                     <thead>
                         <tr>
                             <th scope="col">Produk</th>
                             <th scope="col">Harga</th>
                             <th scope="col">Kuantitas</th>
                             <th scope="col">Stock</th>
                             <th scope="col">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php $total = 0; $index = 0; 
                        foreach ($carts as $cart) { 
                            $index++; 
                            $total += $cart['subtotal']; ?>
                         <tr>
                             <td>
                                 <div class="media">
                                     <div class="d-flex">
                                         <img width="100" height="100" src="<?=base_url("assets/images/products/{$cart['cover']}")?>" alt="">
                                     </div>
                                     <div class="media-body">
                                         <p><?=$cart['name']?></p>
                                     </div>
                                 </div>
                             </td>
                             <td>
                                 <h5><?=toRp($cart['price'])?></h5>
                             </td>
                             <td>
                                 <div class="product_count">
                                     <input onchange="addQty('<?=$cart['product_id']?>', '#sst-<?=$index?>')" type="text" name="qty" id="sst-<?=$index?>" maxlength="<?=$cart['stock']?>" value="<?=$cart['qty']?>" title="Quantity:"
                                         class="input-text qty">
                                     <button
                                         onclick="var result = document.getElementById('sst-<?=$index?>'); var sst = result.value; if( !isNaN( sst ) && result.value < <?=$cart['stock']?>) result.value++;return false;"
                                         onmousedown="addQty('<?=$cart['product_id']?>', '#sst-<?=$index?>', 1)"
                                         class="increase items-count" type="button"><i
                                             class="lnr lnr-chevron-up"></i></button>
                                     <button
                                         onclick="var result = document.getElementById('sst-<?=$index?>'); var sst = result.value; if( !isNaN( sst ) && result.value > 1 ) result.value--;return false;"
                                         onmousedown="addQty('<?=$cart['product_id']?>', '#sst-<?=$index?>', -1)"
                                         class="reduced items-count" type="button"><i
                                             class="lnr lnr-chevron-down"></i></button>
                                 </div>
                             </td>
                             <td><?=$cart['stock']?></td>
                             <td>
                                 <h5 id="sub-<?=$cart['product_id']?>"><?=toRp($cart['subtotal'])?></h5>
                             </td>
                         </tr>
                        <?php } ?>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5 id="total"><?=toRp($total)?></h5>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="<?=base_url('products')?>">Lanjutkan Belanja</a>
                                    <a class="primary-btn" href="<?=base_url('checkout')?>">Pembayaran</a>
                                </div>
                            </td>
                        </tr>
                     </tbody>
                 </table>
                <?php } else { ?>
                    <p>Belum ada barang di keranjang</p>
                <?php } ?>
             </div>
         </div>
     </div>
 </section>
 <!--================End Cart Area =================-->