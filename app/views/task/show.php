
<div class="task">
    <div class="task-info">
        <p><b>User:</b> <?= $task->name; ?></p>
        <p><b>Email:</b> <?= $task->email; ?></p>
        <p><b>Status:</b>
            <?php if($task->status) { ?>
                <span class="badge badge-success">Done</span>
            <?php } else { ?>
                <span class="badge badge-danger">Active</span>
            <?php } ?></p>
    </div>
    <div class="task-desc">
        <p><b>Task:</b> <?= $task->task; ?></p>
    </div>
</div>
