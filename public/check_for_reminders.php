<?php
require_once('functions.php');


// this file will be run by a cron job every day, to check if there are any deadlines within the next 14 days

// get all deadlines within the next 14 days
$date_14_days = date('Y-m-d', strtotime('+29 days'));

// the date we're checking for is 14 days from now
echo "Checking for deadlines that occur on this date 30 days from now: " . $date_14_days . "\n";

$deadlines = get_deadlines_by_date($date_14_days);


//if there are no deadlines, just echo a message
if (empty($deadlines)) {
    echo "No deadlines within the next 30 days";
} else {
    // if there are deadlines, loop through them and echo a message for each one
    foreach ($deadlines as $deadline) {
        echo "\n\n Deadline " . $deadline['deadline_name'] . "  for " . $deadline['crop'] . " in " . $deadline['state'] . " is " . $deadline['deadline'] . "\n";
        // get all users subscribed to this deadline with the get_users_by_deadline function
        $users = get_users_for_deadline($deadline);

        // if there are no users then echo a message and quit
        if (empty($users)) {
            echo "No users subscribed to this deadline";
            continue;
        } else {
            echo "Users subscribed to this deadline: \n";

            // echo a message for each user
            foreach ($users as $user) {
                $user = get_user($user['user_id']);
                echo "Sending reminder to USER ID: " . $user['id'] . "\n";
                echo "Email: " . $user['email'] . "\n";
                // send an email to each user
                send_reminder_email($user, $deadline);
                if ($user['allow_sms'] == 1) {
                    // send an sms to each user
                    //send_reminder_sms($user, $deadline);
                }
            }
        }
    }
}
