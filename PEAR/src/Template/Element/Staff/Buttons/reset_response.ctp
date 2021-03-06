<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Html->meta('icon') ;

echo $this->Html->css('nucleo-icons.css');

echo $this->Form->postLink(
    '<i class="tim-icons icon-refresh-01"></i> Reset',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-info',
        'escape' => false,
        'disabled' => isset($disabled) && $disabled,
        'data-dismiss' => 'modal'

    ]
);
