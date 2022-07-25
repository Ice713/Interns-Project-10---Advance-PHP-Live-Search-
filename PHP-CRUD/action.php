<?php
    include 'process.php';
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $output='';

    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $stmt=$mysqli->prepare("SELECT * FROM data WHERE name LIKE CONCAT('%',?,'%') OR location LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else {
        $stmt=$mysqli->prepare("SELECT * FROM data");
    }
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0){
        $output ="<thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>". echo $row['name']."</td>
                <td>". echo $row['location']."</td>
                <td>
                    <a href="index.php?edit=". echo $row['id'].""
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=". echo $row['id'].""
                    class="btn btn-danger">Delete</a>
                </td>   
            </tr>";
        }
        $output .="</tbody>";
        echo $output;
    }
    else {
        echo "<h3>No Records Found!</h3>";
    }

?>