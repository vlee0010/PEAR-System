<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>

<?= $this->Form->create();?>
<div class="container" >
    <div class="card shadow text-center" style="position:relative;">
        <h2 class="text-on-front" style="font-size:50px">PEAR Questions for Industry Experience Iteration 2</h2>
        <button id="expandCloseBtn" class="btn btn-primary" style="left: 3%;position:fixed;margin-right: 20px;width:100px;height:100px;font-size: 1rem;padding:0; border-radius: 999px;">Expand <br>Close<br> All </button>
        <table class="table table-flush" cellpadding="0" cellspacing="0" >

            <?php foreach ($questions as $question):?>
                <tbody>
                <div id="myModal" class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" style="margin: 0 auto">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default" style="margin:0 auto" id="panel_<?php echo $question->id ?>">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" onclick="changeClass(this)" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $question->id ?>" aria-expanded="false" aria-controls="collapseTwo">
                                            <strong><?php echo "Question " . $question->id. " - ". $question->description ?></strong>
                                            <i id="ifopen<?php echo $question->id ?>"  class="fa fa-plus-circle pull-right"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $question->id ?>" class="panel-collapse collapse show toggle-show" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">

                                        <div class="wrapper" style="color:#fff;padding:20px;">
                                            <?php foreach($user_id_list as $user_id) : ?>
                                                <?php foreach ($user_query as $user): ?>
                                                    <?php if($user->id==$user_id):?>
                                                        <?= "Please rate ".$user->firstname." ".$user->lastname?>
                                                        <br>
                                                        <?php if($question->id!=6):?>
                                                            <br>
                                                            <input id="sliderA_<?=$question->id;?>_<?=$user_id?>" type="range" name="sliderRating_<?=$question->id;?>_<?=$user_id?> "

                                                                   pattern="[1-5]"
                                                                   required="required"
                                                                   data-provide="slider"
                                                                   data-slider-ticks="[0,1,2,3,4,5]"
                                                                   data-slider-ticks-labels='["N/A", "Strongly Disagree", "Disagree", "Neutral", "Agree", "Strongly Agree"]'
                                                                   data-slider-ticks-positions="[0,20,40,60,80,100]"
                                                                   data-slider-min="0"
                                                                   data-slider-max="5"
                                                                   data-slider-step="1"
                                                                   data-slider-value="0"
                                                                   data-slider-tooltip="hide"
                                                                   data-value="2" value="2" style="display: none;">

                                                            <br>

                                                            <br>
                                                            <br>
                                                        <?php else:?>
                                                            <div class="form-group">
                                                                <label for="comment">Comments</label>
                                                                <textarea class="form-control" rows="5" id="comment" required name="textRating_<?=$question->id;?>_<?=$user_id?>"></textarea>
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
            <?=$this->Form->submit('Submit', ['class'=>"btn btn-success", 'id'=>'question-submit', 'style'=>'text-align:center;color:black;margin:0 auto']);?>
        </table>
    </div>
</div>


<?= $this->Html->script('core/jquery.min.js') ?>
<?= $this->Html->script('core/popper.min.js') ?>
<?= $this->Html->script('core/bootstrap.min.js') ?>
<?= $this->Html->script('plugins/perfect-scrollbar.jquery.min.js') ?>
<?= $this->Html->script('plugins/bootstrap-switch.js') ?>
<?= $this->Html->script('plugins/nouislider.min.js') ?>

<?= $this->Html->script('highlight.min.js') ?>
<?= $this->Html->script('src/js/bootstrap-slider.js') ?>
<?= $this->Html->script('demo.js') ?>
<?= $this->Html->script('blk-design-system.min.js?v=1.0.0') ?>
<?= $this->Html->css('bootstrap-slider.css') ?>

<?= $this->Form->end();?>

<script>




    const expand = document.querySelector('#expandCloseBtn');
    expand.addEventListener('click', function(e){
        console.log(e.target)
        e.preventDefault();
        const questionsArray = document.querySelectorAll('.toggle-show');
        questionsArray.forEach(function(e){
            e.classList.toggle('show');
            if (e.classList.contains('show')){
                (e.parentElement.children[0].children[0].children[0].children[0].className = 'fa fa-minus-circle pull-right');
            } else{
                (e.parentElement.children[0].children[0].children[0].children[0].className = 'fa fa-plus-circle pull-right');
            }

        })
    })

    function changeClass(e){
        console.log(e.children[0].className)
        console.log(e.children[0].classList.contains("fa-plus-circle"));
        if(e.children[0].classList.contains("fa-plus-circle")){
            e.children[0].className="fa fa-minus-circle pull-right";
            console.log('+');
        }
        else if(e.children[0].classList.contains("fa-minus-circle")){
            e.children[0].className="fa fa-plus-circle pull-right";
            console.log('-');
        }
        // else if(event.target.children[0].className=="fa fa-plus-circle pull-right"){
        //     event.target.children[0].className="fa fa-minus-circle pull-right";
        // }
        // else if(event.target.children[0].className=="fa fa-minus-circle pull-right"){
        //     event.target.children[0].className="fa fa-plus-circle pull-right";
        // }

    }

</script>




