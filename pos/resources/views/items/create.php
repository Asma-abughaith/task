<div class=" ">


<form action="/items/store" method="POST" class="col-xl-6 col-md-12 col-sm-12 col-xs-12 box p-4 m-auto" enctype="multipart/form-data">
<h1 class="table-title m-2">Create Item</h1>
<input type="hidden"  id="item-procurement" name="total_procurement" >
    <div class="mb-3">
        <label for="item-name" class="form-label">Item Name</label>
        <input type="text" class="form-control" id="item-name" name="item_name" required>
    </div>
    <div class="mb-3">
        <label for="item-quantity" class="form-label">Quantity Of Item</label>
        <input type="number" class="form-control" id="item-quantity" name="quantity" min="0" step="any" required>
    </div>
    <div class="mb-3">
        <label for="item-cost" class="form-label">Cost Of Item</label>
        <input type="number" class="form-control" id="item-cost" name="cost" min="0" step="any" required>
    </div>
    <div class="mb-3">
        <label for="item-selling-price" class="form-label">Selling Price Of Item</label>
        <input type="number" class="form-control" id="item-selling-price" name="selling_price" min="0" step="any" required>
    </div>
    <div class="mb-3">
        <label for="item-image" class="form-label">Image Of Item</label>
        <input type="file" class="form-control" id="item-image" name="image"  >
    </div>
    
    
    <button type="submit" class="btn btn-outline-success mt-4">Create</button>
</form>
</div>