<?php

include_once('displayResultInner.php');
//print_r($rst);


?>


<!DOCTYPE html>
<html>

<head>
    <title>Display Page</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>




    <!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"> -->
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

    </script>







</head>

<body>

    <form method="post" id="stdForm">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <br>
                    <h1 class="text-warning text-center">STUDENTS PORTAL</h1>
                    <br>

                    <div class="search-sec" id="searchPanel">
                        <div class="form-group">

                            <label for="txtrollno">Roll Number</label>

                            <input type="text" id="txtrollno" name="txtrollno" class="form-control" onkeypress="return isCharKey(event);" maxlength="80" autocomplete="off" value="<?php echo $txtrollno; ?>">
                        </div>


                        <div class="col-sm-2">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show">
                            <input type="button" name="btnClear" id="btnClear" class="btn btn-danger" value="Clear" onclick="window.location.href = '<?php echo 'displayResult.php' ?>'">
                        </div>




                    </div>
                </div>
            </div>




            <br>
            <?php

            if ($result->num_rows > 0) {
            ?>
                <table id="tabledata" class=" table table-striped table-hover table-bordered" data-name="Student-data">

                    <thead>

                        <tr class="bg-dark text-white text-center">
                            <th> SL No. </th>
                            <th> Roll No. </th>
                            <th> Name </th>
                            <th> Sex </th>
                            <th> Standard </th>
                            <th> View Courses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ctr = 0;
                        while ($row = $result->fetch_assoc()) {
                            $ctr++;
                        ?>
                            <tr class="text-center" id="<?php echo $row['student_id']; ?>">
                                <td> <?php echo $ctr; ?> </td>
                                <td> <?php echo $row['roll_no'];  ?> </td>
                                <td> <?php echo $row['name'];  ?> </td>
                                <td> <?php echo $row['gender'];  ?> </td>
                                <td> <?php echo $row['class'];  ?> </td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#marksheetModal" onclick="view_marks(<?php echo $row['student_id']; ?>)">View</button></td>

                            </tr>

                        <?php

                        } //end loop
                        ?>


                    <?php } else { ?>

                        <table class=" table table-striped table-hover table-bordered">
                            <tr>
                                <td colspan="10">No records Found! </td>
                            </tr>
                        </table>
                    <?php } ?>


                    <?php

                    ?>

        </div>
        </div>
        </div>

    </form>



    <!-- Modal -->
    <div class="modal fade" id="marksheetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Marksheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" charset="utf8">
        const path = "http://localhost/INTERVIEW_TASK/";

        function view_marks(s_id) {


            $.ajax({
                type: "POST",
                url: path + '/proxy.php',
                dataType: "json",
                data: {
                    method: "viewMarks",
                    s_id: s_id
                },
                success: function(data) {
                    var res = data.viewmarks;
                    //alert(res);
                    //console.log(res);
                    //$('#myModal').modal('toggle');
                    $('.modal-body').html(res);
                    $('#myModal').show();
                    // $('#myModal').hide();
                }
            });
        }
    </script>


</body>

</html>