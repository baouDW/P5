

<style type="text/css">
body
    {
      background-color: #5c3c3c;
    }
  
</style>

<?php ob_start(); ?>
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Les dernières penssées
      </h1>

      <ol class="breadcrumb">
        Les dernières penssées
      </ol>
      

      <?php

      while ($data = $posts->fetch())
      {
      ?> 
      <!-- Blog Post -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <a href="#">
                <img class="img-fluid rounded img-post" src="view/frontend/images/book.jpg" alt="">
              </a>
            </div>
            <div class="col-lg-6">
              <h2 ><?= $data['title'] ?></h2>
              <p ><?= substr($data['content'], 0, 100); ?></p>
              <a href="index.php?id=<?= $data['id'] ?>&action=comm" >Lire la suite &rarr;</a>
            </div>
          </div>
        </div>
        <div class="card-footer text-muted">
         Poster le <?= $data['creation_date_fr'] ?> par
          <a href="#"><?= $data['author'] ?></a>
        </div>
      </div>
      <?php
      }
      $posts->closeCursor();
      ?>

      
      

      <!-- Pagination -->
      <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
          <a class="page-link" href="#">&larr; Precedent</a>
        </li>
        <li class="page-item disabled">
          <a class="page-link" href="#">Suivant &rarr;</a>
        </li>
      </ul>
    </div>
  <!-- /.container -->

  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<?php $content = ob_get_clean(); ?>
<?php require('templateFront.html'); ?>

