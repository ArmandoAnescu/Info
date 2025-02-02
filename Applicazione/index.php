<?php
require 'header.php';
?>
<main class="flex-shrink-0">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/img_1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Benvenuto a Library.io</h5>
        <p>La vostra libreria digitale.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/img_2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>I libri</h5>
        <p>Fonte di conoscneza e avventure.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/img_3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Esplora le nostre categorie!</h5>
        <p>Tra avventura e storie dell'orrore, dai classici alle opere mdoerne.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>    
    <div class="container mt-3 mb-5">
    <h1 class="mt-3 pt-3">Libray.io</h1>
        <br>
        <h2>Chi siamo?</h2>
            <p  class="lead">Benvenuti a Library.Io, un luogo dove potete trovare un sacco di libri di ogni genere e autore.
                Il nostro obiettivo è quello di avere un catalogo sempre più ampio e variegato, per soddisfare le esigenze di tutti
                gli utenti, dai più giovani ai più anziani. Vogliamo che tutti siano in grado di trovare il libro adatto a loro.
            <h2>Perchè?</h2>
            </p class="lead">
               Perchè vogliamo trasmettere la nostra passioni per i libri in tutto il mondo, e dato che ormai internet è dappertutto, possiamo usarlo come strumento.
            </p>
            <h2>Chi siamo?</h2>
            <p class="lead">Si, siamo un gruppo di amici che condividono lo stesso interesse di leggere. Abbiamo raccolti dati sui vari libri che ci piacciono e li abbiamo messi in un unico posto, per rendere più facile la ricerca.
                Ogni persona è libera di aggiungere o corregere i nsotri errori, vogliamo costruire una comunità in cui possiamo aprlare tutti liberamente e divertirci con la lettura.
            </p>
    </div>
</main>
<?php
require 'footer.php';
?>
