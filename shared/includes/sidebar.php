<!-- The sidebar/menu component which is only visible on sreen sizes below 1150px -->
<div class="sidebar transition">
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