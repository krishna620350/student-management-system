<?php include "php/header.php";?>
<div class="record">
  <table>
    <thead style="color:white">
      <th>S.No</th>
      <th>Class</th>
      <th>Total Student</th>
      <th>No. of pass student</th>
      <th>No. of fail student</th>
      <th>Class Record</th>
    </thead>
    <?php
      $class_array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
      $array_data = [];
      $record = 0;
      $pass = 0;
      $fail = 0;
      for ($i = 0; $i < count($class_array); $i++) {
        $filename_record = "json/class" . $class_array[$i] . "/studentRecord-" . $class_array[$i] . ".json";
        $filename_result = "json/class" . $class_array[$i] . "/studentResult-" . $class_array[$i] . ".json";
        
        $current_data = file_get_contents($filename_record);

        $array_data = json_decode($current_data, true);
        if(is_array($array_data)){
          $record = count($array_data);
        }
        if(file_exists($filename_result)){
          $array_result = json_decode(file_get_contents($filename_result), true);
          if(!empty($array_result)){
            foreach ($array_result as $key => $value) {
              if ($value['status'] == "pass") {
                $pass++;
              } else if ($value['status'] == "fail") {
                $fail++;
              }
            }
          }
        }
    ?>
    <tr style="color:white">
      <td><?php echo $i+1;?></td>
      <td><?php echo $class_array[$i]; ?></td>
      <td><?php echo $record;
                $record = 0;
          ?></td>
      <td><?php echo $pass; 
        $pass = 0;
      ?></td>
      <td><?php echo $fail; 
        $fail = 0
        ?></td>
      <td><a href="php/student/html/displayrecord.html?class=<?php echo $class_array[$i];?>" target="_blank">Record</a></td>
    </tr>
    <?php
      }
    ?>
  </table>
</div>
</div>
<script src="js/script.js"></script>
</body>

</html>