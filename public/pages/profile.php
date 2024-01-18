<?php

require_once 'functions.php';
$states = get_all_states();
$crops = get_all_crops();

?>
<div class="page page-profile container">
    <header class="page-header">
        <h2>My User Profile</h2>
    </header>
    <div class="row mt-3">
        <div class="col-md-6">
            <h3>Basic Information</h3>
            <form action="/post/profile/save" method="post">
                <div class="mb-3">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['firstname']; ?>">
                </div>
                <div class="mb-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['lastname']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>">
                </div>

                <div class="mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $_SESSION['phone']; ?>">
                </div>

                <!-- allow text updates -->
                <div class="mb-3">
                    <label for="text_updates">Text Updates</label>
                    <select name="text_updates" id="text_updates">
                        <option value="1" <?php if ($_SESSION['text_updates'] == 1) : ?>selected<?php endif; ?>>Yes</option>
                        <option value="0" <?php if ($_SESSION['text_updates'] == 0) : ?>selected<?php endif; ?>>No</option>
                    </select>
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
            <h3>My Products</h3>
            <!-- card for subscribing to a reminder: select a state, select a crop -->
            <div class="card">
                <h5 class="card-header">Add a Product</h5>
                <div class="card-body">
                    <form action="/post/user_crop/save" method="post">
                        <div class="mb-3">
                            <label for="state">State</label>
                            <select name="state_id" id="state">
                                <?php foreach ($states as $state) : ?>
                                    <option value="<?php echo $state['id']; ?>"><?php echo $state['state']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="crop">Product</label>
                            <select name="crop_id" id="crop">
                                <?php foreach ($crops as $crop) : ?>
                                    <option value="<?php echo $crop['id']; ?>"><?php echo $crop['crop']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>State</th>
                    <th>Product</th>
                    <th>Remove</th>
                </tr>
                <?php
                $user_crops = get_crops_by_user_id($_SESSION['user_id']);
                foreach ($user_crops as $user_crop) {
                    $state_name = get_state_name($user_crop['state_id']);
                    $crop_name = get_crop_name($user_crop['crop_id']);

                    // as a table row
                    echo '<tr>';
                    echo '<td>' . $state_name . '</td>';
                    echo '<td>' . $crop_name . '</td>';
                    echo '<td><form action="/post/user_crop/delete" method="post"><input type="hidden" name="user_crop_id" value="' . $user_crop['id'] . '"><button type="submit" class="btn btn-danger">Remove</button></form></td>';
                    echo '</tr>';
                }
                ?>
            </table>




            <h3 class="mt-5">My Deadlines</h3>
            <h4> Showing only deadlines in the future. </h4>

            <!-- table of subscribed reminders -->
            <table class="table">
                <tr>
                    <th>State</th>
                    <th>Product</th>
                    <th>Deadline Name</th>
                    <th>Deadline Date</th>
                </tr>
                <?php
                $deadlines = get_deadlines_by_user_id($_SESSION['user_id']);
                foreach ($deadlines as $deadline) {
                    echo '<tr>';
                    echo '<td>' . $deadline['state'] . '</td>';
                    echo '<td>' . $deadline['crop'] . '</td>';
                    echo '<td>' . $deadline['deadline_name'] . '</td>';
                    echo '<td>' . $deadline['deadline'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>

            <?php if (count($deadlines) == 0) : ?>
                <div class="alert alert-info" role="alert">
                    You have no deadlines. Subscribe to a product above to get started.
                </div>
            <?php endif; ?>

            <!-- <h3>My Reminders</h3>

            <table class="table">
                <tr>
                    <th>State</th>
                    <th>Product</th>
                    <th>Deadline Name</th>
                    <th>Reminder Date</th>
                    <th>Remove</th>
                </tr>
                <?php
                // $reminders = get_reminders_by_user_id($_SESSION['user_id']);
                // foreach ($reminders as $reminder) {
                //     echo '<tr>';
                //     echo '<td>' . $reminder['state'] . '</td>';
                //     echo '<td>' . $reminder['crop'] . '</td>';
                //     echo '<td>' . $reminder['deadline_name'] . '</td>';
                //     echo '<td>' . $reminder['reminder_send_time'] . '</td>';
                //     echo '<td><form action="/post/reminder/delete" method="post"><input type="hidden" name="reminder_id" value="' . $reminder['id'] . '"><button type="submit" class="btn btn-danger">Remove</button></form></td>';
                //     echo '</tr>';
                // }
                ?>

            </table> -->
            <div class="policy-documents">
                <h3 class="mt-5">Policy Documents</h3>
                <ul>
                    <?php
                    // Specify the path to your PDF documents
                    $pdfDirectory = 'policy_documents/';

                    // Get all PDF files from the directory
                    $pdfFiles = glob($pdfDirectory . '*.pdf');

                    // Generate links for each PDF file without the ".pdf" extension
                    foreach ($pdfFiles as $pdfFile) {
                        $pdfFileName = basename($pdfFile, '.pdf');
                        echo '<li><a href="' . $pdfDirectory . $pdfFile . '" target="_blank">' . $pdfFileName . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>

</div>
</div>

</div>