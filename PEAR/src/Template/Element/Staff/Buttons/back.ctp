<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    'Back',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-default',
        'escape' => false,
    ]
);
