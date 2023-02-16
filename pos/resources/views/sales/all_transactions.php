
<div class="box transaction-div">
<h1 class="table-title py-5 text-center">All Transactions List (<?= $data->transaction_count ?>)</h1>
    <table class="table ">
    
        <thead>
        
            <tr>
                 
                <th scope="col" class="text-center Item-id ">Item id</th>
                <th scope="col"class="text-center">Item Name</th>
                <th scope="col"class="text-center">Quantity</th>
                <th scope="col"class="text-center">Total</th>
                <th scope="col"class="text-center created-at">Created at</th>
                <th scope="col"class="text-center updated-at">Updated at</th>
                <th scope="col" class="text-center">Check Transaction</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->transactions as $transaction) :
                ?>
                <tr>
                    <td class="text-center Item-id"><?= $transaction->items_id ?></td>
                    <td class="text-center"><?= $transaction->item_name ?></td>
                    <td class="text-center"><?= $transaction->quantity ?></td>
                    <td class="text-center"><?= $transaction->total ?></td>
                    <td class="text-center created-at"><?= $transaction->created_at ?></td>
                    <td class="text-center updated-at"><?= $transaction->updated_at ?></td>
                    <td class="text-center"><a href="/sales/single?id=<?= $transaction->id ?>" class="btn btn-info"><i class="fa-solid fa-receipt" ></i></a>
                    
                
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>
