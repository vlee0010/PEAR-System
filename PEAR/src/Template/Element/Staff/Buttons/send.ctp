<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    'Send Email',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-default',
        'escape' => false,
        'confirm' => isset($disabled) && $disabled ? false : 'Send Email to All Students?',
        'disabled' => isset($disabled) && $disabled
    ]
);
