<?php 

/**
 * Undocumented function
 *
 * @return void
 */
function getOrderDirection()
{

    function validateDirection($value)
    {
        $availableDirections = ['DESC', 'ASC'];
        if (in_array($value, $availableDirections)) return $value;

        return 'ASC';
    }

    return filter_input(INPUT_GET, 'direction', FILTER_CALLBACK, ['options' => 'validateDirection']);
}


$direction = getOrderDirection();
// SINON FILTRE PAR EXPRESSION REGULIERE

$order = filter_input(INPUT_POST, 'order');

var_dump($direction);
exit();


$DB = new PDO("mysql:host=localhost;dbname=classicmodels;charset=utf8", "root", "troiswa");
$sql = "SELECT c.customerNumber, c.customerName, c.contactLastName, c.contactFirstName, c.phone, c.city, c.country, e.firstName, e.lastName
FROM customers AS c
JOIN employees AS e ON c.salesRepEmployeeNumber = e.employeeNumber
ORDER BY $order $direction";
$query = $DB->prepare($sql);
$query->execute();
$data = $query->fetchAll();

$query = null;
$DB = null;

require_once "05-customers.phtml";
?>