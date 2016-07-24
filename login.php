<?php

include 'header.php';

?>
<div class="row">
    <div class="container content">
        <div class="col-md-6">
            <h3>Login</h3>
            <form id="login">
                 <label>Email:</label><input type="text" name="email" id="email" class="form-control" placeholder="Enter email address.." autofocus />
                 <br>
                 <label>Password:</label><input type="password" name="password" id="password" class="form-control" placeholder="Enter password..." />
                 <br>
                 <input type="button" class="form-control btn btn-primary" id="loginSubmit" value="Login" />
                 <br>
                 <a href="forgotten">Forgotten Password?</a>
            </form>
            <br>
            <div id="ack"></div>
        </div>
        <div class="col-md-6">
           <h3>Members</h3>
            <p class="nice">Welcome to the Platinum Recruitment Specialists members area. If you are not yet a member please follow the button below to find out how you can begin to work with us.</p>
            <a href="#" class="btn btn-primary">Work With Us</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/login.js"></script>
<?php

include 'footer.php';

?>