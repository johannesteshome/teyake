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
        <!-- The sidebar/menu component which is only visible on sreen sizes below 1150px -->
        <div class="sidebar transition">
            <form action="#" class="enter-exam-sidebar flex flex-col">
                <label for="exam-key" class="enter-exam-label font-semibold">Student</label>
                <div class="enter-exam-input">
                    <input type="text" name="exam-key" class="exam-key" id="exam-key-sidebar"
                        placeholder="Enter Exam Key" />
                    <button type="submit" class="btn enter-exam-btn" id="enter-exam-sidebar-btn">
                        Next
                    </button>
                </div>
            </form>
            <div class="sidebar-sign-in flex flex-col w-full">
                <p>Teacher</p>
                <div class="flex">
                    <a href="signin.php"><button type="button">Sign In</button></a>
                    <a href="signup.php"><button type="button">Sign Up</button></a>
                </div>
            </div>
            <div class="sidebar-links">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="./support.php">How It Works</a></li>
                    <li><a href="./about_us.php">About</a></li>


                    <li><a href="../index.php#testimonals">Testimonials</a></li>
                </ul>
            </div>
        </div>
        <!-- End of Sidebar Component -->
        <!-- Header for mobile view -->
        <?php include "../shared/includes/desktop-header.php" ?>

        <!-- The sidebar/menu component which is only visible on sreen sizes below 1150px -->
        <div class="sidebar transition">
            <div class="sidebar-head flex justify-between items-center">
                <img src="./media/images/teyake_white_fill.png" class="logo" />
                <span class="menu-close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
            <form action="#" class="enter-exam-sidebar flex flex-col">
                <label for="exam-key" class="enter-exam-label font-semibold">Student</label>
                <div class="enter-exam-input">
                    <input type="text" name="exam-key" id="exam-key" placeholder="Enter Exam Key" />
                    <button type="submit" class="btn enter-exam-btn">
                        Next
                    </button>
                </div>
            </form>
            <div class="sidebar-sign-in flex flex-col w-full">
                <p>Teacher</p>
                <div class="flex">
                    <a href="auth/signin.php"><button type="button">Sign In</button></a>
                    <a href="auth/signup.php"><button type="button">Sign Up</button></a>
                </div>
            </div>
            <div class="sidebar-links">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li class="nav-active"><a href="./support.php">How It Works</a></li>
                    <li><a href="./about_us.php">About</a></li>

                    <li><a href="../index.php#testimonals">Testimonials</a></li>
                </ul>
            </div>
        </div>
        <!-- End of Sidebar Component -->

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
                    <button class="btn try-it-btn pointer transition">Sign Up Now</button>
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
        <footer>
            <nav class="footer-nav">
                <div>
                    <a href="teyake.com" class="footer-logo"><img src="./media/images/teyake_white_fill.png"
                            class="logo" /></a>
                    <ul class="p-0">
                        <li><a href="./signin.php">Teacher Sign In</a></li>
                        <li><a href="#exam-key">Student Exam Key</a></li>
                    </ul>
                </div>

                <div class="footer-menu">
                    <h3>Menu</h3>
                    <ul class="p-0">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="./support.php">How it works</a></li>
                        <li><a href="./signup.php">Free Trial</a></li>
                        <li><a href="./about_us.php">About</a></li>

                        <li><a href="../index.php#testimonals">Testimonials</a></li>
                    </ul>
                </div>
            </nav>
            <div class="foot-section">
                <div>Copyright &copy; <span id="current-year"></span> - Teyake.com</div>
                <a href="#top" class="up-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                </a>
                </button>
            </div>
        </footer>
        <!-- End of footer -->
    </div>
    <script src="../shared/core.js"></script>
</body>

</html>