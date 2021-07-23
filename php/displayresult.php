<?php
    session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
    $output="<h3>Student-Result</h3>";
    $filename = '../admin/json/class' . $_SESSION['class'] . '/studentResult-' . $_SESSION['class'] . '.json';
    $array_data = json_decode(file_get_contents($filename),true);
    foreach($array_data as $key => $value){
        if($_SESSION['id'] == $value['id'] && $_SESSION['username'] == $value['student_name']){
            $output.=   "<table>
                            <thead>
                                <th>Student-Id :- </th>
                                <td>{$_SESSION['id']}</td>
                            </thead>
                            <thead>
                                <th>Student Name :- </th>
                                <td>{$value['student_name']}</td>
                            </thead>
                            <thead>
                                <th>Student date of birth :- </th>
                                <td>{$value['date_of_birth']}</td>
                            </thead>
                            <thead>
                                <th>Student Class :- </th>
                                <td>{$value['class']}</td>
                            </thead>
                            <thead>
                                <th>Student Marks :- </th>
                                <td>
                                    <table>
                                        <thead>
                                            <th>Mathmatics :- </th>
                                            <td>{$value['marks']['mathmatics']}</td>
                                        </thead>
                                        <thead>
                                            <th>Science :- </th>
                                            <td>{$value['marks']['science']}</td>
                                        </thead>
                                        <thead>
                                            <th>Social-Science :- </th>
                                            <td>{$value['marks']['social_science']}</td>
                                        </thead>
                                        <thead>
                                            <th>Hindi :- </th>
                                            <td>{$value['marks']['hindi']}</td>
                                        </thead>
                                        <thead>
                                            <th>English :- </th>
                                            <td>{$value['marks']['english']}</td>
                                        </thead>
                                    </table>
                                </td>
                            </thead>
                            <thead>
                                <th>Student Percentage :- </th>
                                <td>{$value['percentage']}</td>
                            </thead>
                            <thead>
                            <thead>
                                <th>Student Grade :- </th>
                                <td>{$value['grade']}</td>
                            </thead>
                            <thead>
                            <thead>
                                <th>Student Status :- </th>
                                <td>{$value['status']}</td>
                            </thead>
                            <thead>
                            <thead>
                                <th><button id='close'>Close</button></th>
                                <th><button id='edit-request'>Modify-Request</button></th>
                            </thead>
                        </table>";
        }
    }
    file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT));
    echo $output;
?>