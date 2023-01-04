<?php
include "include/header.php";
?>

    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 content">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="public/images/erenlerTeam.jpeg" class="d-block w-100" alt="erenler team">
                            </div>

                            <div class="carousel-item">
                                <img src="public/images/erenlerTeam2.jpeg" class="d-block w-100" alt="erenler team">
                            </div>

                            <div class="carousel-item">
                                <img src="public/images/erenlerTeam3.jpeg" class="d-block w-100" alt="erenler team">
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "include/footer.php";
?>