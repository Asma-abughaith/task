<div class="box p-4 pb-5">
    <h1 class="d-flex justify-content-around p-2 pe-2 ps-2 table-title pb-4">Users List (<?= $data->users_count ?>)</h1>

    <div class="row">
        <table class="table table-bordered table-striped w-75 m-auto ">
            <thead>
                <tr>
                    <th class="bg-info text-center border border-light item_description ">#</th>
                    <th class="bg-info text-center border border-light item_description ">Display Name</th>
                    <th class="bg-info text-center border border-light item_description ">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $counter=1;
             foreach ($data->users as $user) : ?>
                <tr>
                    <td class=" text-center border border-light item_description"><?=$counter?></td>
                    <td class=" ps-5 border border-light item_description"><?= $user->display_name ?></td>
                    <td class=" text-center border border-light item_description"><a href="./user?id=<?= $user->id ?>"
                            class="btn btn-outline-primary">Check User</a></td>
                </tr>
                <?php $counter++; endforeach; ?>

            </tbody>
        </table>

    </div>
</div>