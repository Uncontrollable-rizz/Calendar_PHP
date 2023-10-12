<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
         table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
            width: 50px;
            height: 50px;
            box-sizing: border-box;
        }

        strong {
            font-weight: bold;
        }

        button {
            display: inline-block;
            width: 200px;
            margin: 20px 10px;
            font-size: 20px;
            padding: 10px;
        }
        div{
            text-align:center
        }
    </style>
</head>
<body>
    <?php
    if (isset($_POST['currentMonth'])) {
        $currentMonth = $_POST['currentMonth'];
    } else {
        $currentMonth = date('n');
    }
    
    if (isset($_POST['currentYear'])) {
        $currentYear = $_POST['currentYear'];
    } else {
        $currentYear = date('Y');
    }
    

    if (isset($_POST['previousButton'])) {
        $currentMonth--;
        if ($currentMonth == 0) {
            $currentMonth = 12;
            $currentYear--;
        }
    } elseif (isset($_POST['nextButton'])) {
        $currentMonth++;
        if ($currentMonth == 13) {
            $currentMonth = 1;
            $currentYear++;
        }
    } elseif (isset($_POST['todayButton'])) {
        $currentMonth = date('n');
        $currentYear = date('Y');
    }

    $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    $firstDayOfMonth = date('w', strtotime("$currentYear-$currentMonth-01"));
    $dayCount = 1;
    ?>

    <form method="post" action="">
        <table>
            <tr>
                <th colspan="7" name="year_and_date"><?php echo date('F Y', strtotime("$currentYear-$currentMonth-01")); ?></th>
            </tr>
            <tr>
                <td><strong>S</strong></td>
                <td><strong>M</strong></td>
                <td><strong>T</strong></td>
                <td><strong>W</strong></td>
                <td><strong>Th</strong></td>
                <td><strong>F</strong></td>
                <td><strong>Sa</strong></td>
            </tr>
            <?php
            for ($i = 0; $i < 6; $i++) {
                echo '<tr>';

                for ($j = 0; $j < 7; $j++) {
                    if ($i == 0 && $j < $firstDayOfMonth) {
                        echo '<td></td>';
                    } else {
                        if ($dayCount <= $numDaysInMonth) {
                            echo "<td>$dayCount</td>";
                            $dayCount++;
                        } else {
                            echo '<td></td>';
                        }
                    }
                }

                echo '</tr>';
            }
            ?>
        </table>
        <div id="container">
            <input type="hidden" name="currentMonth" value="<?php echo $currentMonth; ?>">
            <input type="hidden" name="currentYear" value="<?php echo $currentYear; ?>">
            <button type="submit" name="previousButton">Previous</button>
            <button type="submit" name="nextButton">Next</button>
            <button type="submit" name="todayButton">Today</button>
        </div>
    </form>
</body>
</html>
