<?php
    include 'config.php';
    $output='';

    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $stmt=$conn->prepare("SELECT * FROM data WHERE name LIKE CONCAT('%',?,'%') OR location LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM data");
    }
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0){
        $output ="<thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>";
            while($row=$result->fetch_assoc()){
                $output .="
                <tr>
                    <td>".$row['name']."</td>
                    <td>".$row['location']."</td>
                </tr>";
            }
            $output .="</tbody>";
            echo $output;
    }
    else{
        echo "<h3>No Records Found!<h3>";
    }
?>