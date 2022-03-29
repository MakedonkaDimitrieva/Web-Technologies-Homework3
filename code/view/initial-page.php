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
            <legend>LOG IN</legend>
            <form action="<?= BASE_URL . "login" ?>" method="post">
                <p><input name="username" type="text" placeholder="Username" autocomplete="off" required/></p>
                <p><input name="password" type="password" placeholder="Password" autocomplete="off" required/></p>
                <p><button>Log in</button></p>
            </form>
        </fieldset>

        </br>

        <fieldset>
            <legend>SEARCH FLIGHT</legend>
            <input id="search" name="search" type="text" placeholder="Search flight.." onkeyup="search()"/>
        </fieldset>

        </br>

        <fieldset>
            <legend> SORT BY PRICE </legend>
            <button onclick="increasing()">Increasing</button>
            <button onclick="decreasing()">Decreasing</button>
        </fieldset>

        </br>

        <fieldset>
            <legend>REGISTRATION</legend>
            <form action="<?= BASE_URL . "registerUser" ?>" method="post">
                <p><input name="username" type="text" value="" placeholder="Username" autocomplete="off" required /></p>
                <p><input name="password" type="password" value="" placeholder="Password" autocomplete="off" required /></p>
                <p><input name="name" type="text" value="" placeholder="Name" autocomplete="off" required /></label></p>
                <p><input name="lastname" type="text" value="" placeholder="Lastname" autocomplete="off" required /></label></p>
                <p><button>Register</button></p>
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
            </tr>
            <?php endforeach; ?>
        </table>

    </article>

    <footer class="col-12 col-t-12 col-m-12">
        <p>Travel across Europe</p>
    </footer>

</body>