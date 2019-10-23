<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    'View Results',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-info',
        'escape' => false,
    ]
);
