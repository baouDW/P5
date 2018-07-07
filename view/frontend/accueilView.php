<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Carousel with Tabbed Navigation</title>
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
body
    {
      background-color: #5c3c3c;
    }
.carousel {
  margin: 30px 0;
    background: #ccc;
}
.carousel .item {
    text-align: center;
  overflow: hidden;
    height: 475px;
}
.carousel .item img {
  max-width: 100%;
    margin: 0 auto; /* Align slide image horizontally center in Bootstrap v3 */
}
.carousel .carousel-control {
  width: 50px;
    height: 50px;
    background: #000;
    margin: auto 0;
  opacity: 0.8;
}
.carousel .carousel-control:hover {
  opacity: 0.9;
}
.carousel .carousel-control i {
    font-size: 41px;
  margin-top: 3px;
}
.carousel-caption h3, .carousel-caption p {
  color: #fff;
  display: inline-block;
  font-family: 'Oswald', sans-serif;
  text-shadow: none;
  margin-bottom: 20px;
}
.carousel-caption h3 {
  background: rgba(0,0,0,0.9);
  padding: 12px 24px;
  font-size: 40px;  
  text-transform: uppercase;
}
.carousel-caption p {
  background: #20b0b9;
  padding: 10px 20px;
  font-size: 20px;
  font-weight: 300;
}
.carousel-indicators li, .carousel-indicators li.active {
  margin-left: 4px;
  margin-right: 4px;
}
.carousel-indicators li.active {
  background: #20b0b9;
  border-color: #20b0b9;
}
.carousel .nav {  
  background: #eee;
}
.carousel .nav a {
  color: #333;
  border-radius: 0;
  font-size: 85%;
  padding: 10px 16px;
  background: transparent;
}
.carousel .nav .nav-item.active a {
  color: #fff;
  background: #20b0b9;
}
.carousel .nav strong {
  display: block;
  font-family: 'Roboto', sans-serif;
  font-size: 110%;
  text-transform: uppercase;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
    // Highlight bottom nav links
    var clickEvent = false;
    $("#myCarousel").on("click", ".nav a", function(){
      clickEvent = true;
      $(this).parent().siblings().removeClass("active");
      $(this).parent().addClass("active");    
    }).on("slid.bs.carousel", function(e){
      if(!clickEvent){
        itemIndex = $(e.relatedTarget).index();
        targetNavItem = $(".nav li[data-slide-to='" + itemIndex + "']");
        $(".nav li").not(targetNavItem).removeClass("active");
        targetNavItem.addClass("active");
      }
      clickEvent = false;
    });
  });
</script>
</head>
<?php ob_start(); ?>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
           
          <div class="item carousel-item active">
            <img src="/examples/images/slides/tablet.jpg" alt="">
            <div class="carousel-caption">
              <h3>Live Monitoring Tools</h3>              
              <p>Nullam hendrerit justo non leo aliquet imperdiet. Etiam sagittis lectus condime dapibus vitae.</p>
            </div>
          </div>
          <div class="item carousel-item">
            <img src="/examples/images/slides/workstation.jpg" alt="">
            <div class="carousel-caption">
            <?php
            while ($data = $theme->fetch())
            {
            ?>      
              <h3>Theme du jour</h3>
              <p><?= nl2br($data['content']) ?></p>
            <?php
            }
            ?>
            </div>
          </div>
          <div class="item carousel-item">
            <img src="/examples/images/slides/report.jpg" alt="">
            <div class="carousel-caption">
              <h3>Award Winning Support</h3>
              <p>Nullam hendrerit justo non leo aliquet imperdiet. Etiam in sagittis lectus ultrices placerat.</p>
            </div>
          </div>
        </div>
        <!-- End Carousel Inner -->
        <ul class="nav nav-pills nav-justified">
          <li data-target="#myCarousel" data-slide-to="1" class="nav-item"><a href="#" class="nav-link"><strong>Derniere pensée</strong> </a></li>
          <li data-target="#myCarousel" data-slide-to="2" class="nav-item"><a href="#" class="nav-link"><strong>Theme du jour</strong> </a></li>
          <li data-target="#myCarousel" data-slide-to="3" class="nav-item"><a href="#" class="nav-link"><strong>Video du jour</strong> </a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php require('templateFront.html'); ?>
</html>