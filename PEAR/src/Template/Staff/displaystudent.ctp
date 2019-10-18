<?php
/**
 * @var \App\View\AppView $this
 */
?>
    <h1>This is Admin index page</h1>

    <table>
        <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Peer Review Name</th>
            <th>Status</th>
        </tr>

        </thead>
        <tbody>
            <?php foreach($student_list as $student):?>
                <tr>
                    <td>000</td>
                    <td><?=$student->firstname.' '.$student->lastname?></td>
                    <td><?=$peer_review->title?></td>
                    <td>
                        <?php foreach ($peer_review_user_list as $peer_review_user): ?>
                            <?php if($peer_review_user->user_id==$student->id): ?>
                                <?php if($peer_review_user->status==0):?>
                                    <?='Incomplete'?>
                                <?php else:?>
                                    <?='Complete'?>
                                <?php endif;?>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
