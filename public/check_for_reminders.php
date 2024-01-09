<?php
require_once('functions.php');

// this file will be run by a cron job every day, to check if there are any deadlines within the next 14 days

// get all deadlines within the next 14 days
$date_14_days = date('Y-m-d', strtotime('+14 days'));

// the date we're checking for is 14 days from now
echo "Checking for deadlines that occur on this date 14 days from now: " . $date_14_days . "\n";

$deadlines = get_deadlines_by_date($date_14_days);


//if there are no deadlines, just echo a message
if (empty($deadlines)) {
    echo "No deadlines within the next 14 days";
} else {
    // if there are deadlines, loop through them and echo a message for each one
    foreach ($deadlines as $deadline) {
        echo "Deadline " .$deadline['deadline_name'] ."  for " . $deadline['crop'] . " in " . $deadline['state'] . " is " . $deadline['deadline'] . "\n";
        // get all users subscribed to this deadline with the get_users_by_deadline function
        $users = get_users_for_deadline($deadline);
        //print_r($users);

        // echo a message for each user
        foreach ($users as $user) {
            echo "Sending reminder to USER ID: " . $user['user_id'] . "\n";
            // send an email to each user
            //send_reminder_email($user, $deadline);
        }

    }
}