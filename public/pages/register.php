<?php 

require_once 'functions.php';

?>
<div class="page page-profile container">
    <header class="page-header">
        <h2>Register</h2>
    </header>
    <div class="row">
        <div class="col-md-6">
            <form action="/post/register" method="post">
                <div class="mb-3">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname">
                </div>
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <!-- confirm password -->
                <div class="mb-3">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" name="password_confirm" id="password_confirm">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

</div>
</div>

</div>