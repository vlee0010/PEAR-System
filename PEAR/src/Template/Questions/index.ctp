<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    <?php include 'CSS/question-slider.css' ?>

</style>
<?= $this->Form->create();?>
<div class="container">
<div class="card shadow">
    <h2 class="text-on-front" style="font-size:50px">Questions</h2>
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
<<<<<<< HEAD
                                <div class="wrapper" style="color:#fff;">
                                    <?php foreach($user_id_list as $user_id) : ?>
                                        <?php foreach ($user_query as $user): ?>
                                            <?php if($user->id==$user_id):?>
                                                <?= "please rate ".$user->firstname." ".$user->lastname?>

                                                <br>
                                            <?php ?>
                                                <input type="range" class="custom-range" min="0" max="5" name="slider">
                                                <br>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
=======
                                <div class="wrapper">
                                    <div class="toggle_radio" name="toggle_radio_<?php echo $question->id ?>">
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
                                        <div class="toggle_option_slider" id="toggle_option_slider_ <?php echo $question->id ?>">
                                        </div>
                                    </div>
>>>>>>> c7bec1364bcae80aabcc9e8f3dc8e8ed54e73ca2
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tbody>

        <?php endforeach; ?>
        <?php $n=6;?>
        <?php foreach($user_id_list as $user_id) : ?>
        <?php foreach ($user_query as $user): ?>
            <?php if($user->id==$user_id):?>
                    <tbody>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default" id="panel_<?php echo $n ?>">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $n ?>" aria-expanded="false" aria-controls="collapseTwo">
                                                <?= "Question ".$n." - please rate ".$user->firstname." ".$user->lastname?>
                                                <i class="fa fa-plus-circle pull-right"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?php echo $n ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <div class="wrapper" style="color:#fff;">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Example textarea</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                    <?php $n = $n+1;?>
            <?php endif; ?>

        <?php endforeach; ?>
        <?php endforeach; ?>
        <?=$this->Form->text('Submit', ['type'=>'submit','class'=>"btn btn-success", 'style'=>'text-align:center;']);?>





    </table>
</div>
</div>
<?= $this->Form->end();?>

