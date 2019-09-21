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

                                    <div class="wrapper" style="color:#fff;padding:20px;">
                                        <?php foreach($user_id_list as $user_id) : ?>
                                            <?php foreach ($user_query as $user): ?>
                                                <?php if($user->id==$user_id):?>
                                                    <?= "Please rate ".$user->firstname." ".$user->lastname?>
                                                    <br>
                                                    <?php if($question->id!=6):?>
                                                        1<input class="custom-range" name="sliderRating_<?=$question->id;?>_<?=$user_id?>"  type="radio"  min="1" max="5"  step="1" value="1">
                                                        2<input class="custom-range" name="sliderRating_<?=$question->id;?>_<?=$user_id?>"  type="radio"  min="1" max="5"  step="1" value="2">
                                                        3<input class="custom-range" name="sliderRating_<?=$question->id;?>_<?=$user_id?>"  type="radio"  min="1" max="5"  step="1" value="3">
                                                        4<input class="custom-range" name="sliderRating_<?=$question->id;?>_<?=$user_id?>"  type="radio"  min="1" max="5"  step="1" value="4">
                                                        5<input class="custom-range" name="sliderRating_<?=$question->id;?>_<?=$user_id?>"  type="radio"  min="1" max="5"  step="1" value="5">
                                                        <br>
                                                    <?php else:?>
                                                    <div class="form-group">
                                                        <label for="comment">Comments</label>
                                                        <textarea class="form-control" rows="5" id="comment" name="textRating_<?=$question->id;?>_<?=$user_id?>"></textarea>
                                                    </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </tbody>

            <?php endforeach; ?>
            <?=$this->Form->submit('Submit', ['class'=>"btn btn-success", 'style'=>'text-align:center;']);?>

        </table>
    </div>
</div>


<?= $this->Form->end();?>



