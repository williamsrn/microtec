    <form class="form-signin" method="POST" action="php/pscript/loginUser.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="userEmail" class="sr-only">Email address</label>
        <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="userPassword" class="sr-only">Password</label>
        <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Password" required="">
        <p><a href="#">Forgot your password?</a></p>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p id="sInP">New to <img id="sInLogo" src="img/logo_v6.png" alt=""/>?<a data-dismiss="modal" href="index.php?p=h1">Sign Up</a></p>
    </form>