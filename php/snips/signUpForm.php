<form method="POST" id="newUserForm" name="newUserForm" action="php/pscript/processNewUserRequest.php">
    <div class="modal-body">                   
        <div class="form-group">
            <label for="fName">First Name</label><span data-name="First Name" class="notice"></span>
            <input type="text" class="form-control" name="fName" id="fName" min-length="2" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <label for="lName">Last Name</label><span data-name="Last Name" class="notice"></span>
            <input type="text" class="form-control" name="lName" id="lName" min-length="2" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <label for="coName">Company Name</label><span data-name="Company Name" class="notice"></span>
            <input type="text" class="form-control" name="coName" id="coName" placeholder="Company Name">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label><span data-name="Email" class="notice" id="emailMsg"></span>
            <input type="email" class="form-control"  name="inputEmail" id="inputEmail" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="confirmEmail">Confirm Email</label><span data-name="Confirm Email" class="notice"></span>
            <input type="email" class="form-control" name="confirmEmail" id="confirmEmail" placeholder="Confirm Email">
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label><span data-name="Password" class="notice"></span>
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" min-length="6"
                   pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="verifyPassword">Verify Password</label><span data-name="Verify Passwrd" class="notice"></span>
            <input type="password" class="form-control" name="verifyPassword" id="verifyPassword" 
                   pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" placeholder="Verify Password">
        </div>                 
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" id="caxBut" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create Account</button>
    </div>
</form>