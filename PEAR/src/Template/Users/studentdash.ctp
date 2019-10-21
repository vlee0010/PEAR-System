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
                <th>Title</th>
                <th>Team</th>
                <th>Semester</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>

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
                                    $date_start = $peer->date_start;
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
                            <td><?=$date_start->i18nFormat('dd-MMM-yyyy')?> </td>
                            <td><?=$due_date->i18nFormat('dd-MMM-yyyy')?> </td>

                            <?php foreach ($peer_review_user_query as $peer_review_user) : ?>
                                <?php if ($peer_review_user->user_id==$studentid and $peer_review_user->peer_review_id ==$peer_id) : ?>
                                    <td><?php if($peer_review_user->status){
                                            echo 'Complete';
                                        }else{
                                            echo $this->Html->link('Incomplete',['controller'=>'questions','class'=>'incomplete_link','action'=>'index',$peer_id]);
                                        }

                                        ?></td>
                                <?php endif; ?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>



