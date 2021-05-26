<?php

session_start();

$userincome = ["salary" => $_POST["salary"], "monthly/yearly" => $_POST['monthly/yearly'], "taxfreeallowance" => $_POST["taxfreeallowance"]];
function taxcalculation($salary)
{

    if ($salary > 10000 && $salary <= 25000) {
        $user_tax = $salary* 0.11;
    } elseif ($salary > 25000 && $salary <= 50000) {
        $user_tax = $salary* 0.3;
    } elseif ($salary > 50000) {
        $user_tax = $salary* 0.45;
    }

    return $user_tax;
}
function salaryaftertax($salary, $taxfreeallowance)
{
    $salaryaftertax = $salary - taxcalculation($salary) - socialsecurityfee($salary) + $taxfreeallowance;
    return $salaryaftertax;
}
function socialsecurityfee($salary)
{
    if ($salary > 10000) {
        $sfee = $salary * 0.04;
    }

    return $sfee;
}
$_SESSION["userincome"] = $userincome;
if ($_POST['monthly/yearly'] == 'monthly') {
    $monthlysalary= $_SESSION["userincome"]['salary'];
    $monthlytax= round(taxcalculation($monthlysalary));
    $monthlysocialsecurityfee= round(socialsecurityfee($monthlysalary));
    $monthlytaxfreeallowance = $_SESSION['userincome']["taxfreeallowance"]/12;
    $monthlysalaryaftertax= round(salaryaftertax($monthlysalary, $monthlytaxfreeallowance));
    

}else{
    $yearlysalary = $_SESSION["userincome"]['salary'];
    $yearlytax = round(taxcalculation($yearlysalary));
    $yearlysocialsecurityfee= round(socialsecurityfee($yearlysalary));
    $yearlysalaryaftertax= round(salaryaftertax($yearlysalary, $_SESSION['userincome']["taxfreeallowance"]));
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Income Tax Calculator</title>
</head>
<body>
<div class="content">
<h2>Income Tax Calculator</h2>
<form action="incometaxcalculator.php" method="POST">
<div class = "container">
<label for = "salary">salary in USD:</label>
<input type= "number" name ="salary" id ="salary" required value=<?php echo $_SESSION["userincome"]["salary"]; ?>>
<label for = "taxfreeallowance">Tax Free Allowance in USD:</label>
<input type= "number" name ="taxfreeallowance" id="taxfreeallowance" required value=<?php echo $_SESSION["userincome"]["taxfreeallowance"]; ?>>
<div class="r-btn">
<?php
if ($_SESSION["userincome"]["monthly/yearly"] == "monthly") {
    echo "<input type='radio' name='monthly/yearly' id='monthly' value='monthly'checked>
    <label for='monthly'>Monthly</label>";
    echo "<input id='yearly' type='radio' name='monthly/yearly' value='yearly'required>
    <label for='yearly'>Yearly</label>";
}else{
    echo "<input type='radio' name='monthly/yearly' id='monthly' value='monthly' >
    <label for='monthly'>Monthly</label>";
    echo "<input type='radio' name='monthly/yearly' id='yearly' value='yearly'checked required>
    <label for='yearly'>Yearly</label>";
}
?>
</div>
<button class = "submit" type="submit" name="submit">calculate</button>
</form>
</div>
<br><br>
<div class ="table">
<table>
<tr>
<th>Monthly/yearly</th>
<th>Monthly</th>
<th>Yearly</th>
</tr>
<tr>
<td>Total Salary </td>
<td><?php echo $monthlysalary; ?></td>
<td><?php echo $yearlysalary; ?></td>
</tr>
<tr>
<td>Tax amount</td>
<td><?php echo $monthlytax; ?></td>
<td><?php echo $yearlytax; ?></td>
</tr>
<tr>
<td>Social security fee</td>
<td><?php echo $monthlysocialsecurityfee; ?></td>
<td><?php echo $yearlysocialsecurityfee; ?></td>
</tr>
<tr>
<td>Salary after tax</td>
<td><?php echo $monthlysalaryaftertax; ?></td>
<td><?php echo $yearlysalaryaftertax; ?></td>
</tr>
</table>
</div>
</body>
</html>