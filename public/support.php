<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>How It Works | Teyake</title>
    <link rel="stylesheet" href="css/style-reset.css" />
    <link rel="stylesheet" href="css/support.css" />
</head>

<body id="top">
    <!-- Container for the whole document, replacement for the body tag to avoid styling the tag directly -->
    <div class="container text-white">
        <?php include "../shared/includes/mobile-header.php" ?>
        <?php include "../shared/includes/desktop-header.php" ?>
        <?php include "../shared/includes/sidebar.php" ?>
        <!-- Main container -->
        <main>
            <div class="main-container flex items-center justify-center">
                <!-- <img src="../resources/images/about_us.jpg" alt="People taking exams">-->
                <h1 class="accented">How It Works</h1>
            </div>
            <!--Start of main content-->
            <h2 class="text-primary text-center how-title">Its easy to get start with <span
                    class="accented">Teyake.com</span> Here are the fewest steps to use our services</h2>
            <div class="about_us_text flex align-center justify-center flex-row">

                <div class="text-content">
                    <h2 class="text-primary">Sign Up</h2>
                    <p class="text-primary">

                        In order to create and provide exams you must sign up as a teacher using your institutional
                        email. With the correct institutional email you will be verified and be a qualified exam
                        provider. If you would like to be registered in the system click the link
                        below.

                    </p>
                    <a href="signup.php"><button class="btn try-it-btn pointer transition">Sign Up Now</button> </a>

                </div>

                <div class="img-content">
                    <img src="./media/images/how_it_works/signup.svg" alt="Sign Up">
                </div>
            </div>


            <div class="about_us_text flex align-center justify-center flex-row">
                <div class="img-content">
                    <img src="./media/images/how_it_works/create.svg" alt="Team Work">
                </div>

                <div class="text-content">
                    <h2 class="text-primary">Create Exam</h2>
                    <p class="text-primary">

                        After successfully registering, the sytem will automatically direct you to the dashboard page
                        where you can manage your exams. You can create a new exam by clicking the "New Exam" button.
                    </p>
                </div>
            </div>

            <div class="about_us_text flex align-center justify-center flex-row">
                <div class="text-content">
                    <h2 class="text-primary">Flexible Scoring</h2>
                    <p class="text-primary">

                        After grading a score you can edit the weight of each question or the total score of the exam
                        even after the exam is online and examinees has submitted with their final answers allowing a
                        flexible score.

                    </p>

                </div>

                <div class="img-content">
                    <img src="./media/images/how_it_works/manage_score.svg" alt="Sign Up">
                </div>
            </div>
            <div class="about_us_text flex align-center justify-center flex-row">
                <div class="img-content">
                    <img src="./media/images/how_it_works/stat.svg" alt="Team Work">
                </div>

                <div class="text-content">
                    <h2 class="text-primary">Real-time Statistics</h2>
                    <p class="text-primary">

                        Apart from just giving exams teachers or exam providers can see real-time statistics about the
                        exams including scores.
                    </p>
                </div>
            </div>
            <!--End of main contents-->
            <!--Buttons-->
        </main>
        <!-- End of main container -->
        <!-- Page Footer -->
        <?php include "../shared/includes/footer.php" ?>
        <!-- End of footer -->
    </div>
    <script src="../shared/core.js" type="module"></script>
    <script src="./js/support.js" type="module"></script>
</body>

</html>