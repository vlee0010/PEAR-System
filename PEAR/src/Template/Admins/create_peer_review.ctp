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
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Unit Code(FIT3047) </label>
            <input name="unitCode" class="form-control"type="input"  >
        </div>
    </div>
    <!-- Title   -->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Title(Industrial Experience) </label>
            <input name="title" class="form-control"type="input"  >
        </div>
    </div>
</div>
<div class="row">
    <!--Semester-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Semester(1,2,A,B) </label>
            <input name="semester" class="form-control"type="input"   >
        </div>
    </div>
    <!--Year-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Year(2020) </label>
            <input name="year" class="form-control"type="input"  >
        </div>
    </div>
</div>
<div class="row">
    <!--Start date-->
    <div class="col-md-6">

        <div class="form-group bmd-form-group">
            Start Date
            <label class="bmd-label-floating"> </label>
            <input name="start-date" class="form-control"type="datetime-local"   >
        </div>
    </div>
    <!--End Date-->
    <div class="col-md-6">

        <div class="form-group bmd-form-group">
            End Date
            <label class="bmd-label-floating"></label>
            <input name="end-date" placeholder="123" class="form-control" type="datetime-local"  >
        </div>
    </div>
</div>

<div class="row">
    <!--Reminder date-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            Reminder Date
            <label class="bmd-label-floating"> </label>
            <input name="reminder-date" class="form-control"type="datetime-local"   >
        </div>
    </div>
</div>



<!--123-->
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





<!--                            <tr>-->
<!--                                <td>-->
<!--                                    <div class="form-check">-->
<!--                                        <label class="form-check-label">-->
<!--                                            <input class="form-check-input" type="checkbox" value="">-->
<!--                                            <span class="form-check-sign">-->
<!--                                    <span class="check"></span>-->
<!--                                  </span>-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                                <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>-->
<!---->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>-->
<!--                                    <div class="form-check">-->
<!--                                        <label class="form-check-label">-->
<!--                                            <input class="form-check-input" type="checkbox" value="">-->
<!--                                            <span class="form-check-sign">-->
<!--                                    <span class="check"></span>-->
<!--                                  </span>-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit-->
<!--                                </td>-->
<!---->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>-->
<!--                                    <div class="form-check">-->
<!--                                        <label class="form-check-label">-->
<!--                                            <input class="form-check-input" type="checkbox" value="" checked>-->
<!--                                            <span class="form-check-sign">-->
<!--                                    <span class="check"></span>-->
<!--                                  </span>-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                                <td>Create 4 Invisible User Experiences you Never Knew About</td>-->
<!---->
<!--                            </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!--End 123-->
<br>
<!--    <input type="checkbox" name="question1" value="Do you like your team?"> Do you like your team?<br>-->
<!--    <input type="checkbox" name="question2" value="Do you want to work with your teammates in the future?"> Do you want to work with your teammates in the future?<br>-->
<!--    <input type="checkbox" name="question3" value="How do you like Your mentors?" checked> How do you like Your mentors? <br><br>-->
<?= $this->Form->submit('Create Peer Review',['class'=>'btn btn-large btn-primary pull-right', 'id' =>'submit-btn']);?>
<?php echo $this->Form->end();?>

</div>
<script>
    // Create Peer Review highlight Tab
    const cprTab = document.querySelector('#pr');
    cprTab.classList.add('active');
    const submit = document.querySelector('.submit');
    submit.classList.add('m-auto');

//    "<i class=\"material-icons\">create</i>"
//     const submitBtn = document.querySelector('#submit-btn');
//     let submitIcon = document.createElement('i');
//     submitBtn.setAttribute("class",'material-icons');
//     submitBtn.innerText = 'create';
// //
//     submitBtn.appendChild(submitBtn);
</script>
