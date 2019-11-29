<?php
/**
 * @var \App\View\AppView $this
 * @var string $query
 */


?>

<!--starts here-->
<?php foreach ($unit_activity as $unit_activity1): ?>
    <?php $this->Breadcrumbs->add('Class', ['controller' => 'staff', 'action' => 'displayclass', $unit_activity1->unit_id]) ?>
    <?php $this->Breadcrumbs->add('Student List') ?>
    <?php break; ?>
<?php endforeach; ?>

<div id="staff-container" class="container">
    <div class="container-fluid">
        <main class="col-12 col-md-12 col-xl-12 py-md-3 pl-md-6 bd-content" role="main">
            <h1>Activity List</h1>

            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Activity (Section)</th>
                        <th>Start</th>
                        <th>End</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($unit_activity as $unit_activity): ?>
                    <tr>
                        <td><?= $unit_activity->unitcode ?></td>
                        <td><?= $unit_activity->activity ?></td>
                        <td><?= date("d-M-Y", strtotime($unit_activity->datestart)) ?></td>
                        <td><?= date("d-M-Y", strtotime($unit_activity->dateend)) ?></td>
                        <td class="actions" align="center">
                            <?= $this->element('Staff/Buttons/results', ['url' => ['action' => 'viewAllResults', $unit_activity->peer_id]]) ?>
                            <?= $this->Form->button('Send Reminder', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#exampleModal']); ?>

                        </td>

                    </tr>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">System Alert</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 style="color: #0a0c0d">Send Email to All Students?</h4>
                        </div>
                        <div class="modal-footer">
                            <?= $this->Form->button('Close', ['class' => 'btn btn-warning', 'data-dismiss' => 'modal']); ?>
                            <?= $this->element('Staff/Buttons/send', ['url' => ['action' => 'sendReminderEmail', ]]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            </tbody>

            </table>

            <br>
            <h1>Students Yet To Complete</h1>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel2"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">System Alert</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 style="color: #0a0c0d">Send Email to All Students?</h4>
                        </div>
                        <div class="modal-footer">
                            <?= $this->Form->button('Close', ['class' => 'btn btn-warning', 'data-dismiss' => 'modal']); ?>
                            <?= $this->element('Staff/Buttons/send', ['url' => ['action' => 'sendReminderEmail', $unit_activity->peer_id]]) ?>
                        </div>
                    </div>
                </div>
            </div>



            <?= $this->Form->create(null, ['method' => 'GET']) ?>
            <form class="form-inline ml-auto">
                <div class="form-group no-border" align="left">
                    <?= $this->Form->control('query', ['label' => '', 'class' => 'form-control', 'placeholder' => 'Search', 'default' => $this->request->query('query'), 'value' => $query]) ?>
                </div>
            </form>
            <?= $this->Form->end() ?>
            <div align="right">
                <?= $this->Form->button('Send Reminder', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#exampleModal2', 'data-dismiss' => 'modal']); ?>
            </div>
            <br>
            <table id="student-table" class="table">
                <thead>
                <tr>
                    <!--            <th>Student ID</th>-->
                    <th>Student Name</th>
                    <th>Peer Review Name</th>
                    <th>Status</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>

                </thead>
                <tbody>
                <?php foreach ($student_list as $student): ?>
                    <tr>
                        <td><?= $student->firstname . ' ' . $student->lastname ?></td>
                        <td><?= $peer_review->title ?></td>

                        <?php foreach ($peer_review_user_list as $peer_review_user): ?>
                            <?php if ($peer_review_user->user_id == $student->id): ?>
                                <?php if ($peer_review_user->status == 0): ?>
                                    <td><?= 'Incomplete' ?></td>
                                    <td>
                                        <?= $this->Form->button('<i class="tim-icons icon-refresh-01"></i> Reset', ['class' => 'btn btn-info btn-sm disabled', 'data-toggle' => 'modal', 'data-target' => '#exampleModal3']);?>
                                    </td>
                                <?php else: ?>
                                    <td><?= 'Complete' ?></td>
                                    <td>
                                        <?= $this->Form->button('<i class="tim-icons icon-refresh-01"></i> Reset', ['class' => 'btn btn-info btn-sm', 'data-toggle' => 'modal', 'data-target' => '#exampleModal_'.$student->id.'_'.$peer_review->id]);?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_<?=$student->id.'_'.$peer_review->id?>" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel2"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">System Alert</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" >
                                                        <h4 style="color: #0a0c0d">Reset Response for <?= $student->firstname . ' ' . $student->lastname ?>?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?= $this->Form->button('Close', ['class' => 'btn btn-warning', 'data-dismiss' => 'modal']); ?>
                                                        <?= $this->element('Staff/Buttons/reset_response', ['url' => ['action' => 'resetResponse', $student->id, $peer_review->id]]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>


<?= $this->Html->script('core/jquery.min.js') ?>
<?= $this->Html->script('core/popper.min.js') ?>
<?= $this->Html->script('core/bootstrap.min.js') ?>
<?= $this->Html->script('plugins/perfect-scrollbar.jquery.min.js') ?>
<?= $this->Html->script('plugins/bootstrap-switch.js') ?>
<?= $this->Html->script('plugins/nouislider.min.js') ?>
<?= $this->Html->script('plugins/chartjs.min.js') ?>
<?= $this->Html->script('plugins/moment.min.js') ?>
<?= $this->Html->script('plugins/bootstrap-datetimepicker.js') ?>

<?= $this->Html->script('blk-design-system.min.js') ?>
<?= $this->Html->script('blk-design-system.min.js?v=1.0.0') ?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>
</html>

