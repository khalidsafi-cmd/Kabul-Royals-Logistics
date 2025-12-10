<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>KRL Logistic Services - Careers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
            <h1 class="text-white display-3">Careers</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Careers</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Careers Section Start -->
    <div class="container-fluid pt-5 pb-5">
        <div class="container">
            <div class="text-center pb-4">
                <h6 class="text-primary text-uppercase font-weight-bold">Join Our Team</h6>
                <h1 class="mb-4">Current Job Openings</h1>
                <p class="text-muted w-75 mx-auto">
                    At Kabul Royals Logistics, we are committed to building a high-performing workforce.
                    Explore open positions and become part of a company that values professionalism, growth, 
                    and operational excellence.
                </p>
            </div>

            <div class="row">

                <!-- ======== BACKEND LOGIC (UNCHANGED) ======== -->
                <?php
                require 'config/db.php';

                try {
                    $stmt = $pdo->query("SELECT * FROM careers");
                    $careers = $stmt->fetchAll();

                    if (count($careers) > 0):
                        foreach ($careers as $job): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-body p-4">
                                        <h4 class="font-weight-bold mb-3"><?= htmlspecialchars($job['title']) ?></h4>

                                        <p class="text-muted">
                                            <?= nl2br(htmlspecialchars($job['description'])) ?>
                                        </p>

                                        <p class="mb-3">
                                            <strong>Requirements:</strong><br>
                                            <span class="text-dark">
                                                <?= nl2br(htmlspecialchars($job['requirements'])) ?>
                                            </span>
                                        </p>

                                        <a class="btn btn-primary px-4" href="apply.php?job_id=<?= $job['id'] ?>">
                                            Apply Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <div class="col-12 text-center">
                            <p class="text-muted">There are no job openings at the moment. Please check back soon.</p>
                        </div>
                    <?php endif;
                } catch (PDOException $e) {
                    echo "<div class='col-12 text-center text-danger'>Unable to load job listings. Please try again later.</div>";
                }
                ?>
                <!-- ======== BACKEND LOGIC END ======== -->

            </div>
        </div>
    </div>
    <!-- Careers Section End -->

    <!-- Include Footer -->
    <?php include 'components/footer.php'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>