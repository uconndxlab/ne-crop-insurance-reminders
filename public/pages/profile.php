<?php

require_once 'functions.php';
$states=get_all_states();
$crops=get_all_crops();

?>
<div class="page page-profile container">
    <header class="page-header">
        <h2>My Profile</h2>
    </header>
    <div class="row mt-3">
        <div class="col-md-6">
            <h3>Basic Information</h3>
            <form action="/post/profile" method="post">
                <div class="mb-3">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['user']['firstname']; ?>">
                </div>
                <div class="mb-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['user']['lastname']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>">
                </div>

                <div class="mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $_SESSION['user']['phone']; ?>">
                </div>




                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <div class="col-md-6">
            <h3>Change Password</h3>
            <form action="/post/password" method="post">
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <!-- confirm password -->
                <div class="mb-3">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" name="password_confirm" id="password_confirm">
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>

        <div class="col-md-10 mt-5">
            <h3>My Crops</h3>
            <!-- card for subscribing to a reminder: select a state, select a crop -->
            <div class="card">
                <h5 class="card-header">Subscribe to a Reminder</h5>
                <div class="card-body">
                    <form action="/post/subscribe" method="post">
                        <div class="mb-3">
                            <label for="state">State</label>
                            <select name="state" id="state">
                                <?php foreach ($states as $state) : ?>
                                    <option value="<?php echo $state['id']; ?>"><?php echo $state['state']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="crop">Crop</label>
                            <select name="crop" id="crop">
                                <?php foreach ($crops as $crop) : ?>
                                    <option value="<?php echo $crop['id']; ?>"><?php echo $crop['crop']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>

            <h4 class="mt-5">My Reminders</h4>

            <!-- table of subscribed reminders -->
            <table class="table">
                <tr>
                    <th>State</th>
                    <th>Crop</th>
                    <th>Deadline Name</th>
                    <th>Deadline Date</th>
                    <th>Actions</th>
                </tr>
                <?php
                $deadlines = get_all_deadlines($_SESSION['user_id']);
                foreach ($deadlines as $deadline) {
                    echo '<tr>';
                    echo '<td>' . $deadline['state'] . '</td>';
                    echo '<td>' . $deadline['crop'] . '</td>';
                    echo '<td>' . $deadline['deadline_name'] . '</td>';
                    echo '<td>' . $deadline['deadline'] . '</td>';
                    echo '<td><a href="/post/unsubscribe/' . $deadline['id'] . '" class="btn btn-danger">Unsubscribe</a></td>';
                    echo '</tr>';
                }
                ?>
            </table>



        </div>
    </div>
</div>

</div>
</div>

</div>