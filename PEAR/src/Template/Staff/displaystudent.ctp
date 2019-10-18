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
                    <td>asdas</td>
                    <td>111</td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
