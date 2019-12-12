<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit[]|\Cake\Collection\CollectionInterface $units
 */
$this->layout = 'default-staff';
//$this->layout = false;
//echo $this->Html->css('dt.css');
//echo $this->Html->css('dtutil.css');
?>


<!--https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css-->
<h1><?= __('Offerings') ?></h1>

<!--<div class="container-fluid">-->


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Offering</h4>
                </div>
                <div class="material-datatables" style="padding:30px;">
                    <table id="myTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('code') ?></th>
                            <th><?= $this->Paginator->sort('title') ?></th>
                            <th><?= $this->Paginator->sort('title') ?></th>
                            <th><?= $this->Paginator->sort('year') ?></th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($units as $unit): ?>
                            <tr>
                                <td><?= h($unit->code) ?></td>
                                <td><?= h($unit->title) ?></td>
                                <td><?= h($unit->semester) ?></td>
                                <td><?= h($unit->year) ?></td>
                                <td class="text-right" style="text-align:right">
                                    <?= $this->Html->link('<i class="material-icons">search</i>', ['action' => 'view', $unit->id],['class' =>'btn btn-link btn-info btn-just-icon','escape'=>false]) ?>
                                    <!--            <td class="text-right">-->
                                    <!--                <a href="#" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">favorite</i></a>-->
                                    <!--                <a href="#" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">dvr</i></a>-->
                                    <!--                <a href="#" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>-->
                                    <!--            </td>-->
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>



<!--</div>-->


<script>
    const unitTab = document.querySelector('#create-unit');
    unitTab.classList.add('active');

    const unit = document.querySelector('#va');
    unit.classList.add('active');

    const unitLink = document.querySelector('#unit-link');
    unitLink['aria-expanded'] = true;
    unitLink.classList.remove('collapsed');

    const unitExpand = document.querySelector('#unitExpand');

    unitExpand.classList.add('show');
    // $(document).ready(function() {
    //     $("input[name='unitCode']").change(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });
</script>
<?php echo $this->Html->script('material-pro/core/jquery.min.js');?>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
                searchClass: "form-control",
            }

        });

        var table = $('#myTable').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });
    });
</script>

