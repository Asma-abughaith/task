<?php

use Core\Helpers\Helper;
?>
<div class="  box p-1 pe-5 ps-5 ">
<div class="mt-5 d-flex flex-row-reverse gap-3">
    <?php if (Helper::check_permission(['transaction:read', 'transaction:update'])) : ?>
        <a href="/sales/edit?id=<?= $data->transaction->id ?>" class="btn btn-warning">Edit</a>
    <?php endif;
        if (Helper::check_permission(['transaction:read', 'transaction:update'])) :
     ?>
        <a href="/sales/delete?id=<?= $data->transaction->id ?>" class="btn btn-danger">Delete</a>
    <?php endif; ?> 
</div>

<div class="my-5">
   
    <h1 class="text-center item_title pt-0">
        <strong>Transaction id:&nbsp;</strong><?= $data->transaction->id ?>
    </h1>
    <p class="item_description">
    <strong>Item Name:&nbsp;</strong><?= $data->transaction->item_name ?>
    </p>
    <p class="item_description">
    <strong>Price:&nbsp;</strong><?= $data->transaction->price ?>JOD
    </p>
    <p class="item_description">
    <strong>Quantity:&nbsp;</strong><?= $data->transaction->quantity?>
    </p>
    <p class="item_description">
    <strong>Total:&nbsp;</strong><?= $data->transaction->total?>JOD
    </p>
    <p class="item_description">
    <strong>Created at:&nbsp;</strong><?= $data->transaction->created_at?>
    </p>
    <p class="item_description">
    <strong>Updated at:&nbsp;</strong><?= $data->transaction->updated_at?>
    </p>
</div>
</div>