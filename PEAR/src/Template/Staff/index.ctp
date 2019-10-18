<?php
/**
 * @var \App\View\AppView $this
 */
?>
<h1>This is Admin index page</h1>
<?php foreach($unit_list as $unit):?>
    <a href=<?=$this->Url->build(['action'=>'displayclass',$unit->id]);?>><?=$unit->code.' '.$unit->title?></a>
<?php endforeach;?>
