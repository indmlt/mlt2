<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <title>Prediction</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.css">
        <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <style>
            body {padding: 0;}
            .heading {
                background: #2A587F;
                color: #fff;
                margin: 0 0 20px 0;
                box-shadow: inset 0px 0px 52px #1C4569;
            }
            h1 {
                padding: 0 0 20px 0;
            }
            .resultbox {
              background-color: #fff
              min-height: 100px;
              font-size: 18px;
              margin-top: 5px;
              box-shadow: 7px 10px 19px #ccc;
                -webkit-box-shadow: 7px 10px 19px #ccc;
                -moz-box-shadow: 7px 10px 19px #ccc;

              
              /*box-shadow: 10px 10px 5px #f7f5f5;*/

            }
        </style>
    </head>
    <body>
        <div class="heading">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-xs-12">
                        <h1><i class="fa fa fa-universal-access"></i> Machine Learning Tool</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div id="exTab2" class="container"> 
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#1" data-toggle="tab">Eploration</a> </li>
                        <li><a  href="#2" data-toggle="tab">Modeling</a></li>
                        <li><a  href="#3" data-toggle="tab">Prediction</a></li>
                    </ul>
                    <div class="tab-content"  style="padding: 10px 0 50px;">
                        <div class="tab-pane active" id="1">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h3>Upload files</h3>
                                    <div class="col-xs-4">
                                        <form method="post" id="createFolderForm" action="action.php">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="folder" id="folderName" placeholder="Folder Name">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" id="createFolder" type="button">Create Folder</button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-8">
                                        <form action="action.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group col-xs-4">
                                                <select name="folder" id="folder" class="form-control" required="required">
                                                    <option value="">Select Folder</option>
                                                    <?php $dir = opendir('../server/');
                                                        while ($file = readdir($dir)) { 
                                                            if(strpos($file,'.') === false) {
                                                                $selected = '';
                                                                if ($file === $folder) {
                                                                    $selected = 'selected';
                                                                }
                                                                echo '<option value="' . $file . '" ' . $selected . '>' . $file . '</option>';
                                                            }
                                                        }       
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-8">
                                                <input type="hidden" name="task" id="inputTask" class="form-control" value="uploadImages">
                                                <input type="file"  class="file" name="file_array[]" multiple="" multiple data-min-file-count="1">
                                            </div>
                                        </form> 
                                    </div>
                                </div>
                                <div id="feedback"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h3>Exploratory Analysis</h3><hr>
                                    <div class="col-xs-8">
                                        <div  class="">
                                            <a class='btn btn-primary' href='javascript:;'>
                                              Choose File...
                                            <input type="file" id="fileUpload" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                                            </a>
                                            &nbsp;
                                            <span class='label label-info' id="upload-file-info"></span>
                                            <input class="btn btn-primary btn-sm btn-file hidden" type="button" id="upload" value="Upload"/>
                                            <button class="btn btn-primary btn-sm" id="CreatChart" value="Upload">Creat Chart</button>
                                        </div>  
                                    </div>
                                    <div class="col-xs-4">
                                         <!-- <div class="selection">
                                            <select id="mySelect" class="form-control">
                                                <option>Select Colum</option>
                                            </select>
                                        </div> -->
                                    </div>
                                    <div class="dvCSV col-xs-12" style="max-height:300px; overflow:auto; margin-top: 10px;"></div>
                                </div>
                            </div>
                        </div> 
                        <div class="tab-pane " id="2">
                            <div class="row">
                                <!-- <div class="col-xs-12">
                                    <div class="col-xs-8">
                                     <form class="load_FileName">
                                        <div  class="">
                                            <a class='btn btn-primary' href='javascript:;'>
                                              Choose File...
                                            <input type="file" id="" Class="fileUpload"
                                            style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="fileInput" size="40"  onchange='$(".upload-file-info").html($(this).val());'>
                                                </a>
                                            &nbsp;
                                            <span class='label label-info upload-file-info' id=""></span>
                                            <input class="btn btn-primary btn-sm btn-file hidden" type="button" id="upload" value="Upload"/>
                                        <button class="btn btn-primary btn-sm submitFile" id="CreatChart" value="Upload">Load File</button> 
                                        </div> 
                                        </form>
                                    </div>
                                    <div class="col-xs-4">
                                        <select id="" class="form-control">
                                            <option>Select Model</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-xs-12">
                                    <h3>Data Processing</h3><hr>
                                    <button type="button" style="" class="btn btn-default rescaldata">Rescale data</button>
                                    <button type="button" class="btn btn-default standardize">Standardize data</button>
                                    <button type="button" class="btn btn-default  normalize">Normalize data</button>
                                    <button type="button" class="btn btn-default binarize">Binarization</button>
                                    <div class="" style="margin-top: 15px;">
                                        <div class="rescale_data" style=" display: inline-block; margin-right: 25px;" ></div>
                                        <div class="standardize_data" style=" display: inline-block; margin-right: 25px;" ></div>
                                        <div class="normalize_data" style=" display: inline-block; margin-right: 25px;" ></div>
                                        <div class="binarization" style=" display: inline-block; margin-right: 25px;"></div>
                                    </div>
                                    <h3>Model Training</h3><hr>
                                    <button type="button" style="margin-bottom: 5px" class="btn btn-default train">Train Model</button>
                                    <button type="button" class="btn btn-default save_model">Save Model</button>
                                    <div class=" output">
                                        <div class="class_report"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="3">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-xs-12">
                                       <h4>Inputs</h4>
                                        <form class="inputs">
                                            <div class="form-group">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="credit_policy" value="1">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="int_rate" value="0.1496">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="installment" value="194.02">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="log_annual_inc" value="10.714418">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="dti" value="4.0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="fico" value="667">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="days_with_cr_line" value="3180.04">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="revol_bal" value="3839">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="revol_util" value="76.8">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="inq_last_6mths" value="0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="delinq_2yrs" value="0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="pub_rec" value="1">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="purpose_credit_card" value="0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="purpose_debt_consolidation" value="1">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="purpose_educational" value="0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="purpose_home_improvement" value="0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="purpose_major_purchase" value="0">
                                                <input type="text" style="width: 80px; display: inline-block;" class="form-control" name="purpose_small_business" value="0">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12">
                                        <button type="button" class="btn btn-default predict">Predict</button>
                                    </div>
                                    <div class="col-xs-12 output" >
                                        <h3>Result</h3>
                                        <div class="result"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/svg.js/1.0.1/svg.min.js"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
    <script src="js/flowsvg.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $('.rescaldata').click(function() {
            $('.rescale_data').empty().append('<div class="item item-1 resultbox" style="height: 100px; width: 150px; border: solid 1px #f7f5f5;; "><span class="text">Result</span></div>');
        });
        $('.standardize').click(function() {
            $('.standardize_data').empty().append('<div class="item item-1 resultbox" style="height: 100px; width: 150px; border: solid 1px #f7f5f5;; "><span class="text">Result</span></div>');
        }); 
        $('.normalize').click(function() {
            $('.normalize_data').empty().append('<div class="item item-1 resultbox" style="height: 100px; width: 150px; border: solid 1px #f7f5f5;; "><span class="text">Result</span></div>');
        });
        $('.binarize').click(function() {
            $('.binarization').empty().append('<div class="item item-1 resultbox" style="height: 100px; width: 150px; border: solid 1px #f7f5f5;; "><span class="text">Result</span></div>');
        });
        $('#createFolder').click(function(e) {
            e.preventDefault();
            try {
                var folderName = $('#folderName').val(),
                    task = 'createFolder';
                console.log(folderName + ':' + task);
                $.post('action.php', { task: task, folderName: folderName }, function(data) {
                    $('#feedback').html(data);
                    $('#folderName').val('');
                });
                // $.post('actions.php', $('#createFolderForm').serialize());
            } catch (err) {
                console.log(err);
            }
        });
        $("#upload").bind("click", function() {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt|.xlsx|.xls)$/;
            if (regex.test($("#fileUpload").val().toLowerCase())) {
                if (typeof(FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var table = $("<table />");
                        var rows = e.target.result.split("\n");
                        for (var i = 0; i < rows.length; i++) {
                            var row = $("<tr />");
                            var cells = rows[i].split(",");
                            for (var j = 0; j < cells.length; j++) {
                                var cell = $("<td />");
                                cell.html(cells[j]);
                                row.append(cell);
                            }
                            table.append(row);
                        }
                        $(".dvCSV").html('');
                        $(".dvCSV").append(table);
                        $("table").addClass('table tableChart table-bordered');
                        // $('.tableChart').DataTable();
                        $(".tableChart > tbody > tr:first td").each(function(index) {
                            var myText = $(this).text(),
                                myindex = index + 1;
                            // console.log(myText);
                            // $('#mySelect').empty();
                            $('#mySelect').append('<option value="' + myindex + '">' + myText + '</option>');
                            $(this).replaceWith('<th>' + myText + '</th>');
                        });
                        $('.tableChart').prepend('<thead></thead>');
                        $(".tableChart > tbody > tr:first").appendTo('.tableChart > thead');

                    }
                    reader.readAsText($("#fileUpload")[0].files[0]);
                } else {
                    alert("This browser does not support HTML5.");
                }
            } else {
                alert("Please upload a valid CSV file.");
            }
        });
        $('#fileUpload').change(function(event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            // console.log(tmppath);
            $("#CreatChart").click(function() {
                $("#mySelect").empty();
                $("#upload").trigger("click");

            });
        });
    });
 
    </script>
    </body>
</html>