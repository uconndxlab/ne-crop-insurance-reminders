<div class="page page-home container-fluid">
    <header class="page-header">
        <h2>Management Dashboard</h2>
    </header>
    <div class="page-content">
        <div class="accordion" id="accordionSections">

            <div class="accordion-item">
                <h2 class="accordion-header" id="cropsHeading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cropsCollapse" aria-expanded="true" aria-controls="cropsCollapse">
                        Crops
                    </button>
                </h2>
                <div id="cropsCollapse" class="accordion-collapse collapse show" aria-labelledby="cropsHeading" data-bs-parent="#accordionSections">
                    <div class="accordion-body">
                        <?php
                        $crops = get_all_crops();
                        ?>

                        <div class="card">
                            <form action="/crops" method="post">
                                <h5 class="card-header">Add Crop</h5>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="crop">Crop</label>
                                        <input type="text" name="crop" id="crop">
                                        <button type="submit" class="btn btn-primary">Add Crop</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>

                        <table class="table">

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
                            <div class="mb-3">
                            <label for="crop">Crops</label>
                            <input type="text" name="crop" id="crop">
                            <button type="submit">Add Crop</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="statesHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#statesCollapse" aria-expanded="false" aria-controls="statesCollapse">
                        States
                    </button>
                </h2>
                <div id="statesCollapse" class="accordion-collapse collapse" aria-labelledby="statesHeading" data-bs-parent="#accordionSections">
                    <div class="accordion-body">
                        <div class="card">
                        <form action="/states" method="post">
                            <h5 class="card-header">Add State</h5>
                            <div class="card-body">
                                
                                    <div class="mb-3">
                                        <label for="state">State</label>
                                        <input type="text" name="state" id="state">
                                        <button type="submit" class="btn btn-primary">Add State</button>
                                    </div>
                                
                           
                                
                            </div>
                            </form>
                        </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>State</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
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
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="deadlinesHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#deadlinesCollapse" aria-expanded="false" aria-controls="deadlinesCollapse">
                        Deadlines
                    </button>
                </h2>
                <div id="deadlinesCollapse" class="accordion-collapse collapse" aria-labelledby="deadlinesHeading" data-bs-parent="#accordionSections">
                    <div class="accordion-body">
                        <!-- card with add deadline form -->


                        <div class="card">
                            <h5 class="card-header">Add Deadline</h5>
                            <div class="card-body">
                               
                                <form action="/deadlines" method="post">
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
                                    <div class="mb-3">
                                        <label for="deadline_name">Deadline Name</label>
                                        <input type="text" name="deadline_name" id="deadline_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="deadline">Deadline Date</label>
                                        <input type="date" name="deadline" id="deadline">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Deadline</button>
                                    
                                </form>
                            </div>
                        </div>


                        <table class="table">
                            <tr>
                                <th>State</th>
                                <th>Crop</th>
                                <th>Deadline Name</th>
                                <th>Deadline Date</th>
                            </tr>
                            <?php
                            $deadlines = get_all_deadlines();
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



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>