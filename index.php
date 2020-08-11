<?php
    header("Content-Type: application/json; charset=UTF-8");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smart-helm";

    function eror_parameter()
    {
        $data = array(
            'status' => "error",
            'message' => "parameter invalid" 
        );
        
        echo json_encode($data);
    }

    function insert_data($suhu,$no_wa)
    {
        global $servername,$username,$password,$dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            $data = array(
                'status' => "error",
                'message' => "Connection failed: " . $conn->connect_error,
            );
        }
        
        $sql = "INSERT INTO suhu (suhu, no_wa) VALUES ('$suhu', $no_wa)";
        
        if ($conn->query($sql) === TRUE) {
            $data = array(
                'status' => "success",
                'message' => "New record created successfully" 
            );
        } else {
            $data = array(
                'status' => "error",
                'message' => "Query: " . $sql . "| Error: " . $conn->error,
            );
        }
        
        $conn->close();

        echo json_encode($data);
    }

    function show_data($no_wa)
    {
        global $servername,$username,$password,$dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            $data = array(
                'status' => "error",
                'message' => "Connection failed: " . $conn->connect_error 
            );
        }

        $sql = "SELECT id, suhu, no_wa FROM suhu WHERE no_wa = $no_wa ORDER BY date_time DESC LIMIT 5";
        $result = $conn->query($sql);

        $data_suhu = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $temp = array(
                    'id' => $row["id"],
                    'suhu' => $row["suhu"],
                    'no_wa' => $row["no_wa"],
                );
                array_push($data_suhu,$temp);
            }
          }

        $data = array(
            'status' => "success",
            'message' => "data show" ,
            'result' => $data_suhu,
        );

        $conn->close();

        echo json_encode($data);        
    } 

    if (!empty($_GET['tipe'])) {
        if ($_GET['tipe'] == 'insert' AND !empty($_GET['suhu']) AND !empty($_GET['no_wa'])) {
            $suhu = $_GET['suhu']; 
            $no_wa = $_GET['no_wa'];

            insert_data($suhu, $no_wa);
        } elseif($_GET['tipe'] == 'show' AND !empty($_GET['no_wa'])){
            $no_wa = $_GET['no_wa'];

            show_data($no_wa);
        } else {
            eror_parameter();
        }
    }else{
        eror_parameter();
    }    
?>