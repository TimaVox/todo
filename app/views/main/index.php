
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">
                User
                <a href="?sort=user&dir=desc">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </a>
                <a href="?sort=user&dir=asc">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
            </th>
            <th scope="col">
                Email
                <a href="?sort=email&dir=desc">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </a>
                <a href="?sort=email&dir=asc">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
            </th>
            <th scope="col">
                Status
                <a href="?sort=status&dir=desc">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </a>
                <a href="?sort=status&dir=asc">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
            </th>
            <?php if(\App\models\User::checkAuth()) { ?>
            <th scope="col"></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $task) { ?>
        <tr>
            <th scope="row"><?= $task->id ?></th>
            <td><a href="task/<?=$task->id?>"><?= $task->name ?></a></td>
            <td><a href="task/<?=$task->id?>"><?= $task->email ?></a></td>
            <td>
                <?php if($task->status) { ?>
                    <span class="badge badge-success">Done</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Active</span>
                <?php } ?>
            </td>
            <?php if(\App\models\User::checkAuth()) { ?>
            <td>
                <a href="/task/edit/<?=$task->id?>">Edit</a>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php if($pagination->getCountPages() > 1) { ?>
    <?php echo $pagination; ?>
<?php }?>
