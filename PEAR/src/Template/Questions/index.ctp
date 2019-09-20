<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>

<style>
    <?php include 'CSS/question-slider.css' ?>
</style>
<?= $this->Form->create();?>
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

