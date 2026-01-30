<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container" id="signup" style="display: none;">
        <div class="logo">
            <h1>U</h1>
            <h2>HOSTEL</h2>
            <h3>HIMACHAL PRADESH</h3>
        </div>
            <form method="post" action="register.php">
                <div class="input-group" action="register.php">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <input type="number" min='0000' max='9999' name="StudentID" placeholder="username" required>
                </div>


                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                
                <div class="input-group">
                    <input type="text" name="hostelname" id="hostelname" placeholder="Hostel Name" required>
                </div>

                <div class="input-group">
                    <input type="number" min='0' max='5' name="floorno" id="floorno" placeholder="Floor no." required>
                </div>

                
                <div class="input-group">
                    <input type="number" name="roomno" id="roomno" placeholder="Room no." required>
                </div>
                <input type="submit" class="btn" value="SignUp" name="signUp">
            </form>
            <div class="links">
            <p>Already have an account? <a href="#" id="signInButton">Sign In</a></p>
        </div>
        </div>

        
        <div class="container" id="signIn">
        <div class="logo">
            <h1>U</h1>
            <h2>HOSTEL</h2>
            <h3>HIMACHAL PRADESH</h3>
        </div>
            <form method="post" action="register.php">
                <div class="input-group">
                    <i class="fa-solid fa-at"></i>
                    <input type="text" placeholder="Username" name="signInID" id="userID" required>
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <input type="submit" value="signIn" name="signIn" class="btn">
                <div class="recover">
                    <a href="#">Forgot your password? Click here</a>
                </div>
            </form>
            <div class="links">
            <p>Don't have an account? <a href="#" id="signUpButton">Sign Up</a></p>
        </div>
        <div class="footer">
            <p>Questions? Email us at <a href="mailto:uhostel@chitkarauniversity.edu.in">uhostel@chitkarauniversity.edu.in</a></p>
            <p class="copyright">Copyright ©️ 2025 Chitkara University</p>
        </div>
        </div>
        <script src="script.js">
        </script>
    </body>
</html>
