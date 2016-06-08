<?php
    $title="Compte <?php echo SESSION['login']; ?>";
    include("header.php");
?>
<section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Voici vos informations</h2>
                <p class="lead">Ici vous pouvez mettre ajour vos information personnel</p>
            </div>

            <div class="row">
                <div class="features">
                     <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="">
                            <i class=""></i>
                            <h2>Nom d'utilisateur</h2>
                            <h3><?php echo "SESSION['login']"; ?></h3>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="">
                            <i class=""></i>
                            <h2>Votre Email</h2>
                            <h3><?php echo "SESSION['email']"; ?></h3>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="">
                            <i class=""></i>
                            <h2>Votre statut</h2>
                            <h3><?php echo "SESSION['statut']"; ?></h3>
                        </div>
                    </div><!--/.col-md-4-->
                </div>
            </div>
        </div>
    </section><!--/#feature-->

    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Voici vos cours</h2>
                <p class="lead">A partir d'ici vous pouvez visualiser mais aussi modifier vos cours</p>
            </div>

            <div class="row">
                <div class="features">
                    
                </div>
            </div>
        </div>
    </section><!--/#feature-->
    
<?php
    include("footer.php");
?>
