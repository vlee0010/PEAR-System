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
        <h2 class="text-on-back" style="font-size:50px;padding:2rem 0 0 2rem;">Peer Review Task's Available</h2>
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


                    <?php foreach ($id_list as $id) : ?>
                        <tr>
                        <?php foreach ($peer_query as $peer_review) : ?>
                            <?php if($peer_review->id==$id): ?>
                                <td> <?=$peer_review->title?></td>
                                <td><?='unknown';?></td>
                                <td> Semester Unknown</td>
                                <td> <?=$peer_review->date_end->i18nFormat('dd-MM-YYYY HH:mm:ss')?></td>
                                <td> <?='status'?></td>
                            <?php endif;?>
                        <?php endforeach;?>

                        </tr>
                    <?php endforeach;?>




<!--
            </tbody>
        </table>

    </div>

</div>
