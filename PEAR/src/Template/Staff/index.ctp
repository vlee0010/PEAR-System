<?php
/**
 * @var \App\View\AppView $this
 */
//$this->layout=false;
?>

<div id="staff-container" class="container">
    <h1>Unit List</h1>
    <div class="row">
        <?php foreach($unit_list as $index => $unit):?>
            <div style="min-height:174px;" class="d-flex card col-12 col-md-4 col-lg-3">
                <div style="height:70%;display: flex;align-items: center;justify-content: center"class="card-img" >
                    <h2 style="margin:0;"><?=$unit->code;?></h2>
                    <!--                    <img style="max-width: 100%"src="https://source.unsplash.com/user/vincentyaha/likes?sig=--><?//=rand()?><!--" alt="">-->
                </div>
                <div class="card-text d-flex justify-content-between">
<!--                    <div>-->
<!--                        <div class="progress-box" id="xyz--><?//=$index?><!--" style="margin:0 auto;"></div>-->
<!--                    </div>-->
                    <div style="margin:0 auto">
                        <a id="staff-unit-item" class="align-content-center" href=<?=$this->Url->build(['action'=>'displayclass',$unit->id]);?>><?=$unit->code .' ' . $unit->title?></a>
                    </div>
                </div>
            </div>
            <script>
                // progressbar.js@1.0.0 version is used
                // Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

                var bar = new ProgressBar.Circle('#xyz<?=$index?>', {
                    color: '#5972FF',
                    //
                    // This has to be the same size as the maximum width to
                    // prevent clipping
                    strokeWidth: 5,
                    trailWidth: 3,
                    easing: 'easeInOut',
                    duration: 2400,
                    text: {
                        autoStyleContainer: true
                    },
                    from: { color: '#5972FF', width: 3 },
                    to: { color: '#000', width: 4 },
                    // Set default step function for all animate calls
                    step: function(state, circle) {
                        circle.path.setAttribute('stroke', state.color);
                        circle.path.setAttribute('stroke-width', state.width);

                        var value = Math.round(circle.value() * 100);
                        if (value === 0) {
                            circle.setText('0%');
                        } else {
                            circle.setText(value+'%');
                        }

                    }
                });
                // bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
                bar.text.style.fontSize = '1rem';

                bar.animate(<?=$index?> * 0.1);  // Number from 0.0 to 1.0
            </script>


        <?php endforeach;?>
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
<!--<script type="text/javascript">-->
<!--    bar.animate(0.5);-->
<!--</script>-->

</body>
</html>

