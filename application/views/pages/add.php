<h1><?=$title;?></h1>
<?= validation_errors(); ?>
<div class="row">
    <!-- <form action="<?=base_url('create');?>" method="post" enctype="multipart/form-data"> -->
    <?= form_open('add'); ?>
    <div class="col-lg-12">
        <div class="form-group mb-3">
            <input type="text" name="title" placeholder="Enter post title" class="form-control" value="<?= set_value('title'); ?>">
        </div>
        <div class="form-group">
            <textarea name="body" placeholder="Enter post body" id="" cols="30" rows="10" class="form-control" value="<?= set_value('body'); ?>"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </div>
</div>
