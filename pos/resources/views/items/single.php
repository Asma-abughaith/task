<?php

use Core\Helpers\Helper;
?>
<div class="single-item w-100 m-auto">
<div class="mt-5 d-flex flex-row-reverse gap-3">
    <?php if (Helper::check_permission(['item:read', 'item:update'])) : ?>
        <a href="/items/edit?id=<?= $data->item->id ?>" class="btn btn-warning">Edit</a>
    <?php endif;
    if (Helper::check_permission(['item:read', 'item:delete'])) :
     ?>
        <a href="/items/delete?id=<?= $data->item->id ?>" class="btn btn-danger">Delete</a>
    <?php endif; ?> 
</div>

<div class="my-5 row ">
    <div class="col-xl-4 col-md-5 col-sm-5 col-xs-5">
    <img src="./resources/image/<?=$data->item->image?>" alt="" width='100%' class="mt-3 m-auto">
    </div>
    <div class="col-xl-8 col-md-7 col-sm-7 col-xs-7 p-2 ps-5">
    <h1 class="text-center table-title pe-5 pb-4">
        <?= $data->item->item_name ?>
    </h1>

    <p class="item_description">
        <strong>Selling Price:</strong>&nbsp;<?= $data->item->selling_price ?>JOD
    </p>
    <p class="item_description">
    <strong></i>Cost:</strong>&nbsp;<?= $data->item->cost ?>JOD
    </p>
    <p class="item_description">
    <strong>Stock Available Quantity:</strong>&nbsp;<?= $data->item->quantity ?>
    </p>
    
    </div>
</div>
</div>