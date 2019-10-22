<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

    echo $this->Html->meta('icon') ;

    echo $this->Html->css('nucleo-icons.css');

echo $this->Form->postLink(
    '<i class="fas fa-comments"></i>',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-info btn-simple btn-icon btn-sm',
        'data-container' =>  'body',
        'data-toggle' => 'popover',
        'data-placement' =>"top",
        'data-content' => "Vivamus sagittis lacus vel augue laoreet rutrum faucibus.",
        'escape' => false,

        ]
    );
