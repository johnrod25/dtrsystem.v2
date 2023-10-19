<?php if($this->session->flashdata('loggedin')): ?>
<?= '<p class="alert alert-success">' . $this->session->flashdata('loggedin' ).'</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('post_added')): ?>
<?= '<p class="alert alert-success">' . $this->session->flashdata('post_added' ).'</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('post_deleted')): ?>
<?= '<p class="alert alert-success">' . $this->session->flashdata('post_deleted' ).'</p>'; ?>
<?php endif; ?>
<h1><?=$title;?></h1>

<ul class="list-group">
    <?php foreach($posts as $row){?>
        <a class="list-group-item list-group-item-action" href="<?=base_url(); ?><?= $row['slug']; ?>"><?= $row['title'];?></a>
    <?php } ?>
</ul>

<div class="alert alert-secondary mt-3" role="alert">
    Total post is <?= $total; ?>.
</div>