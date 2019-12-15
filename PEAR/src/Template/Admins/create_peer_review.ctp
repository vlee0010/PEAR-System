<?php
//$this->layout=  false;
$this->layout = 'default-staff';
?>
<style>
    .select2-container--default .select2-selection--single{
        border:none;
        background-color: transparent;
    }
</style>

<h1>Create New Peer Review</h1>
<?php
echo $this->Form->create(); ?>
<!--Unit Code-->
<div class="row mt-5">
    <div class="col-md-6">
        <label >Select Unit</label>
            <?php

            echo $this->Form->input('selectUnit',['required'=>true,'type'=>'select','options'=>$unitList,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single','value'=>$unit_id]);?>



    </div>
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            Title
            <label class="bmd-label-floating"> </label>
            <input required name="title" class="form-control"type="text" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>
</div>

    <!-- Title   -->

<div class="row">
    <div class="col-md-6">
        <div class="form-group bmd-form-group" >
            <label for="start">Start:</label>
            <br>
            <input onpaste="return false;" onkeypress="return false;" required class="form-control" type="text" id="start" placeholder="Please Pick a start date" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group bmd-form-group" >
            <label for="end">End:</label>
            <br>
            <input onkeypress="return false;" onpaste="return false;" required class="form-control" type="text" id="end" placeholder="Please Pick an end date" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group bmd-form-group" >
            <label  for="reminder">Reminder:</label>
            <br>
            <input onpaste="return false;" onkeypress="return false;" required class="form-control" type="text" id="reminder" placeholder="Please Pick start date and end date first" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>
</div>








<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">Tasks:</span>
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" data-toggle="tab">
                                    <i class="material-icons">create</i> Pick Your Peer Review Questions
                                    <div class="ripple-container"></div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <table class="table">
                            <tbody>

                <?php foreach ($questions as $index => $question):?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="question[]" type="checkbox" value="<?=$question->id?>" checked>
                                            <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                        </label>
                                    </div>
                                </td>
                                <td><?= $question->description ;?></td>

                            </tr>
                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br>

<?= $this->Form->submit('Create Peer Review',['class'=>'btn btn-large btn-primary pull-right', 'id' =>'submit-btn']);?>
<?php echo $this->Form->end();?>


    <script>
        $("#submit-btn").submit(function(){
            var checked = $("form input:checked").length > 0;
            if (!checked){
                alert("Please check at least one checkbox");
                return false;
            }
        });
    </script>

<script>





//    select 2
    const unitSelector = document.querySelector("[name='selectUnit']");

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    // Create Peer Review highlight Tab
    const cprTab = document.querySelector('#pr');
    cprTab.classList.add('active');
    const submit = document.querySelector('.submit');
    submit.classList.add('m-auto');


    document.querySelector('select').parentElement.classList.add('form-control');
</script>

    <script>
        // var picker = new Pikaday({ field: document.getElementById('datepicker') });
        var
            checkStart = false,
            checkEnd = false,
            startDate,
            endDate,
            updateStartDate = function () {
                startPicker.setStartRange(startDate);
                endPicker.setStartRange(startDate);
                endPicker.setMinDate(startDate);
                reminderPicker.setStartRange(startDate);
                reminderPicker.setMinDate(startDate);
            },
            updateEndDate = function () {
                startPicker.setEndRange(endDate);
                startPicker.setMaxDate(endDate);
                endPicker.setEndRange(endDate);

                reminderPicker.setMaxDate(endDate);
            },
            startPicker = new Pikaday({
                field: document.getElementById('start'),
                toString(date, format) {
                    return moment(date).format('DD/MM/YYYY');
                },
                minDate: new Date(),
                maxDate: new Date(2030, 12, 31),
                onSelect: function () {
                    startDate = this.getDate();
                    updateStartDate();
                    checkStart = true;
                    reminderCheck();
                }
            }),
            endPicker = new Pikaday({
                field: document.getElementById('end'),
                format: 'DD/MM/YYYY',
                toString(date, format) {
                    return moment(date).format('DD/MM/YYYY');
                },
                minDate: new Date(),
                maxDate: new Date(2030, 12, 31),
                onSelect: function () {

                    endDate = this.getDate();
                    updateEndDate();
                    checkEnd = true;
                    reminderCheck();
                }
            }),
            reminderPicker = new Pikaday({});
            function reminderCheck() {
            if (checkStart && checkEnd) {
                reminderPicker = new Pikaday({
                    field: document.getElementById('reminder'),
                    toString(date, format) {
                        return moment(date).format('DD/MM/YYYY');
                    },
                    minDate: new Date(),
                    maxDate: new Date(2030, 12, 31),

                    onSelect: function () {
                        startDate = this.getDate();
                    }
                });


                reminderPicker.setEndRange(moment(endDate).add({days: -1}).toDate());
                reminderPicker.setMinDate(moment(startDate).add({days: 1}).toDate());
                reminderPicker.setMaxDate(moment(endDate).add({days: -1}).toDate());
                reminderPicker.setStartRange(moment(startDate).add({days: 1}).toDate());
            }

        }



        _startDate = startPicker.getDate(),
            _endDate = endPicker.getDate();
        if (_startDate) {
            startDate = _startDate;
            updateStartDate();
        }
        if (_endDate) {
            endDate = _endDate;
            updateEndDate();
        }
    </script>









