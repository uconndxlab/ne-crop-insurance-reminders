<?php 

require_once 'functions.php';

?>
<div class="page page-profile container">
    <header class="page-header">
        <h2>Login</h2>
    </header>
    <div class="row">
        <div class="col-md-6">
            <form action="/post/login" method="post">
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

</div>
</div>

</div>