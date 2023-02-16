<div class="box p-5">
<h1 class="table-title">Edit Item</h1>
<div class="row edit-item">
    <form action="/items/update" method="POST" class=" col-xl-6 col-md-6 col-sm-12 col-xs-12" enctype="multipart/form-data">
        <input type="hidden" id="item-procurement" name="total_procurement">
        <input type="hidden" name="id" value="<?= $data->item->id ?>" required>
        <div class="mb-3">
            <label for="item-name" class="form-label">Item Name</label>
            <input type="text" class="form-control " id="item-name" name="item_name"
                value="<?= $data->item->item_name ?>"required>
        </div>
        <div class="mb-3">
            <label for="item-quantity" class="form-label">Quantity Of Item</label>
            <input type="number" class="form-control" id="item-quantity" name="quantity" min="0" step="any"
                value="<?= $data->item->quantity ?>" required>
        </div>
        <div class="mb-3">
            <label for="item-cost" class="form-label">Cost Of Item</label>
            <input type="number" class="form-control" id="item-cost" name="cost" min="0" step="any"
                value="<?= $data->item->cost ?>"required>
        </div>
        <div class="mb-3">
            <label for="item-selling-price" class="form-label">Selling Price Of Item</label>
            <input type="number" class="form-control" id="item-selling-price" name="selling_price" min="0" step="any"
                value="<?= $data->item->selling_price ?>"required>
        </div>
        <button type="submit" class="btn btn-outline-success mt-4">Update</button>
    </form>

    <form action="/items/image" method="POST" class="col-xl-6 col-md-6 col-sm-12 col-xs-12" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data->item->id ?>">
        <div class="mb-3">
            <label for="item-image" class="form-label">Image Of Item</label>
            <input type="file" class="form-control" id="item-image" name="image"required>
        </div>

        <button type="submit" class="btn btn-outline-success mt-4">Update</button>
    </form>
</div>
</div>