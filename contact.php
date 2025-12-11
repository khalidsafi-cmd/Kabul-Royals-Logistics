<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>KRL Logistic Services</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Include Header -->
    <?php include 'components/header.php'; ?>


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Contact</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <div class="bg-primary text-dark text-center p-4">
                        <h4 class="m-0"><i class="fa fa-map-marker-alt text-white mr-2"></i>Kabul, Afghanistan</h4>
                    </div>
                    <iframe style="width: 100%; height: 520px;"
                        src="https://www.google.com/maps?q=34.497646,69.147439&z=17&output=embed"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">Contact Us</h6>
                    <h1 class="mb-4">Contact For Any Queries</h1>
                    <div class="contact-form bg-secondary" style="padding: 30px;">
                        <div id="success"></div>
                        <?php if(isset($_GET['sent']) && $_GET['sent'] == 1): ?>
                        <script>
                            alert('Your email has been sent!');
                        </script>
                        <?php endif; ?>

                        <form name="sentMessage" id="contactForm" novalidate="novalidate" action="send-email.php" method="POST">
    <div class="control-group">
        <input type="text" class="form-control border-0 p-4" 
            id="name" name="name" placeholder="Your Name"
            required="required" 
            data-validation-required-message="Please enter your name" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="email" class="form-control border-0 p-4" 
            id="email" name="email" placeholder="Your Email"
            required="required" 
            data-validation-required-message="Please enter your email" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control border-0 p-4" 
            id="subject" name="subject" placeholder="Subject"
            required="required" 
            data-validation-required-message="Please enter a subject" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <textarea class="form-control border-0 py-3 px-4" 
            rows="3" id="message" name="message" placeholder="Message"
            required="required"
            data-validation-required-message="Please enter your message"></textarea>
        <p class="help-block text-danger"></p>
    </div>
    <div>
        <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">
            Send Message
        </button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Include Footer -->
    <?php include 'components/footer.php'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- Other JS libraries -->
<script src="js/main.js"></script>

<script>
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        const form = document.getElementById('contactForm');
        if (form) form.reset();
    }
});
</script>
</body>


</html>