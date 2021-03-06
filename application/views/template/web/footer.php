 <!-- start footer Area -->
 <footer class="footer-area section_gap">
     <div class="container">
         <div class="row">
             <div class="col-lg-3  col-md-6 col-sm-6">
                 <div class="single-footer-widget">
                     <h6>Tentang Chic's Music</h6>
                     <p>
                         Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                         Reiciendis sit alias amet ipsam quod est aspernatur cupiditate 
                         commodi ratione odit cum provident numquam a dicta, incidunt, 
                         quam nostrum, corrupti totam.
                     </p>
                 </div>
             </div>
             
             <div class="col-lg-2 col-md-6 col-sm-6">
                 <div class="single-footer-widget">
                     <h6>Ikuti kami:</h6>
                     <div class="footer-social d-flex align-items-center">
                         <a href="#"><i class="fa fa-facebook"></i></a>
                         <a href="#"><i class="fa fa-twitter"></i></a>
                         <a href="#"><i class="fa fa-instagram"></i></a>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
             <p class="footer-text m-0">
                 <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 Copyright &copy; 2020 Chic's Music</a>
                 <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
             </p>
         </div>
     </div>
 </footer>
 <!-- End footer Area -->

 <script src="<?=base_url("assets/karma/js/jquery-2.2.4.min.js")?>"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
     integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
 </script>
 <script src="<?=base_url("assets/karma/js/bootstrap.min.js")?>"></script>
 <script src="<?=base_url("assets/karma/js/jquery.ajaxchimp.min.js")?>"></script>
 <script src="<?=base_url("assets/karma/js/jquery.nice-select.min.js")?>"></script>
 <script src="<?=base_url("assets/karma/js/jquery.sticky.js")?>"></script>
 <script src="<?=base_url("assets/karma/js/nouislider.min.js")?>"></script>
 <script src="<?=base_url("assets/karma/js/jquery.magnific-popup.min.js")?>"></script>
 <script src="<?=base_url("assets/karma/js/owl.carousel.min.js")?>"></script>
 <!--gmaps Js-->
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
 <script src="<?=base_url("assets/karma/js/main.js")?>"></script>
 <script src="<?=base_url("assets/custom/js/ajax/ajaxRequest.js")?>"></script>
 <script src="<?=base_url("assets/custom/js/loader/viewLoader.js")?>"></script>
 <script src="<?=base_url("assets/sweetalert/sweetalert.min.js")?>"></script>

 <script>
     function checkCart() {
         loadContent("<?=base_url("checkcart")?>", ".count-cart");
     }

     checkCart();

     function addCart(productId, name, price, stock) {
        if(parseInt(1) > parseInt(stock)) {
            alert("Stock tidak cukup");
            return
        }

        const url = "<?=base_url("addcart")?>";

        const data = {
            product_id: productId,
            name: name,
            qty: 1,
            price: price
        }

        reqJson(url, "POST", data, (err, response) => {
            if(response.success) {
                checkCart();
            }else{
                console.log("Error: ", err);
            }
        });
     }
      
     function goTo(link) {
        window.location = link;
    }
</script>
