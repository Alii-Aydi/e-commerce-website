<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header('Location: error.php');
    exit;
}
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';
?>
<style>
    .add {
        margin-left: 300px;
    }

    body {
        max-width: calc(100vw - 2em);
    }

    .boxes {
        display: flex;
        justify-content: space-between;
    }

    .box {
        text-align: center;
        border: 1px solid white;
        padding: 30px 70px;
        border-radius: 2em;
        background: linear-gradient(to bottom right, #007bff, #5bc0de);
        font-size: 1.5rem;
    }

    .chart {
        margin: auto;
        width: 80%;
    }

    canvas#myChart {
        height: 400px;
    }
</style>
<main>
    <?php include("pannel.php") ?>
    <div class="add pt-3 pb-3">
        <div class="row">
            <div class="text-light col-10 offset-1">
                <div class="boxes">
                    <?php
                    include("commande.php");
                    include("ligneCommande.php");
                    ?>
                    <div class="box"><?php echo Commande::getOrders(); ?><br>Commandes</div>
                    <div class="box">$<?php echo LigneCommande::SommeAchats(); ?><br>Ventes</div>
                    <div class="box"><?php echo Commande::getNonShipped(); ?><br>Non delevres</div>
                </div>
            </div>
            <div class="chart mt-5">
                <div class="">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const now = new Date();
    const daysInMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();

    const labels = [];
    for (let i = 1; i <= daysInMonth; i++) {
        const date = new Date(now.getFullYear(), now.getMonth(), i);
        const label = date.toLocaleDateString('en-US', {
            month: '2-digit',
            day: '2-digit'
        });
        labels.push(label);
    }

    const getChartData = async () => {
        try {
            const response = await fetch('getDates.php');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error(error);
        }
    }

    const build = async () => {
        const data = await getChartData();

        // Build array of order counts for each day
        const orderCounts = [];
        for (let i = 1; i <= daysInMonth; i++) {
            const date = new Date(now.getFullYear(), now.getMonth(), i);
            const dateString = date.toISOString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            }).substr(0, 10)

            console.log(dateString, data)
            const count = data[dateString] || 0; // Use count from data or 0 if not available
            orderCounts.push(count);
        }

        console.log(orderCounts)

        // Create the chart
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Commandes ce mois',
                    data: orderCounts,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        stepSize: 1
                    }
                }
            }
        });
    }

    build()
</script>