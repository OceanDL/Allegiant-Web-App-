<?php
	//DB Setup
    $servername = "localhost";
	$username = "root";
	$password = "''";
	$database = "AllegiantWebApp";
	$dbport = 3306;
	
	session_start();
	$db = new mysqli($servername, $username, $password, $database, $dbport);
 
    $method = $_SERVER["REQUEST_METHOD"];

	//Switch case for type of request (GET,POST,PUT,DELETE)
    switch($method)
	{
        case 'GET':
		if(!empty($_GET["id"])) {
            if(preg_match('/\\d/', $_GET["id"]) > 0) {
                $id = intval($_GET["id"]);
		        get_customers($id);
            } else {
				$lastName = $_GET["id"];
                search_customers($lastName);
            }
		} else {
		    get_customers();
		}
		break;
		default:
		header("Invalid Get request format, see API documentation");
		break;

		case 'POST':
		insert_customer();
		break;

		case 'PUT':
		$id=intval($_GET["id"]);
		update_customer($id);
		break;

		case 'DELETE':
		$id=intval($_GET["id"]);
		delete_customer($id);
		break;
    }
    

	//Get customer by provided id
    function get_customers($id = 0) {
		global $db;
	    $query = "SELECT * FROM customers";
	    if($id != 0) {
		    $query .= " WHERE id = ".$id." LIMIT 1";
	    }
	    $response = array();
	    $result = mysqli_query($db, $query);
	    while($row = mysqli_fetch_array($result)) {
			$response[] = $row;
	    }
	    header('Content-Type: application/json');
	    echo json_encode($response);
    }

	/*Simple search if get request is anything but a number, searches last name only and returns
	  the customer records that match. 
	*/
	
    function search_customers($lastName = "") {
		global $db;
		$query = "SELECT * FROM customers WHERE last_name = '$lastName'";
	    $response = array();
	    $result = mysqli_query($db, $query);
	    while($row = mysqli_fetch_array($result)) {
			$response[] = $row;
	    }
	    header('Content-Type: application/json');
	    echo json_encode($response);
	}

	//Insert Customer POST request function
	function insert_customer() {
		global $db;
		$data = json_decode(file_get_contents('php://input'), true);
		$email = $data["email"];
		$firstName = $data["first_name"];
		$lastName = $data["last_name"];
		$latitude = $data["latitude"];
		$longitude = $data["longitude"];
		$query = "INSERT INTO customers SET email = '".$email."', first_name = '".$first_name."', last_name = '".$last_name."', latitude = '".$latitude."', longitude = '".$longitude."'";
		if(mysqli_query($db, $query)) {
			$response = ['status' => 1,'status_message' =>'Customer inserted.'];
		} else {
			$response = ['status' => 0,'status_message' =>'Error inserting customer.'];
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	//Insert Customer POST request function
	function update_customer() {
		global $db;
		$data = json_decode(file_get_contents('php://input'), true);
		$email = $data["email"];
		$firstName = $data["first_name"];
		$lastName = $data["last_name"];
		$latitude = $data["latitude"];
		$longitude = $data["longitude"];
		$query = "UPDATE customers SET email = '".$email."', first_name = '".$first_name."', last_name = '".$last_name."', latitude = '".$latitude."', longitude = '".$longitude."' WHERE id=".$id;
		if(mysqli_query($db, $query)) {
			$response = ['status' => 1, 'status_message' =>'Customer updated.'];
		} else {
			$response = ['status' => 0, 'status_message' =>'Error updating customer.'];
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	//Delete Customer DELETE request function given customer ID
	function delete_customer($id) {
		global $db;
		$query = "DELETE FROM customers WHERE id=".$id;
		if(mysqli_query($db, $query)) {
			$response = ['status' => 1, 'status_message' =>'Customer deleted.'];
		} else {
			$response = ['status' => 0, 'status_message' =>'Error deleting customer.'];
		}
			header('Content-Type: application/json');
			echo json_encode($response);
	}
?>