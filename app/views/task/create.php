<form action="/task/store" method="post">
    <div class="form-group">
        <label for="name">Name *</label>
        <input type="text" class="form-control <?php if(isset($_SESSION['errors']['name'])) { echo 'is-invalid'; }?>" name="name" id="name">
        <?php if(isset($_SESSION['errors']['name'])) { ?>
        <div class="invalid-feedback">
            <?= implode('<br>', $_SESSION['errors']['name']); ?>
        </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" class="form-control <?php if(isset($_SESSION['errors']['email'])) { echo 'is-invalid'; }?>" name="email" id="email">
        <?php if(isset($_SESSION['errors']['email'])) { ?>
            <div class="invalid-feedback">
                <?= implode('<br>', $_SESSION['errors']['email']); ?>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="task">Task *</label>
        <textarea class="form-control <?php if(isset($_SESSION['errors']['task'])) { echo 'is-invalid'; }?>" name="task" id="task" cols="30" rows="10"></textarea>
        <?php if(isset($_SESSION['errors']['task'])) { ?>
            <div class="invalid-feedback">
                <?= implode('<br>', $_SESSION['errors']['task']); ?>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>