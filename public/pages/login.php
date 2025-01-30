<?php

require_once 'functions.php';

?>
<div class="page page-profile container">
        <div class="row justify-content-between gx-5">
            <div class="col-lg-6 order-lg-1">
                <div class="card mb-4">
                    <div class="card-body py-0 px-0">
                        <h5 class="page-header">Login</h5>
                        <form action="/post/login" method="post">
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input class="form-control" type="email" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary" style="width:100%" >Login</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 instructions order-lg-2">
                <p>The USDA RMA and FSA Program Deadlines reminder tool allows policyholders to sign up for text and email reminders for their reporting deadlines.</p>
                <ol>
                    <li>First, create an account by using the "Register" button in the top-right.</li>
                    <li>Complete your profile by entering an email address and phone number.</li>
                    <li>Once your account has been created, you can use the "Add a Product" tool to sign up for reminders.</li>
                    <ol type="a">
                        <li>First, select your state (Connecticut dates are available as of 2025)</li>
                        <li>Then select your "crop" by its policy name.</li>
                        <li>That's it! As long as your email address and/or mobile phone number are set correctly, you should receive deadline reminders in advance of your policy's closing dates.</li>
                    <ol>
                </ol>
            </div>

        </div>
</div>