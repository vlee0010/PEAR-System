<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
$this->layout = 'default-staff';
?>

<div class="units view large-9 medium-8 columns content">
    <h1><?= h($unit->code.' '. $unit->title.' Semester '.$unit->semester.' '. $unit->year) ?></h1>
    <?php $urlImport = ['controller' => 'admins','action' => 'importStudent',$unit->id];
    echo $this->Form->button('Import Student CSV', ['onclick' => "location.href='".$this->Url->build($urlImport)."'", 'class'=>'delbutton btn btn-warning']);
    echo $this->Form->button('Generate Student CSV', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#exampleModal'.$unit->id])?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?=$unit->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <?= $this->element('Staff/Buttons/generate_csv', ['class' => 'btn btn-secondary','url' => ['controller' => 'units','action' => 'generateStudentCsv', $unit->id]])?>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($unit->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($unit->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Semester') ?></th>
            <td><?= h($unit->semester) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= h($unit->year) ?></td>
        </tr>

    </table>
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
