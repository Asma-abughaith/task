<div class="m-auto ms-2 ">
    <h1 class="d-flex justify-content-around item_title "> All Items (<?= $data->items_count ?>)</h1>
    <div class>
        <div class="row my-5 m-auto d-flex justify-content-center">
            <?php foreach ($data->items as $item) : ?>
            <div  class="card box m-1 mb-4 col-lg-2 col-md-3 col-sm-4 col-xs-12 " >
                <?php if(isset($item->image)&&!empty($item->image)):?>
                <img id="card_single" src="./resources/image/<?=$item->image?>" alt="" width='60%' class="mt-3 m-auto">
                <?php endif; ?>
                <div class="card-body">

                    <h5 class="card-title text-center"> <?= $item->item_name ?></h5>
                    <div class="d-flex justify-content-center align-items-center">
                        <a  href="./item?id=<?= $item->id ?>" class="btn btn-outline-primary pt-1 pb-1">Check Item</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
</div>