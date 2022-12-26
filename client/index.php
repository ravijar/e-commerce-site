<?php
include('../client/inc/header.php');

?>
<div>
  <section class="hero-section text-center">
    <div class="bkg"></div>
    <div class="container h-100 d-flex w-25">
      <div class="pt-5 mt-5">
        <h1 class="fs-1 text-primary py-4 fw-bold">Welcome to Kade.lk</h1>
        <p class="lead text-light">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores quas laborum a quam consequatur quisquam tenetur iusto esse dolores laudantium.</p>
        <a class="btn btn-lg btn-outline-success fw-bold mt-2" href="#productSection"> Start Shopping</a>
      </div>
    </div>
  </section>
</div>

<div class="container pb-5 mb-5" id="productSection">
  <div class="text-primary h1 fw-bold text-start py-4">Our Products</div>




  <?php

  get_products();
  get_unique_category();


  ?>
</div>
</div>




</div>
<footer class="bg-dark text-center text-light position-relative">
      <div class="p-4">
        <div class="d-flex justify-content-around">
          <div class="">
            <h5 class="text-uppercase text-start mb-3">About</h5>

            <p class="text-start">Lorem ipsum dolor sit amet consectetur</p>
          </div>
          <div class="text-start">
            <h5 class="text-uppercase text-start mb-3">Contact Us</h5>
            <div class="mb-1">
              Address: 57, 21 John Rodrigo Mawatha, Moratuwa 10400
            </div>
            <div>Tele: 091-112-5623</div>
          </div>
        </div>
      </div>
      <div
        class="text-center p-3 text-secondary"
        style="background-color: rgba(0, 0, 0, 0.3)"
      >
        Copyright &copy; 2022 My Shop
      </div>
    </footer>
</body>

</html>