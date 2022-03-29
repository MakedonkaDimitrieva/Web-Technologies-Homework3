<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Europe Airlines</title>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?= CSS_URL . "script.js" ?>"></script>
</head>
<body>
    <header class="col-12 col-t-12 col-m-12">
        <h1>Welcome to EuropeAirlines</h1>
    </header>
    
    <aside class="col-2 col-t-3 col-m-12">

        <fieldset>
            <legend>USER</legend>
            <p><?=strtolower($_SESSION["username"])?><a href="<?= BASE_URL . "welcome"?>">(Log out)</a></p>
            </form>
        </fieldset>

        </br>

        <fildset>
            <legend>SEARCH FLIGHT</legend>
            <input id="search" name="search" type="text" placeholder="Search flight.." onkeyup="search()"/>
        </fildset>

        </br>

        <fieldset>
            <legend> SORT BY PRICE </legend>
            <button onclick="increasing()">Increasing</button>
            <button onclick="decreasing()">Decreasing</button>
        </fieldset>

        </br>

        <fieldset>
            <legend>ADD FLIGHT</legend>
            <form action="<?= BASE_URL . "add-flight" ?>" method="post">
                <p><input name="flightID" type="text"  value="" placeholder="Flight ID" autocomplete="off" required /></p>
                <p><input name="departure" type="text"  value="" placeholder="Departure" autocomplete="off" required /></p>
                <p><input name="destination" type="text"  value="" placeholder="Destination" autocomplete="off" required /></p>
                <p><input name="departure_date" type="text"  value="" placeholder="Date" autocomplete="off" required /></p>
                <p><input name="class" type="text"  value="" placeholder="Class" autocomplete="off" required /></p>
                <p><input name="company" type="text"  value="" placeholder="Company" autocomplete="off" required /></p>
                <p><input name="price" type="number"  value="" placeholder="Price" autocomplete="off" required /></p>
                <p><button>ADD</button></p>
            </form>
        </fieldset>

    </aside>

    <article class="col-10 col-t-9 col-m-12">

        <h2>Choose your next destination!</h2>

        <table id="table">
            <tr>
                <th>Code</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Departure date</th>
                <th>Class</th>
                <th>Company</th>
                <th>Price</th>
                <th>Cancel</th>
            </tr>
            <?php foreach ($flight as $flight): ?>
            <tr>
                <td><?= $flight["flightID"] ?></td>
                <td><?= $flight["departure"] ?></td>
                <td><?= $flight["destination"] ?></td>
                <td><?= $flight["departure_date"] ?></td>
                <td><?= $flight["class"] ?></td>
                <td><?= $flight["company"] ?></td>
                <td><?= $flight["price"] ?></td>
                <td>
                    <form action="<?= BASE_URL . "removeFlight" ?>" method="post">
                        <input type="hidden" name="flightID" value=<?= $flight["flightID"] ?> />
                        <?php echo "<p><button>Cancel flight</button></p>"; ?>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </article>

    <footer class="col-12 col-t-12 col-m-12">
        <p>Travel across Europe</p>
    </footer>

</body>