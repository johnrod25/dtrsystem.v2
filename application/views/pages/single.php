
<?php foreach($posts as $row){?>
    <h1><?= $row['title'];?></h1>
    <hr>
    <p><?=$row['body'];?></p>
    <br>
    <p>Date published : <?= $row['date_published'];?></p>

    <?php if($this->session->logged_in == true && $this->session->access == 1) { ?>
    <div class="btn-group">
        <a href="edit/<?= $row['id']; ?>" class="btn btn-primary mr-3">Edit</a>
        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button>
    </div>
<?php }?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
                <?= form_open('delete'); ?>
                <h2>Are you sure you want to delete? </h2>
                <input type="hidden" value="<?= $row['id']; ?>" name="modal-id">
        </div>
        <div class="modal-footer">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        </div>
    </div>
    </div>
<?php } ?>