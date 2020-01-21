<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    'Generate Staff CSV',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-primary',
        'escape' => false,
        'disabled' => isset($disabled) && $disabled,
        'data-dismiss' => 'modal'
    ]
);
