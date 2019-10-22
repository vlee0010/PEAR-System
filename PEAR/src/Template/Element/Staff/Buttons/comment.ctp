<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    '<i class="icon-email-85"></i>',
    isset($disabled) && $disabled ? [] : $url,
    [
        'class' => 'btn btn-info btn-simple btn-icon btn-sm',
        'escape' => false,

    ]
);
