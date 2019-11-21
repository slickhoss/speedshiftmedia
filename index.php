<?php 
    include 'functions.php';

    $host = 'localhost';
    $username = 'sudo';
    $password = '12345';
    $database = 'speedshiftmedia';
    $link = mysqli_connect($host, $username, $password, $database);

    $employees = getEmployees($link);
    if(count($_POST) > 0)
    {
        if(!checkInput($_POST))
        {
            errorMessage('Please complete all fields');
        }
        else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        {
            errorMessage('Please provide a valid email');
        }
        else if(!checkPhoneNumberFormat($_POST['phoneNumber']))
        {
            errorMessage('Please provide a valid phone number');
        }
        else if(!is_numeric($_POST['salary']))
        {
            errorMessage('Please provide a valid salary');
        }
        else{
            $query = 'insert into employees 
            values(
            "'.$_POST['name'].'", 
            "'.$_POST['email'].'", 
            "'.$_POST['position'].'", 
            "'. $_POST['phoneNumber'] . '", 
            "'.$_POST['salary'].'",
            "'.$_POST['dateHired'].'"
            )';
            $result = mysqli_query($link, $query);
            $employees = getEmployees($link);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>

        </title>

        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    </head>
    
    <body>
        <form action="index.php" method="post">
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Speed Shift Media</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name">    
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                    <label for="">Position</label>
                    <input class="form-control" type="text" name="position">
                </div>
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input class="form-control" type="text" name="phoneNumber">
                </div>
                <div class="form-group">
                    <label for="">Salary</label>
                    <input class="form-control" type="text" name="salary">
                </div>
                <div class="form-group">
                <label for="">Date Hired</label>
                <input class="form-control" type="date" name="dateHired">
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Post">
            </div>
            </div>
        </form>

        <?php 
            if(count($employees) > 0)
            {
                echo'<table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Date Hired</th>
                  </tr>
                </thead>';
                foreach($employees as $employee)
                {
                    echo '
                    <tbody>
                      <tr>
                        <th scope="row">'.$employee['name'].'</th>
                        <td>' . $employee['email'].'</td>
                        <td>'. $employee['position'].'</td>
                        <td>'. $employee['phoneNumber'].'</td>
                        <td>'. $employee['salary'].'</td>
                        <td>'. $employee['dateHired'].'</td>
                      </tr>';
                }
                echo '</tbody>
                </table>';
            }
        ?>
    </body>

</html>