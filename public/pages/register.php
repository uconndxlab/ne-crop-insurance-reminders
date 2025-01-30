<?php

require_once 'functions.php';

?>
<div class="page page-profile">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <header class="page-header">
                            <h2>Register</h2>
                        </header>
                        <form action="/post/register" method="post">
                            <div class="mb-3">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname">
                            </div>
                            <div class="mb-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirm">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirm" id="password_confirm">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" style="width:100%">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>