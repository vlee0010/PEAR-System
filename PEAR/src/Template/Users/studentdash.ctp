<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<style>
    .incomplete-link{
        /*color:red;*/
    }
</style>
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
                                    echo '<a href="#" disabled class="btn btn-neutral">Complete&nbsp;&nbsp;&nbsp;</a>';
                                } elseif ($item->status == 0 && $item->peerReviewStatus == 1) {
                                    echo "<a class='btn btn-warning' href=".$this->Html->Url->build(['controller' => 'questions','action' => 'index', $team->teamID,$item->peer_id]).">Incomplete</a>";
                                } elseif ($item->status == 0 && $item->peerReviewStatus == 0){
                                    echo '<a href="#" disabled class="btn btn-neutral">Not Published&nbsp;&nbsp;&nbsp;</a>';
                                }

                                ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>


                </tr>
            <?php endforeach; ?>


<script>
    let incompleteLinks = document.querySelectorAll(('.incomplete_link'));
    console.log(incompleteLinks);
    </script>
