<?php foreach ($this->data['messages'] as $message): ?>
    <div class="box">
        <a href="<?php echo $this->url('request/show', $message->getId()) ?>">
                <?php echo $message->getSubject(); ?></a>

            <?php echo $message->getName()." ".$message->getLastName(); ?>
    </div>

<?php endforeach; ?>
