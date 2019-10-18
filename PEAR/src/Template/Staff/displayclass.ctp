<?php
/**
 * @var \App\View\AppView $this
 */
?>
    <h1>This is Admin index page</h1>
<?php foreach($class_list as $class):?>
    <a href=<?=$this->Url->build(['action'=>'displaystudent',$class->id,$peer_id]);?>><?=$class->class_name?></a>
<?php endforeach;?>
