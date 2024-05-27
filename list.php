<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >USER List</title>
    <style>
     h2{
        text-decoration: underline;
        font-weight: 700;
        
     }
     
    th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 2px solid gray;
           
           background: #ffcc;
           
        }
    </style>
</head>
<body>
    
    <h2>USER List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>FullName</th>
            <th>Email</th>
            <th>PASSWORD</th>
        </tr>
        <?php
        
  
        
         $hostName = "localhost";
         $dbuser = "root";
         $dbpassword = "";
         $dbName = "project";


        $connection = new mysqli($hostName, $dbuser, $dbpassword,  $dbName);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

       
        $sql_query = "SELECT * FROM user";
        $result = $connection->query($sql_query);

        
        if ($result !== false && $result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["fullname"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["password"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }

        $connection->close();
        ?>
    </table>
</body>
</html>
