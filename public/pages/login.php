<?php

require_once 'functions.php';

?>
<div class="page page-profile container">
        <div class="row justify-content-between gx-5">
            <div class="col-lg-6 order-lg-1">
                <div class="card mb-4">
                    <!-- Don't have an account? Create an Account to set up your deadlines. -->

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



                    <!-- contact info mary.concklin@uconn.edu -->

                    <div class="card-footer">
                        <p class="mb-0">Need information or assistance? Contact Mary Concklin at <a href="mailto:mary.concklin@uconn.edu"> mary.concklin@uconn.edu</a></p>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 instructions order-lg-2">
            <div class="card-header mb-2">
                        <p class="mb-0">Don't have an account? <a href="/register">Create an Account</a> to set up your deadlines.</p>
                    </div>

                <p>The USDA RMA and FSA Program Deadlines reminder tool allows policyholders to sign up for text and email reminders for their reporting deadlines.</p>
                <ol>
                    <li>First, create an account by using the "Register" button in the top-right.</li>
                    <li>Complete your profile by entering an email address and phone number.</li>
                    <li>Once your account has been created, you can use the "Add a Product" tool to sign up for reminders.</li>
                    <ol type="a">
                        <li>Select your state.</li>
                        <li>Select your "crop" by its policy name.</li>
                        <li>That's it! As long as your email address and/or mobile phone number are set correctly, you should receive deadline reminders in advance of your policy's closing dates.</li>
                    <ol>
                </ol>
            </div>

        </div>
</div>