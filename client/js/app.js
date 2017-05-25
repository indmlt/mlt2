$(document).ready(function ($) {
    $('.predict').click(function () {
        $('.result').text("");
        inputs = getFormData(".inputs");
        //jquery AJAX post
        var url = "http://127.0.0.1:7000/prediction";
        var data = JSON.stringify(inputs); //serializes json into a string, opposite of parse
        $.post( url, data, function(data){
            response = data.results
            prob = data.probability*100
            $('.result').append("The probability of paying back is: " + prob +" %");
            console.log(response);
        });
    });
      $('.submitFile').click(function () {
        var file_inputs = $(".fileUpload").val();
        var data = file_inputs.replace(/^C:\\fakepath\\/i, '');
        // var  load_FileName = getFormData(".load_FileName"); 
        var url = "http://127.0.0.1:7000/load_data";
        $.post( url, data, function(data){
            // response = data.results
            // prob = data.probability*100
            $('.result').append("The probability of paying back is  %");
        });
            console.log(data);
    });

                $('#clickme').click(function(){
                    alert('Im going to start processing');

                    $.ajax({
                        url: "/scripts/posting.py",
                        type: "post",
                        datatype:"json",
                        data: 'lon.csv',
                        success: function(response){
                            alert(response.message);
                            alert(response.keys);
                        }
                    });
                });
         
    $('.train').click(function () {
        $('.result').text("");
        inputs = getFormData(".inputs");
        var url = "http://127.0.0.1:7000/training";
        $.post( url, function(data, report){
            $('.class_report').append("<pre>"+data+"</pre><pre>"+report+"</pre>");
            console.log(data);
        });
    });
     $('.confusionmatrix').click(function () {
        $('.result').text("");
        inputs = getFormData(".inputs");
        var url = "http://127.0.0.1:7000/confusionmatrix";
        $.post( url, function(data){
            // response = data.results
            // prob = data.probability
            $('.class_report').append("<pre>"+data+"</pre>");
            console.log(data);
        });
    });
    $('.save_model').click(function () {
        var url = "http://127.0.0.1:7000/save_model";
        var folderName = "model_folder1";
        console.log(folderName);
        $.post( url, function(data){
            // $('.class_report').append("<pre>"+data+"</pre>");
            console.log(data);
        });

        $.post("action.php", { 
            task: "uploadModel",
            folderName: folderName
        });
        // $.post("action.php", { 
        //     task: "uploadModel",
        //     folderName: folderName
        // }).done(function (data) {
        //     $('.updateCanvas').html('Updated');
        // });
    });
    function getFormData(form){
        var json={};
        var array = $(form).serializeArray();
        $.each(array, function(){
            json[this.name]=this.value || '';
        });
        return json;
    }
});
