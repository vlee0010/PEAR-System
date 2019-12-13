<?php
namespace App\Http\Controllers;

use App\Model\Entity\Email;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
?>
<h1 align="center">Email successfully sent to students</h1>
<h2 align="center">Click the following button to go back</h2>
<div align="center">
    <button class="btn btn-default"><?= $this->Html->link(__('Back'), $this->request->referer()) ?></button>
</div>

