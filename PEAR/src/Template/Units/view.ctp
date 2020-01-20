<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
$this->layout = 'default-staff';

use App\Model\Entity\Role;

?>


<?php $this->Breadcrumbs->templates([
    'wrapper' => '<nav aria-label="breadcrumb" role="navigation"><div class="breadcrumb">
                
                        &nbsp;&nbsp;{{content}}</div></nav>',
    'item' => '<div class="breadcrumb-item" {{attrs}}><a href="{{url}}" {{innerAttrs}}> {{title}} </a> </div>{{separator}}',
    'itemWithoutLink' => '<div class="breadcrumb-item active" aria-current="page" {{attrs}}><span{{innerAttrs}}> <u>{{title}}</u></span></div>{{separator}}',
    'separator' => '<div{{attrs}}><span{{innerAttrs}}>{{separator}}</span></li>'
]) ?>
<?php $this->Breadcrumbs->add('All Units', ['controller' => 'units', 'action' => 'index']) ?>
<?php $this->Breadcrumbs->add($unit->code . ' ' . $unit->title) ?>
<?= $this->Breadcrumbs->render(); ?>
<div class="units view large-9 medium-8 columns content">
    <h1><?= h($unit->code . ' ' . $unit->title . ' Semester ' . $unit->semester . ' ' . $unit->year) ?></h1>
    <?php $urlStudentImport = ['controller' => 'admins', 'action' => 'importStudent', $unit->id]; ?>
    <?php $urlStaffImport = ['controller' => 'admins', 'action' => 'importStaff', $unit->id]; ?>

    <div class="btn-group">
        <?= $this->Form->button('Import CSV File', ['class' => 'btn btn-primary dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']) ?>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= $this->Url->build($urlStudentImport) ?>">Student CSV</a>
            <a class="dropdown-item" href="<?= $this->Url->build($urlStaffImport) ?>">Staff CSV</a>
        </div>
    </div>
    <div class="btn-group">
        <?= $this->Form->button('Generate CSV File', ['class' => 'btn btn-secondary dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']) ?>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#studentModal<?= $unit->id ?>">Student
                CSV</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#staffModal<?= $unit->id ?>">Staff
                CSV</a>
        </div>
    </div>
    <?= $this->Html->link('<i class="material-icons">edit</i> Customize Email ', ['controller' => 'emails', 'action' => 'edit', $unit->id], ['class' => 'btn btn-secondary', 'escape' => false]) ?>
    <!-- Student Modal -->
    <div class="modal fade" id="studentModal<?= $unit->id ?>" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" align="left">
                    <h3 class="modal-title" id="exampleModalLabel" align="left">System Alert</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Generate Student CSV Template
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']); ?>
                    <?= $this->element('Staff/Buttons/generate_csv', ['class' => 'btn btn-behance', 'url' => ['controller' => 'units', 'action' => 'generateCsv', $unit->id, Role::STUDENT]]) ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Staff Modal -->
    <div class="modal fade" id="staffModal<?= $unit->id ?>" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" align="left">
                    <h3 class="modal-title" id="exampleModalLabel" align="left">System Alert</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Generate Staff CSV Template
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']); ?>
                    <?= $this->element('Staff/Buttons/generate_csv', ['class' => 'btn btn-behance', 'url' => ['controller' => 'units', 'action' => 'generateCsv', $unit->id, Role::STAFF]]) ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br/>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h3 class="card-title">Offering</h3>
                    <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <tbody>
                        <tr></tr>
                        <tr>
                            <th scope="row"><?= __('Title') ?></th>
                            <td><?= h($unit->title) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Code') ?></th>
                            <td><?= h($unit->code) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Year') ?></th>
                            <td><?= h($unit->year) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Semester') ?></th>
                            <td><?= h($unit->semester) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h3 class="card-title"><?= __('Peer Reviews') ?></h3>
                </div>
                <div class="card-body table-responsive">
                    <div class="related">
                        <?php if (!empty($unit->peer_reviews)): ?>
                            <table class="table">
                                <tr>
                                    <th scope="col"><?= __('Title') ?></th>
                                    <th scope="col"><?= __('Date Start') ?></th>
                                    <th scope="col"><?= __('Date End') ?></th>
                                </tr>
                                <?php foreach ($unit->peer_reviews as $peerReviews): ?>
                                    <tr>
                                        <td><?= $peerReviews->title ?></td>
                                        <td><?= date("d-M-Y", strtotime($peerReviews->date_start)) ?></td>
                                        <td><?= date("d-M-Y", strtotime($peerReviews->date_end)) ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#student" data-toggle="tab">
                                <i class="material-icons">sentiment_very_satisfiedt</i> Students
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#staff" data-toggle="tab">
                                <i class="material-icons">emoji_emotionss</i> Staff
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="student">
                    <?php if (!empty($paginatorStudent)): ?>
                        <table class="table">
                            <tr>
                                <th scope="col"><?= __('Student ID') ?></th>
                                <th scope="col"><?= __('First name') ?></th>
                                <th scope="col"><?= __('Last name') ?></th>
                                <th scope="col"><?= __('Email') ?></th>
                            </tr>
                            <?php foreach ($paginatorStudent as $student): ?>
                                <tr>
                                    <td><?= $student->studentid ?></td>
                                    <td><?= $student->firstname ?></td>
                                    <td><?= $student->lastname ?></td>
                                    <td><?= $student->email ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                    <nav aria-label="...">
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->first(__('first'),['model' => 'Users']) ?>
                                <?= $this->Paginator->prev(__('previous'),['model' => 'Users']) ?>
                                <?= $this->Paginator->numbers(['model' => 'Users']) ?>
                                <?= $this->Paginator->next(__('next'),['model' => 'Users']) ?>
                                <?= $this->Paginator->last(__('last'),['model' => 'Users']) ?>
                            </ul>
                            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total'),'model'=> 'Users']) ?></p>
                        </div>
                    </nav>
                </div>
                <div class="tab-pane" id="staff">
                    <?php if (!empty($paginatorStaff)): ?>
                        <table class="table">
                            <tr>
                                <th scope="col"><?= __('Student ID') ?></th>
                                <th scope="col"><?= __('First name') ?></th>
                                <th scope="col"><?= __('Last name') ?></th>
                                <th scope="col"><?= __('Email') ?></th>
                            </tr>
                            <?php foreach ($paginatorStaff as $staff): ?>
                                <tr>
                                    <td><?= $staff->studentid ?></td>
                                    <td><?= $staff->firstname ?></td>
                                    <td><?= $staff->lastname ?></td>
                                    <td><?= $staff->email ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                    <nav aria-label="...">
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->first(__('first'),['model' => 'Users2']) ?>
                                <?= $this->Paginator->prev( __('previous'),['model' => 'Users2']) ?>
                                <?= $this->Paginator->numbers(['model' => 'Users2']) ?>
                                <?= $this->Paginator->next(__('next'),['model' => 'Users2']) ?>
                                <?= $this->Paginator->last(__('last'),['model' => 'Users2']) ?>
                            </ul>
                            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total'),'model'=> 'Users2']) ?></p>
                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    const unitTab = document.querySelector('#create-unit');
    unitTab.classList.add('active');

    // $(document).ready(function() {
    //     $("input[name='unitCode']").change(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });
</script>
