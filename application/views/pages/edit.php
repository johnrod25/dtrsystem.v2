<?php if($this->session->flashdata('post_updated')): ?>
<?= '<p class="alert alert-success">' . $this->session->flashdata('post_updated' ).'</p>'; ?>
<?php endif; ?>


<h1><?=$title;?></h1>
<?= validation_errors(); ?>
<div class="row">
<?php foreach($posts as $row){?>
    <?= form_open('edit/'.$row['id']); ?>
    <div class="col-lg-12">
        <div class="form-group mb-3">
            <input type="text" name="title" placeholder="Enter post title" class="form-control" value="<?= $row['title']; ?>">
        </div>
        <div class="form-group">
            <input type="hidden" name="id" class="form-control" value="<?= $row['id']; ?>">
        </div>
        <div class="form-group">
            <textarea name="body" placeholder="Enter post body" id="" cols="30" rows="10" class="form-control"><?= $row['body']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </div>
    <?php } ?>
</div>
