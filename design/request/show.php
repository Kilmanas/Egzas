<?php $message = $this->data['message']; ?>

<li><?= $message->getName(); ?></li>
<li><?= $message->getLastName(); ?></li>
<li><?= $message->email(); ?></li>
<li><?= $message->getPhone(); ?></li>
<li><?= $message->getSubject(); ?></li>
<li><?= $message->getMessage(); ?></li>

<a href="<?= $this->url('request/delete', $message->getId()) ?>">Delete</a>
