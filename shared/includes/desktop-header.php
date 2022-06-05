<!-- Header for Desktop view only above 1150px -->
<div class="header transition">
    <div class="header-left">
        <img src="./media/images/teyake_white_fill.png" class="logo" />
        <nav>
            <ul class="primary-nav flex">
                <li><a href="../index.php">Home</a></li>
                <li class="nav-active"><a href="./support.php">How it Works</a></li>
                <li><a href="./about_us.php">About Us</a></li>

            </ul>
        </nav>
    </div>
    <div class="header-right flex items-center justify-between">
        <div class="sign-in flex flex-col items-center justify-center gap-1">
            <div class="flex gap-4">
                <a href="./signin.php"><button type="button">Sign In</button></a>
                <a href="./signup.php"><button type="button">Sign Up</button></a>
            </div>
            <p class="text-center">Teachers</p>
        </div>
        <!-- Exam Key input Section -->
        <div class="flex flex-col items-center gap-2">
            <form action="#" class="enter-exam-head flex text-center">
                <div class="enter-exam-input">
                    <input type="text" name="exam-key" id="exam-key" placeholder="Enter Exam Key" />
                    <button type="submit" class="btn enter-exam-btn enter-exam-head-btn">
                        Next
                    </button>
                </div>
            </form>
            <label for="exam-key" class="enter-exam-label text-center">Students enter your exam key
                above</label>
        </div>
        <!-- End of exam key input section -->
    </div>
</div>
<!-- End of Desktop Header -->