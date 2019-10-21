<?php
/*
 * What page is the user currently viewing? We need to know this so that we can highlight the correct menu item,
 * to provide visual feedback to the user about where they are in the website.
 */
$currentController = $this->request->getParam('controller');
$currentAction = $this->request->getParam('action');

$isDashboardActive  = $currentController === 'Admin' && $currentAction === 'index';
$isEnquiriesActive  = $currentController === 'Enquiries';
$isProductsActive  = $currentController === 'Products';
$isContentActive  = $currentController === 'Articles';
$isTagsActive  = $currentController === 'Tags';
$isUsersActive  = $currentController === 'Users';
$isSettingsActive  = $currentController === 'Admin' && $currentAction === 'settings';
?>

<nav class="menu">
    <ul class="sidebar-menu metismenu" id="sidebar-menu">
        <li class="<?= $isDashboardActive ? 'active' : '' ?>">
            <?= $this->Html->link(
                '<i class="fa fa-home"></i> Dashboard',
                ['controller' => 'staff'],
                ['escape' => false]
            ) ?>
        </li>

        <li class="<?= $isTagsActive ? 'active' : '' ?>">
            <?= $this->Html->link(
                '<i class="fa fa-tag"></i> Tags',
                ['controller' => 'users','action' => 'studentdash'],
                ['escape' => false]
            ) ?>
        </li>
        <li class="<?= $isUsersActive ? 'active open' : '' ?>">
            <?= $this->Html->link(
                '<i class="fa fa-user"></i> Users <i class="fa arrow"></i>',
                ['controller' => 'users'],
                ['escape' => false]
            ) ?>
            <ul class="sidebar-nav">
                <li><?= $this->Html->link('View users', ['controller' => 'users']) ?></li>
                <li><?= $this->Html->link('Add new user', ['controller' => 'users', 'action' => 'add']) ?></li>
            </ul>
        </li>

    </ul>
</nav>
