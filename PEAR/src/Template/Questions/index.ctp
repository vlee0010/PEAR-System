<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>

<style>
    <?php include 'CSS/question-slider.css' ?>
</style>

<div class="container">
<div class="card shadow">
    <h2 class="text-on-back" style="font-size:50px">Questions</h2>
    <table class="table table-flush" cellpadding="0" cellspacing="0" >

        <?php foreach ($questions as $question):?>
        <tbody>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default" id="panel_<?php echo $question->id ?>">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $question->id ?>" aria-expanded="false" aria-controls="collapseTwo">
                                    <?php echo "Question " . $question->id. " - ". $question->description ?>
                                    <i class="fa fa-plus-circle pull-right"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $question->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="wrapper">
                                    <div class="toggle_radio<?php echo $question->id ?>">
                                        <input type="radio" class="toggle_option" id="first_toggle" name="toggle_option<?php echo $question->id ?>">
                                        <input type="radio" class="toggle_option" id="second_toggle" name="toggle_option<?php echo $question->id ?>">
                                        <input type="radio" checked class="toggle_option" id="third_toggle" name="toggle_option<?php echo $question->id ?>">
                                        <input type="radio" class="toggle_option" id="fourth_toggle" name="toggle_option<?php echo $question->id ?>">
                                        <input type="radio" class="toggle_option" id="fifth_toggle" name="toggle_option<?php echo $question->id ?>">
                                        <label for="first_toggle"><p>Very Unlikely</p></label>
                                        <label for="second_toggle"><p>Unlikely</p></label>
                                        <label for="third_toggle"><p>Neutral</p></label>
                                        <label for="fourth_toggle"><p>Likely</p></label>
                                        <label for="fifth_toggle"><p>Very Likely</p></label>
                                        <div class="toggle_option_slider">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tbody>

        <?php endforeach; ?>

    </table>
</div>
</div>

