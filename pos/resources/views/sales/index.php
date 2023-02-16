<div class="row d-flex box p-1 transaction-container">


  

    <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>

<div class='alert alert-danger container w-50 text-center' role='alert'>
    <?= $_SESSION['error'] ?>
</div>
<?php

    $_SESSION['error'] = null;

    endif; ?>
  
   

    <div id="dataTableContainer">
        <h2 class="text-center m-auto m-5">Users</h2>
        <hr>

        <table class="table w-75 m-auto" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center tranaction-id">Username</th>
                    <th scope="col" class="text-center item-id"> E-mail</th>
                    <th scope="col" class="text-center item-id"> status</th>
                    <th scope="col" class="text-center unit-price"> Edit</th>
                    <th scope="col" class="text-center unit-price"> Delete</th>
                </tr>
            </thead>
            <tbody id="transaction">

            </tbody>
        </table>

    </div>
</div>