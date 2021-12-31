
  <?php include 'header.php';?>
  <?php require 'nav.php' ?>
  
  <?php

    $sadrzajKontakta = 'Duis autem vel eum iriure dolor in hendrerit n vuew lputate velit esse molestie conseu vel illum dolore eufe ugiat nulla facilisis at vero.';
    
    $sadrzajKontakta =  $_POST['izmena'];

  ?>
  <!-- Content -->
  <div class="container container-lg" style="margin: 40px 0;">
    
    <!-- Contact Us -->
      <section class="p-t-b-150"> 
        <!-- CONTACT FORM -->
        <div class="container"> 
          <!-- Tittle -->
          <div class="heading-block">
            <h4 style="text-align:center">GET IN TOUCH</h4>
            <hr>
            <span>
              <?php
              echo $sadrzajKontakta;
              ?>
              </span> </div>
          </div>
        </div>  
          
          
          
            <div class="wrapper col2" style="margin: 10px 0;">
              <div id="breadcrumb">
                  Contact Us
              </div>
            </div>
          <div class="wrapper col4" style="margin: 10px 0;">
            <div id="container">
              <h6>Our Address</h6>
              <p>
          Online Hospital Management System , Bangalore<br />

          <strong>tel</strong>:080 65110488<br />

          <strong>Email ID</strong>: ohms@gmail.com</p>
        
      </section>
    


      <div id="map" style="height:400px; width: 100%"></div>
</div>
    </div>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=&v=weekly&channel=2"
    async
    ></script>

    <script>
      function initMap() {
        // The location of Uluru
        const uluru = { lat: -25.344, lng: 131.036 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
    </script>  
  <!-- Footer -->

  <?php include 'footer.php';?>