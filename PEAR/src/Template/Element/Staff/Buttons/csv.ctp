<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    'CSV',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-default',
        'escape' => false,
        'confirm' => isset($disabled) && $disabled ? false : 'Download results as CSV?',
        'disabled' => isset($disabled) && $disabled
    ]
);
