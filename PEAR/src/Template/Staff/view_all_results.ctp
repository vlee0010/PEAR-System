<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\I18n\Number;

$SEVENTY_PERCENT = 0.7;
?>
<style>
    .popover {
        max-width: 500px;
    }
</style>

<!--starts here-->
<?php foreach ($unit_activity as $unit_activity1): ?>
    <?php $this->Breadcrumbs->add('Class', ['controller' => 'staff', 'action' => 'displayclass', $unit_activity1->unit_id]) ?>
    <?php $this->Breadcrumbs->add('Student List', $this->request->referer()) ?>
    <?php $this->Breadcrumbs->add('Activity Result') ?>
    <?php break; ?>
<?php endforeach; ?>

<div id="staff-container" class="container">
    <div class="container-fluid">
        <main class="col-12 col-md-12 col-xl-12 py-md-3 pl-md-6 bd-content" role="main">
            <?php foreach ($unit_activity as $unit_activity): ?>
                <h1><?= $unit_activity->unitcode . " " . $unit_activity->activity ?></h1>
            <?php endforeach; ?>

            <div
                align="right"><?= $this->Form->button('Download CSV', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#exampleModal']); ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            Download results as CSV?
                        </div>
                        <div class="modal-footer">
                            <?= $this->Form->button('Close', ['class' => 'btn btn-warning', 'data-dismiss' => 'modal']); ?>
                            <?= $this->element('Staff/Buttons/csv', ['url' => ['action' => 'export', $unit_activity->peer_id]]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Team</th>
                        <th>Student</th>

                        <?php foreach ($questions_desc as $item): ?>
                            <th class="text-center"><?= $item->question ?></th>
                        <?php endforeach; ?>
                        <th>Total Score</th>
                        <th>Comment</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($teamList as $key => $value):
                        foreach ($value as $sth):
                            $total_score = $count * 5;
                            $comment = "";
                            $sum_score = 0; ?>
                            <tr>
                                <td><?= $sth[3] ?></td>
                                <td><?= $sth[1] ?></td>

                                <?php if ($sth[4] == 1):
                                    foreach ($student_result_array as $item):
                                        if ($item->user_id == $sth[0]):
                                            $float = (float)$item->average_score;
                                            $sum_score += $float ?>
                                            <td align="center"><?= Number::format($float, ['precision' => 1]) ?></td>
                                        <?php endif;
                                    endforeach;
                                else:
                                    foreach ($questions_desc as $value): ?>
                                        <td  align="center"><?= 0 ?></td>
                                    <?php endforeach; ?>

                                <?php endif; ?>
                                <?php foreach ($student_comment_list as $item):
                                    if ($item->ratee_id == $sth[0]):
                                        $comment .= "<b>" . $item->student_firstname . " " . $item->student_lastname . ":</b>. " . $item->comment;
                                        $comment .= "<br/>";
                                    endif;
                                endforeach; ?>
                                <?php if ($sum_score < $SEVENTY_PERCENT * $total_score): ?>
                                    <td class="alert alert-danger"
                                        align="center"><?= Number::format($sum_score, ['precision' => 1]) . "/" . $total_score ?></td>
                                <?php else: ?>
                                    <td align="center"><?= Number::format($sum_score, ['precision' => 1]) . "/" . $total_score ?></td>
                                <?php endif; ?>
                                <td align="center">
                                    <a tabindex="0"
                                       id="button_<?php echo $sth[0] ?>"
                                       role="button"
                                       class="btn btn-info btn-simple btn-icon btn-sm"
                                       data-container="body"
                                       data-toggle="popover"
                                       data-placement="left"
                                       data-trigger="focus"
                                       data-html="true"
                                       data-content="<?= $comment ?>">
                                        <i class="fas fa-comments"></i>
                                    </a>
                                </td>

                            </tr>


                        <?php endforeach; ?>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
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
