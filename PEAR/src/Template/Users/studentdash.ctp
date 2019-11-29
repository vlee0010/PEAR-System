<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="card shadow">
        <h2 class="text-on-front" style="font-size:50px">Available Peer Review Tasks</h2>
        <table id="myTable" class="table table-flush">
            <thead>
            <tr>
                <th>Unit</th>
                <th>Peer Review</th>
                <th>Team</th>
                <th>Semester</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($dashResult as $item) : ?>
                <tr>
                    <td><?= $item->unitCode ?></td>
                    <td><?= $item->title ?></td>
                    <?php foreach ($team_list as $team) : ?>
                        <?php if ($team->peer_id == $item->peer_id) : ?>
                            <td><?= $team->teamName ?></td>
                            <td align="center"><?= $item->unitSemester ?></td>
                            <td><?= date("d-M-Y", strtotime($item->dateStart)) ?></td>
                            <td><?= date("d-M-Y", strtotime($item->dateEnd)) ?></td>

                            <td><?php if ($item->status == 1) {
                                    echo 'Complete';
                                } else {
                                    echo $this->Html->link('Incomplete', ['controller' => 'questions', 'class' => 'incomplete_link', 'action' => 'index', $team->teamID,$item->peer_id]);
                                }

                                ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>


                </tr>
            <?php endforeach; ?>



