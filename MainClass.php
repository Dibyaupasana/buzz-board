<?php
include_once('db.php');

class MainClass extends DB
{

    public function viewMarks($sId)
    {
        $data = '';
        $fetchdata = new MainClass();

        if ($sId > 0) {
            $fetchquery =  "SELECT s.subjectname AS subject_name,CONCAT('[', GROUP_CONCAT(JSON_OBJECT('marks', m.marks)), ']') AS marklist,SUM(m.marks) AS termmarks FROM marks m JOIN subjects s ON s.subject_id = m.subject_id WHERE m.student_id = ".$sId." GROUP BY  m.subject_id;";
        }

        $marksresult =  $fetchdata->executeQuery($fetchquery);
        //$rst = $marksresult->fetch_array(); echo "<pre>";print_R($rst);exit;
        if ($marksresult->num_rows > 0) {

            $ctr = 0;

            $data .= '<table  id="tabledata" class=" table table-striped table-hover 	table-bordered">
    		<thead>
 			<tr class="bg-dark text-white text-center">
 			<th> Subject </th>
 			<th> Term1 </th>
            <th> Term2 </th>
            <th> Term3 </th>
            <th> Marks(Sum) </th>
            <th> Total Marks </th>
 			</thead>
 			<tbody>';
            // output data of each row
            $sum = 0;
            $fail_in_subject = 0;
            while ($row = $marksresult->fetch_assoc()) {

                $sum =$sum+$row['termmarks'];
                // echo '********<pre>';print_R($row);
                $subResult = json_decode($row['marklist'], true);
                
                $data .= '<tr class="text-center">';
                $data .= '<td>' . $row['subject_name'] . '</td>';
                foreach ($subResult as $sub_res) {
                    $data .= '<td>' . $sub_res['marks'] . '</td>';
                }
                
                $data .= '<td>'.$row['termmarks'] . '</td>';
                $data .= '<td>'. '100' . '</td></tr>';

                if($row['termmarks']< 33){
                    $fail_in_subject++;
                }

                $ctr++;
            }

            $data .= '<tr class="text-center">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total:</td>
                        <td>'.$sum.'</td>
                        <td>'. $ctr * 100 .'</td>
                    </tr>';

            if ($fail_in_subject == 0){
                $exam_result = 'Pass';
            }elseif($fail_in_subject <= 2){
                $exam_result = 'Comp';
            }else {
                $exam_result = 'Fail';
            }
            

            $data .= '</tbody></table>';
            $data .= '<div class="row">
                        <div class="col-sm-6">
                            <p>Result</p>
                            <p>Pass > 33 </p>
                            <p>Fail < 33 </p>
                            <p>Comp Fail in 2 Subject</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Result: <b>'. $exam_result.'</b></p>
                            <p>Aggregate: '.round($sum/$ctr,2) .'%</p>
                        </div>
                    </div>';


        } else {
            $data .= '<div class="noRecord">No Result Found!</div>';
        }

        echo json_encode(array('viewmarks' => $data));
    }
}
