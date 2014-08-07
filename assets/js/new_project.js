$(document).ready(function() {
    var step =1;
    var active = 0;
    $("#newClientLnk").click(function(event) {
        if (active == 1) {
            $("#newClientCont").hide();
            $("#newClientLnk").text("New Client");
            active = 0;
        } else {
            $("#newClientCont").show();
            $("#newClientLnk").text("Hide");
            active = 1;
        }

    });
    $("input[name=instLessQty]").keyup(function(){
        num = $(this).val();
        $("input[name=flLessQty]").val(num);
    });
    $("#newClientBtn").click(function() {
        clientName = $("#clientName").val();
        contact = $("#contactName").val();
        $.post('clients/create', {
            clientName: $("#clientName").val(),
            notes: $("#notes").val(),
            contactName: $("#contactName").val(),
            contactPhone: $("#contactPhone").val(),
            contactEmail: $("#contactEmail").val()

        }, function(data, textStatus, xhr) {
            if (data.indexOf("success") != -1) {
                $("#clientName").val("");
                $("#notes").val("");
                $("#contactName").val("");
                $("#contactEmail").val("");
                $("#contactPhone").val("");

                $.getJSON('clients/', function(json) {
                    var options;
                    $.each(json, function(index, val) {
                        if(val==clientName) {selected = "selected='selected'"; contact_id =index;}
                        else selected ='';
                        options += "<option value='" + index + "' "+selected+">" + val + "</option>";
                    });
                    $("#clientList").html(options);
                    $.getJSON('/clients/contacts/' + contact_id, function(data) {
                        var html;
                        $.each(data, function(index, val) {
                            html += "<option value='" + index + "'>" + val + "</option>";
                        });
                        $("#contactList").html(html);
                        // alert(data);
                    });
                    
                });

                $("#clientNotification1").html("Success!!").show();
                setTimeout(function() {

                    $('#newClientCont').hide();
                    $("#newClientLnk").text("New Client");
                    active = 0;
                    $("#clientNotification1").hide();
                }, 2000);
            } else {
                $("#clientNotification2").html(data).show();
                setTimeout(function() {
                    $("#clientNotification2").hide();
                }, 3000);
            }


        });
    });

    $("#clientList").change(function(event) {
        $.getJSON('/clients/contacts/' + $("#clientList").val(), function(data) {
            var html;
            $.each(data, function(index, val) {
                html += "<option value='" + index + "'>" + val + "</option>";
            });
            $("#contactList").html(html);
            // alert(data);
        });
    });

    $("#nextBtn").click(function(event) {
        $('#step'+step).hide();
        if(step<3) step++;
        $('#step'+step).show();
        if(step>1) {
            $('#backBtn').show();
            $('#close_new').hide();
        }
        if(step ==3) {
            $('#submit_new_project').show();
            $('#nextBtn').hide();
        }
    });

    $("#backBtn").click(function(event) {
        $('#step'+step).hide();
        if(step>1) step--;
        $('#step'+step).show();
        if(step>1) {
            $('#submit_new_project').hide();
            $('#backBtn').show();
            $('#nextBtn').show();
            $('#close_new').hide();
        }
        if(step ==3) {
            $('#submit_new_project').show();
            $('#nextBtn').hide();
        }
    });

    // Check all options instructional
    $('#checkAllIns').click(function(event) { //on click
        if (this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
        }
    });

    $('#checkAll3D').click(function(event) { //on click
        if (this.checked) { // check select status
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
        }
    });

    $('#checkAllFlash').click(function(event) { //on click
        if (this.checked) { // check select status
            $('.checkbox3').each(function() { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.checkbox3').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
        }
    });


    // ON Project submit
    $('#submit_new_project').click(function() {
        data = $("form").serializeArray();
        $.post('home/newProject', data, function(data) {
            if (data.indexOf("Success") != -1) {
                $('#task_url').attr('href','../../home/task/'+data.replace('Success',''));
                $('#project_url').attr('href','../../project/'+data.replace('Success',''));
                $('#successPage').modal('show');
                $('#newProject').modal('hide');
            } else {
                $('#error_message').removeClass('hide').html(data);
                setTimeout(function() {
                    $('#error_message').addClass('hide');
                }, 3000);
            }
        });
    });

    $('#successPage').on('hidden.bs.modal', function (e) {
        location.reload();
    });

});