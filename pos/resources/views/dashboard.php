
<div class=" container d-flex justify-content-start flex-wrap admin-content-divs ">
    <!-- <a href="/sales/all_transactions" class="btn btn-warning fram me-2 col pt-4 " ><div>Profits</div><div><?= $data->profits?> &nbsp;JOD</div> </a> -->
    <div class="fram fram-2  "><i class="fa-sharp fa-solid fa-fire me-2 color"></i>Profits
        <div><?= $data->profite?>&nbsp;JOD</div>
    </div>
    <div class="fram fram-1 "><i class="fa-solid fa-money-bill-wave fa-1x me-2 color"></i>Total Sales
        <div><?= $data->total?>&nbsp;JOD</div>
    </div>
    <div class="fram fram-4 "><i class="fa-sharp fa-solid fa-bag-shopping fa-1x me-2 color"></i>Total Procurement
        <div><?= $data->procurement?>&nbsp;JOD</div>
    </div>
    <div class="fram fram-2 "><i class="fa-solid fa-money-bill  fa-1x me-2 color"></i>Total Transactions
        <div><?= $data->total_transactions?></div>
    </div>
    <div class="fram fram-5 "><i class="fa-solid fa-users  fa-1x me-2 color"></i>Total Users
        <div><?= $data->total_users?></div>
    </div>
    <div class="fram fram-3 "><i class="fa-sharp fa-solid fa-bag-shopping fa-1x me-2 color"></i>Total Items
        <div><?= $data->total_items?></div>
    </div>
  

    <!-- <a href="/sales/all_transactions" class="btn btn-primary fram fram-1  ms-2  col" ><div>Total Expenses</div><div><?= $data->cost?>&nbsp;JOD</div> </a> -->
</div>


<div class=" container row my-5 w-100 ">
    <div class="col-xl-6 col-sm-12 cl-md-12 cl-xs-12">
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->



        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <canvas id="myChart" style="width:100%;max-width:400px"></canvas>

        <script>
        var xValues = <?php echo json_encode($data->days) ?>;
        var yValues = <?php echo json_encode($data->num_transactions) ?>;
        var barColors = ["#FB2576", "#B9FFF8", "#F5827D", "#FFBF00","#10A19D" ];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Number Of Transaction During Five Days"
                }
            }
        });
        </script>


        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
    </div>

    <div class="col-xl-6 col-sm-12 cl-md-12 cl-xs-12">
        <h3 class="d-flex justify-content-around p-2 pe-2 ps-2 table-title">Top Five Expensive Items To Buy</h3>

        <div class="row">
            <table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th class="bg-info text-center border border-light ">#</th>
                        <th scope="col" class=" bg-info text-center border border-light ">Item Name</th>
                        <th scope="col" class="bg-info text-center border border-light ">price (JOD)</th>
                        <th scope="col" class="bg-info text-center border border-light ">check</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
            $counter=1;
            foreach ($data->top_five as $item) : ?>
                    <tr>
                        <td class=" text-center border border-light"><?=$counter?></td>
                        <td class=" border border-light"><?= $item->item_name ?></td>
                        <td class=" text-center border border-light"><?= $item->selling_price ?></td>
                        <td class=" text-center border border-light"><a href="./item?id=<?= $item->id ?>"
                                class="btn btn-outline-success">Check item</a></td>
                    </tr>

                    <?php $counter++;
            endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>


</div>
</div>
<div class="m-4">
    <canvas id="myChart1" style="width:100%"class="m-auto pe-0 w-100"></canvas>
</div>
<script>
var xValues = <?php echo json_encode($data->days) ?>;
var yValues = <?php echo json_encode($data->profits_5) ?>;
var barColors = ["#319DA0", "#319DA0", "#319DA0", "#319DA0", "#319DA0"];

new Chart("myChart1", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Profits During Five Days in (JOD)"
        }
    }
});
</script>