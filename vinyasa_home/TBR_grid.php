<?php
require('../VYS_assets/chalkuch/session.class.php');
include '../db_config.php';
$session=new session();
$session->start_session('s_', false);
$result = $db->query("SELECT * FROM vin_sec_courses");
// Creates temp array variable
$row = array();
// Adds each records/row to $temp
if($result->num_rows > 0){
    //echo '{"testData":[';

    $first = true;
    //$row=mysql_fetch_assoc($result);
    while($row = $result->fetch_assoc()){
        $temp[]=$row;
}
}
// Formats json from temp and shows/print on page

?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.4.1/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.4.1/jsgrid-theme.min.css" />     
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.4.1/jsgrid.min.js"></script>
  
<script>
        var clients = <?php echo json_encode($temp); ?>;
     
        var countries = [
            { Name: "", Id: 0 },
            { Name: "United States", Id: 1 },
            { Name: "Canada", Id: 2 },
            { Name: "United Kingdom", Id: 3 }
        ];
     $(document).ready(function(){
        $("#jsGrid").jsGrid({
            width: "100%",
            height: "400px",
     
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
     
            data: clients,
     
            fields: [
                { title: "ID", name: "id", type: "number", width: 150, validate: "required" },
                { title: "Course Name", name: "course_name", type: "text", width: 50 },
                { title: "Course Description", name: "course_description", type: "text", width: 200 },
                { title: "Course Price", name: "course_price", type: "number", width: 150, validate: "required"  },
                { type: "control" }
            ]
        });
        });
    </script>
</head>
<body>
<div id="jsGrid"></div>
</body>
</html>