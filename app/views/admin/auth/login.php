<div class="row justify-content-center">
    <div class="col-4">
        <form action="/authenticate" method="post">
            <div class="form-group">
                <label for="name">Login</label>
                <input type="text" class="form-control <?php if(isset($_SESSION['errors']['login'])) { echo 'is-invalid'; }?>" name="login" id="login">
                <?php if(isset($_SESSION['errors']['login'])) { ?>
                    <div class="invalid-feedback">
                        <?= $_SESSION['errors']['login']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
