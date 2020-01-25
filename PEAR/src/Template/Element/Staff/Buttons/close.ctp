<?php
/**
 * @var \App\View\AppView $this
 * @var array $url
 * @var boolean $disabled
 */

echo $this->Form->postLink(
    '<i class="material-icons">pause</i>',
    isset($disabled) && $disabled ? [] : $url,
    [
        'type' => 'button',
        'class' => 'btn btn-primary btn-link btn-sm',
        'rel' => 'tooltip',
        'data-placement' => 'top',
        'data-original-title' => 'Close',
        'title' => 'Close',
        'escape' => false,
        'confirm' => isset($disabled) && $disabled ? false : 'Are you sure?',
        'disabled' => isset($disabled) && $disabled
    ]
);

