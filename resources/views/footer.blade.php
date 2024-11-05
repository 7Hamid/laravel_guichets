<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<!-- Footer -->
<footer class="text-center text-lg-start text-white bg-black">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.4091921349022!2d-7.606483323865662!3d33.59468594175133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cd64e63c35eb%3A0x6ca781e3774b992b!2s99%20Rue%20Pierre%20Parent%2C%20Casablanca%2020110!5e0!3m2!1sfr!2sma!4v1729869902917!5m2!1sfr!2sma" width="1263" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    <!-- Copyright -->

    <!-- Section: Social media -->
    <section class="d-flex justify-content-between p-4" style="background-color: grey;">
        <!-- Left -->
        <div class="me-5">
            <strong>Contactez-nous sur les réseaux sociaux:</strong>
        </div>
        <!-- Right -->
        <div>
            <a href="" class="text-white me-4">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fa-brands fa-google"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fa-brands fa-github"></i>
            </a>
        </div>
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section>
        <div class="container text-center text-md-start mt-3">
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Company name</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p>WebAgency est une entreprise qui spécialiste dans le développement informatique, le marketing digital et le web design</p>
                </div>

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Tickets</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><a href="{{ route('tickets.filter', 'Cénima') }}" class="text-white">Cénima</a></p>
                    <p><a href="{{ route('tickets.filter', 'Formations') }}" class="text-white">Formations</a></p>
                    <p><a href="{{ route('tickets.filter', 'Vente_Flash') }}" class="text-white">Vente Flash</a></p>
                    <p><a href="{{ route('tickets.filter', 'Sport') }}" class="text-white">Sports</a></p>
                </div>

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Links</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><a href="#!" class="text-white">Account</a></p>
                    <p><a href="#!" class="text-white">À propos</a></p>
                    <p><a href="https://maps.app.goo.gl/bSpr8JpCV5PbAeAu6" target="blank" class="text-white">Localisation</a></p>
                    <p><a href="#!" class="text-white">Help</a></p>
                </div>

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">Contact</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><i class="fas fa-home mr-3"></i> webagency, 99 rue parent</p>
                    <p><i class="fas fa-envelope mr-3"></i> chetouani.hamid@gmail.com</p>
                    <p><i class="fas fa-phone mr-3"></i> +212 709 573 577</p>
                    <p><i class="fas fa-print mr-3"></i> +212 680 108 248</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Links  -->
    <div class="text-center p-3" style="background-color: rgba(255, 255, 255, 0.1);">
        © <?php echo date('d/m/Y'); ?> Copyright:
        <a class="text-white" href="https://www.webagency.com">webagency</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- End of Footer -->
