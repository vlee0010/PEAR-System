<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="container">
    <div class="card shadow">
        <h2 class="text-on-front" style="font-size:50px">Available Peer Review Tasks</h2>
        <table class="table table-flush">
            <thead>
            <tr>
                <th>Unit</th>
                <th>Team</th>
                <th>Semester</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
<!--                --><?php //foreach($peerReviewMatches as $peerReviewMatch) :?>


                    <?php foreach ($team_peer_id_list as $team_peer_id) : ?>
                        <tr>
                            <?php $unit_id=0;
                            $due_date=null;
                            $peer_id=0;
                            ?>
                        <?php foreach ($team_peer_id as $key=>$value) : ?>
                            <?php foreach ($peer_query as $peer) : ?>
                                <?php if ($peer->id==$value) : ?>
                                    <td><?=$peer->title?></td>
                                    <?php $unit_id = $peer->unit_id;
                                    $due_date=$peer->date_end;
                                    $peer_id=$peer->id;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach;?>
                            <?php foreach ($teams_query as $team) : ?>
                                <?php if ($team->id_==$key) : ?>
                                    <td><?=$team->name?></td>
                                <?php endif; ?>
                            <?php endforeach;?>
                            <?php foreach ($units_query as $unit) : ?>
                                <?php if ($unit->id==$unit_id) : ?>
                                    <td><?=$unit->semester?></td>
                                <?php endif; ?>
                            <?php endforeach;?>
                            <td><?=$due_date?> </td>
                            <?php foreach ($peer_review_user_query as $peer_review_user) : ?>
                                <?php if ($peer_review_user->user_id==$studentid and $peer_review_user->peer_review_id ==$peer_id) : ?>
                                    <td><?=$peer_review_user->status?></td>
                                <?php endif; ?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>




<!--
            </tbody>
        </table>

    </div>

</div>
