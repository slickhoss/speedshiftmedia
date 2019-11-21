<?php
function getEmployees($link)
{
    if($link)
    {
        $employees = [];
        $query = 'select * from employees';
        $result = mysqli_query($link, $query);

        while($row=mysqli_fetch_array($result))
        {
            $employees[] = $row;
        }
        return $employees;
    }
}

function checkInput($input)
{
    if(empty($input['name']) || empty($input['email']) || empty($input['position']) || empty($input['phoneNumber']) || empty($input['salary']) || empty($input['dateHired']))
    {
        return false;
    }
    return true;
}

function checkPhoneNumberFormat($input)
{
    $regex0 = '/^[(][0-9]{3}[)][0-9]{7}/';
    $regex1 = '/^[0-9]{3}-[0-9]{3}-[0-9]{4}/';
    $regex2 = '/^[0-9]{10}/';
    $regex4 = '/^[0-9]{3} [0-9]{3} [0-9]{4}/';
    $regex5 = '/^[(][0-9]{3}[)] [0-9]{3} [0-9]{4}/';
    
    
    if(preg_match($regex0, $input))
    {
        return true;
    }
    if(preg_match($regex1, $input))
    {
        return true;    
    }
    if(preg_match($regex2, $input))
    {
        return true;
    }
    if(preg_match($regex4, $input))
    {
        return true;
    }
    if(preg_match($regex5, $input))
    {
        return true;
    }
    
    return false;
}
function errorMessage($string)
{
    echo "<div class='alert alert-danger alert-dismissable text-center'>
    ". $string ."
</div> ";

}