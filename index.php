<?php
    require_once(__DIR__ . '/includes/header.php');
?>
 <!-- Page Header-->
 <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Zita Nguyen</h1>
                    <span class="subheading">Mon Premier Blog</span>
                </div>
            </div>
        </div>
    </div>
</header>
        <!-- Main Content-->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Last post -->
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h1>Mon Dernier Article</h1>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.html">
                            <p>Post title</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">Start Bootstrap</a>
                            on September 24, 2023
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                </div>
                <!-- About me -->
                <div class="col-md-10 col-lg-8 col-xl-7 my-5" id="about-me">
                    <h1>A propos</h1>
                    <div class="d-flex gap-5 my-5">
                        <img src="assets/img/about-bg.jpg" class="d-none d-lg-block" alt="About Zita">
                        <p>Zita est une fullstack développeuse Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                </div>
                <!-- Contact Form -->
                <div class="col-md-10 col-lg-8 col-xl-7" id="contact-form">
                    <h1>Contactez-moi</h1>
                    <p>Envie d'échanger une idée? Envoyez-moi un message.</p>
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <div class="form-floating">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Votre nom</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">Votre nom est obligatoire.</div>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                                <label for="email">Votre email</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">Votre email est obligatoire.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email entrée n'est pas valid.</div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">Votre message est obligatoire.</div>
                            </div>
                            <br />
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage"><div class="text-center mb-3">Votre message est envoyé!</div></div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error de l'envoi votre message!</div></div>
                            <!-- Submit Button-->
                            <div class="text-center"><button class="btn btn-dark text-uppercase disabled" id="submitButton" type="submit">Envoyer</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    require_once(__DIR__ . ('/includes/footer.php'));
?>