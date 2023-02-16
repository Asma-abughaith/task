<div class="">


<form action="/sales/update" method="POST" class="col-xl-6 col-md-12 col-sm-12 col-xs-12 box p-5 m-auto" >
<h1>Edit transaction</h1>
<input type="hidden" name="id" value="<?= $data->transaction->id ?>">
    <div class="mb-3">
        <label for="transaction-name" class="form-label">transaction Name</label>
        <input type="text" class="form-control" id="transaction-name" name="item_name" value="<?= $data->transaction->item_name ?>"required>
    </div>
    <div class="mb-3">
        <label for="transaction-quantity" class="form-label">Quantity Of transaction</label>
        <input type="number" class="form-control" id="transaction-quantity" name="quantity" min="0" step="any" value="<?= $data->transaction->quantity ?>"required>
    </div>
    <div class="mb-3">
        <label for="transaction-cost" class="form-label">Price Of The Item</label>
        <input type="number" class="form-control" id="transaction-cost" name="price" min="0" step="any" value="<?= $data->transaction->price ?>"required>
    </div>
    <div class="mb-3">
        <label for="transaction-selling-price" class="form-label">total</label>
        <input type="number" class="form-control" id="transaction-selling-price" name="total" min="0" step="any" value="<?= $data->transaction->total ?>"required>
    </div>
    
    <button type="submit" class="btn btn-outline-success mt-4">update</button>
</form>
</div>