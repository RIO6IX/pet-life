<?php
    session_start();
    require 'connect_dbshop.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=../dashboard.php">
    <title>Document</title>
</head>
<body>
    <?php
        $manager_id = $_SESSION['userid'];
        $current_date = date('Y-m-d');

        $get_metrics_query = "select * from metrics";
        $results = $conn->query($get_metrics_query);

// credit: https://youtu.be/Wv36vOmJKuI

        if ($results->num_rows > 0) {
            $rev_report = fopen("../reports/rev_report-".$current_date.".txt", "w");
            $usr_report = fopen("../reports/usr_report-".$current_date.".txt", "w");

            while ($row = $results->fetch_assoc()) {
                // rev_report
                fwrite($rev_report, "Manager ID  : ".$manager_id."\n");
                fwrite($rev_report, "Date-Time : ".$row['start_date']."\n");
                fwrite($rev_report, "Revenue     : ".$row['revenue']."\n");
                fwrite($rev_report, "=========================================================\n\n");

                // usr_report
                fwrite($usr_report, "Manager ID  : ".$manager_id."\n");
                fwrite($usr_report, "Date-Time : ".$row['start_date']."\n");
                fwrite($usr_report, "User Traffic     : ".$row['user_traffic']."\n");
                fwrite($usr_report, "=========================================================\n\n");
            }

            fclose($rev_report);
            fclose($usr_report);

            $report_rev_record = "insert into report(report_type, report_date, metric_id, manager_id) values('rev_report', '$current_date', 1, $manager_id)";
            $report_usr_record = "insert into report(report_type, report_date, metric_id, manager_id) values('usr_report', '$current_date', 2, $manager_id)";
            
            $conn->query($report_rev_record);
            $conn->query($report_usr_record);

            $conn->close();

            echo "<h1>Reports generated successfully</h1>";
        } else {
            echo "<h1>Insufficient Data</h1>";
        }
    ?>
</body>
</html>