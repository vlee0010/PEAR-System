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

            echo $this->Form->input('selectUnit',['required'=>true,'type'=>'select','options'=>$unitList,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single']);?>



    </div>
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            Title
            <label class="bmd-label-floating"> </label>
            <input required name="title" class="form-control"type="text">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            Start Date
            <label class="bmd-label-floating"> </label>
            <div id="startDate" class="date">
            <input required type="text"  class="form-control datetimepicker" id="dateStart" name="start-date">
<!--            <input required name="start-date" class="form-control"type="date">-->
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group bmd-form-group">
            End Date
            <label class="bmd-label-floating"></label>
            <div id="endDate" class="date">
                <input required type="text" class="form-control datetimepicker" id="dateEnd" name="end-date">
            </div>

<!--            <input required name="end-date" class="form-control" type="date">-->
        </div>
    </div>
</div>
    <!-- Title   -->

<div class="row">
    <!--Start date-->

    <!--End Date-->




    <!--Reminder date-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            Reminder Date
            <label class="bmd-label-floating"> </label>
            <div id="reminderDate">
                <input required name="reminder-date" class="form-control datetimepicker" type="text">
            </div>

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




</div>



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




    // $('#startDate').datepicker();


    $(document).ready(function(){

        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        })



        $('#startDate').datetimepicker({
            locale: moment.locale('fr'),
            format: moment().format('D MMM YY'),
            format:'DD/MM/YYYY HH:mm:ss',
            language: 'en',
            autoclose: true
        });
        $('#endDate').datetimepicker({
            format: 'LT',
            format:'DD/MM/YYYY HH:mm:ss'
        });
        $('#reminderDate').datetimepicker({
            format: 'LT',
            format:'DD/MM/YYYY HH:mm:ss'
        });
        $('#startDate').datetimepicker("DateTimePicker").format('DD/MM/YYYY hh:mm:ss');
        $('#endDate').datetimepicker("DateTimePicker").format('DD/MM/YYYY hh:mm:ss');
        $('#reminderDate').data("DateTimePicker").format('DD/MM/YYYY hh:mm:ss');


        $("#startDate").on("dp.change", function (e) {

            $('#endDate').data("DateTimePicker").minDate(e.date)
            $('#reminderDate').date("DateTimePicker").minDate(e.date)
            $('#endDate').data("DateTimePicker").show()
            console.log('設置了endDate的最低時間')
            console.log(e.date)
        })
        $("#endDate").on("dp.change", function (e) {
            $('#startDate').data("DateTimePicker").maxDate(e.date);
            $('#reminderDate').data("DateTimePicker").show();
            console.log('設置了startDate的最高時間')
            console.log(e.date)

        })




    //end
    })


//
// $(function () {
//     $('#startDate').datetimepicker();
//     $('#endDate').datetimepicker({
//         useCurrent: false
//     });
//     $("#startDate").on("change.datetimepicker", function (e) {
//         $('#endDate').datetimepicker('minDate', e.date);
//     });
//     $("#endDate").on("change.datetimepicker", function (e) {
//         $('#startDate').datetimepicker('maxDate', e.date);
//     });
// });


    document.querySelector('select').parentElement.classList.add('form-control');
</script>










