<?php
//$this->layout=  false;
$this->layout = 'default-staff';
?>


<h1>Create New Peer Review</h1>
<?php
echo $this->Form->create(); ?>
<!--Unit Code-->
<div class="row mt-5">
    <div class="col-md-6">
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
            <input required type="date" class="form-control" id="dateStart" name="start-date">
<!--            <input required name="start-date" class="form-control"type="date">-->
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group bmd-form-group">
            End Date
            <label class="bmd-label-floating"></label>
            <input required type="date" class="form-control" id="dateEnd" name="end-date">
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

            <input required name="reminder-date" class="form-control" type="date">
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
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js" defer></script>

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

</script>
