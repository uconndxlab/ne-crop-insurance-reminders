<div class="page page-home">
    <header class="page-header">
        <h2>My Profile</h2>
    </header>
    <div class="page-content">
        <section class="page-section section-crops">
            <h2>All Crops</h2>
            <ul>
                <!-- get all crops from the database -->
                <?php
                $crops = get_all_crops();
                foreach ($crops as $crop) {

                    echo '<li>
                    <a href="/crops/delete">[ x ]</a> '
                    . $crop['crop'] . 
                    '</li>';
                }
                ?>
            </ul>

            <form action="/crops" method="post">
                <label for="crop">Add a Crop</label>
                <input type="text" name="crop" id="crop">
                <button type="submit">Add Crop</button>
            </form>

        </section>

        <section class="page-section section-states">
            <h2>All States</h2>
            <ul>
                <!-- get all states from the database -->
                <?php
                $states = get_all_states();
                foreach ($states as $state) {
                    echo '<li>' 
                    . '<a href="/states/delete">[ x ]</a> '
                    . $state['state'] . '</li>';
                }
                ?>
            </ul>
        </section>

        <section class="page-section section-deadlines">
            <!-- per state, per crop, show all deadlines -->
            <h2>All Deadlines</h2>
            <table>
                <tr>
                    <th>State</th>
                    <th>Crop</th>
                    <th>Deadline Name</th>
                    <th>Deadline Date</th>
                </tr>
                <!-- get all deadlines from the database. this is a table like state,crop,deadline_name,deadline_date -->
                <?php
                $deadlines = get_all_deadlines();
                // render the <table>
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
        </section>

        <section class="page-section section-manage-deadlines">
            <!-- per state, per crop, add a named deadline and associated date -->
            <h2>Manage Deadlines</h2>
            <form action="/deadlines" method="post">
                <label for="state">State</label>
                <select name="state" id="state">
                    <?php
                    $states = get_all_states();
                    foreach ($states as $state) {
                        echo '<option value="' . $state['id'] . '">' . $state['state'] . '</option>';
                    }
                    ?>
                </select>
                <label for="crop">Crop</label>
                <select name="crop" id="crop">
                    <?php
                    $crops = get_all_crops();
                    foreach ($crops as $crop) {
                        echo '<option value="' . $crop['id'] . '">' . $crop['crop'] . '</option>';
                    }
                    ?>
                </select>
                <label for="deadline-name">Deadline Name</label>
                <input type="text" name="deadline-name" id="deadline-name">
                <label for="deadline-date">Deadline Date</label>
                <input type="date" name="deadline-date" id="deadline-date">
                <button type="submit">Add Deadline</button>
            </form>
        </section>
    </div>
</div>