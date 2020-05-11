//get currency rate from api.
$("#convertButton").click(function() {
    $("#convertButton").button("loading");
    $.ajax(
      {
      url: "https://api.exchangerate-api.com/v4/latest/INR",
      type: 'GET',
       
      success: function(result){
        var usd = result.rates.USD;
        var rupeesAmount = $('#rupeesAmount').val();
        var finalAmount = (usd*rupeesAmount).toFixed(2);
        $("#usdAmount").val(finalAmount);
        new PNotify({
          title: 'Currency Converted',
          text: 'Please see details below!',
          type: 'success',
          styling: 'bootstrap3',
          buttons: {
            sticker: false
          }
        });
      }
    });
});

//sending email after import.
$("#emailButton").click(function() {
    $.ajax(
      {
      url: "/email",
      type: 'POST',
      data:{
          'data': $('#full-content').html(),
          '_token':$('input[name="_token"]').val()
      },
      success: function(result){
        new PNotify({
          title: 'Email Sent',
          text: 'Please check email for details!',
          type: 'success',
          styling: 'bootstrap3',
          buttons: {
            sticker: false
          }
        });
      }
    });
});

//uploading file for import.
var max_file_size=5000000;
$("#upload").on("click", function(e) {
    e.preventDefault();
    $("#importLink").html("");
    //display upload button
    $(e.relatedTarget).data("button");
    var file_data = $("#file").prop("files")[0];

    if ($("#file").val() == "") {
        $("#importLink").html("Please select file.").css("color", "black");
        return false;
    }

    if ($("#file").prop("files")[0].size > max_file_size) {
        $("#importLink").html("File should be less than 5Mb.").css("color", "black");
        return false;
    }

    var extension = file_data.name.substring(
        file_data.name.lastIndexOf(".") + 1
    );
    if (extension != "csv") {
        $("#importLink").html("Invalid file type.Only csv allowed.").css("color", "black");
        return false;
    }

    $(this).button("loading");

    var actionUrl = '/convert';
    var files = e.target.files;
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("_token", $('input[name="_token"]').val());
    $.ajax({
        data: form_data,
        type: "post",
        url: actionUrl,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.result == "success") {
                $("#file").val("");
                $('#table-data').html(data.data);
                $('#avg').html(data.payload.average);
                $('#max').html(data.payload.max);
                $('#min').html(data.payload.min);
                $('#rate').html(data.payload.rate);
                $('#time').html(data.payload.time);
                $('#full-content').show();
                $('#convertModal').modal('hide');

                new PNotify({
                    title: 'Currency Converted',
                    text: 'Please check data below for details!',
                    type: 'success',
                    styling: 'bootstrap3',
                    buttons: {
                      sticker: false
                    }
                });

                // successNotification("Import");
            } else {
                $("#file").val("");
                // errorNotification("Import Error");
                $("#importLink")
                    .html(
                        "Your sheet has some errors.You can download it <a href=" +
                            data.link +
                            ' style="text-decoration:underline;font-weight:bold;">here</a></p>'
                    ).css("color", "red");
            }
        },
        error: function(data) {
            
        },
        complete: function() {
            $("#upload").button("reset");
        },
        beforeSend: function() {}
    });
});