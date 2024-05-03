<?php

require_once 'functions.php';

?>
<div class="page page-profile container">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Login</h5>
                    <div class="card-body">
                        <form action="/post/login" method="post">
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input class="form-control" type="email" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>