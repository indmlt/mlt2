
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Prediction</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
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
    </style>
</head>
<body>
    <div class="heading">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-xs-12">
                    <h1><i class="fa fa-book"></i> Prediction</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="tab-content" style="padding: 10px 0 50px;">
                <div class="col-xs-12">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="index.php">Data Presentation</a></li>
                            <li><a href="newindex.php">Data Series</a></li>
                        </ul>
                        <!-- Creat Folder and upload -->
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
                                        <div class="form-group col-xs-4">
                                            <input type="hidden" name="task" id="inputTask" class="form-control" value="uploadImages">
                                            <input type="file"  class="file" name="file_array[]" multiple="" multiple data-min-file-count="1">
                                        </div>
                                    </form> 
                                </div>
                            </div>
                            <div id="feedback"></div>
                        </div>
                        <h2 class="page-header">Menu</h2>
                        <div class="col-xs-12">
                            <div style="position:relative;" class="col-xs-6">
                                <a class='btn btn-primary' href='javascript:;'>
                                  Choose File...
                                <input type="file" id="fileUpload" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                                </a>
                                &nbsp;
                                <span class='label label-info' id="upload-file-info"></span>
                                <input class="btn btn-primary btn-sm btn-file hidden" type="button" id="upload" value="Upload"/>
                                <button class="btn btn-primary btn-sm" id="CreatChart" value="Upload">Creat Chart</button>
                            </div>  
                            <div class="selection col-xs-4"">
                                <select id="mySelect" class="form-control">
                                    <option>Select Colum</option>
                                </select>
                            </div>
                        </div>
                        <div class="dvCSV col-xs-12" style="max-height:300px; overflow:auto;"></div>
                        <div class="row">
                        <h2 class="page-header">Train Model</h2>
                                <button type="button" class="btn btn-default train">train</button>
                            <div class="col-xs-12 output" >
                                <h3>Result</h3>
                                <div class="class_report"></div>
                            </div>
                        </div>
                        <h2 class="page-header">Make Prediction</h2>
                        <div class="row">
                            <div class="col-xs-12 costs">
                                <h3>Inputs</h3>
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
                        </div>
                        <div class="row">
                            <div class="col-xs-12 execute ">
                                <button type="button" class="btn btn-default predict">Predict</button>
                                <button type="button" class="btn btn-default confusionmatrix">confusionmatrix</button>
                                <button type="button" class="btn btn-default save_model">Save Model</button>
                            </div>
                            <div class="col-xs-6 output" >
                                <h3>Result</h3>
                                <div class="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript">
    $(function () {
        $('#createFolder').click(function (e) {
            e.preventDefault();
            try {
              var folderName = $('#folderName').val(),
                task = 'createFolder';
                console.log(folderName + ':' + task);
                $.post('action.php', {task: task, folderName: folderName}, function (data) {
                  $('#feedback').html(data);
                  $('#folderName').val('');
                });
                // $.post('actions.php', $('#createFolderForm').serialize());
            } catch (err) {
              console.log(err);
            }
        });
        $("#upload").bind("click", function () {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt|.xlsx|.xls)$/;
            if (regex.test($("#fileUpload").val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
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
                        $('.tableChart').DataTable();
                        $(".tableChart > tbody > tr:first td").each(function (index) {
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
        $('#fileUpload').change( function(event) {
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



