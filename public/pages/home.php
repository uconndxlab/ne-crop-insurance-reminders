<div class="page page-home container">
    <header class="page-header">
        <h2>My Profile</h2>
    </header>
    <div class="page-content">
        <section class="page-section section-crops">
            <h3>All Crops</h3>

                <!-- get all crops from the database -->
                <?php
                $crops = get_all_crops();
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Crop</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($crops as $crop) : ?>
                            <tr>
                                <td><?php echo $crop['crop']; ?></td>
                                <td>

                                    <a class="btn btn-danger" href="/crops/delete/<?php echo $crop['id']; ?>">delete</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            <form action="/crops" method="post">
                <label for="crop">Add a Crop</label>
                <input type="text" name="crop" id="crop">
                <button type="submit">Add Crop</button>
            </form>

        </section>

        <section class="page-section section-states">
            <h3>All States</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>State</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- get all states from the database -->
                    <?php
                    $states = get_all_states();
                    foreach ($states as $state) {
                        echo '<tr>';
                        echo '<td>' . $state['state'] . '</td>';
                        echo '<td><a href="/states/delete">[ x ]</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="page-section section-deadlines">
            <!-- per state, per crop, show all deadlines -->
            <h3>All Deadlines</h3>
            <table class="table">
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
            <h3>Manage Deadlines</h3>
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