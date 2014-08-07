<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php echo $pageTitle ?></title>
    <link href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css" rel="stylesheet"> 
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet"> 
    <link href='<?php echo base_url() ?>/assets/css/fullcalendar.css' rel='stylesheet' />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.js"> </script>
    <script src='<?php echo base_url() ?>/assets/js/moment.min.js'></script>
    <script src='<?php echo base_url() ?>/assets/js/jquery.form.js'></script>
    <script src='<?php echo base_url() ?>/assets/js/fullcalendar.js'></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/new_project.js"></script>

     <?php //var_dump($projects[0]->id);?>
    <script>

    $(document).ready(function() {
      var cal;
      var task;
      var lastProjectId = "<?= $projects[0]->id ?>";
       var dtTable = $('#projectsTable').dataTable(
        { "iDisplayLength": 50,
         "order": [[ 2, "desc" ]],
          "columnDefs": [
            {
                "targets": [0],
                "visible": false
            },
            {
                "targets": [5],
                "visible": false
            },

            ]
          }
        );
       // $.getJSON('../../events/history/'+lastProjectId, function(jsonData) {

       //    cal = $('#calendar').fullCalendar({
       //      defaultDate: d,
       //      events: jsonData,
       //      eventClick: function(event) {

       //      },
       //      dayClick: function(date, jsEvent, view) {
       //        $('#newProject #new_start').val(date.format());
       //        $('#newProject').modal('show');

       //      }
       //    });
       // });
      $('#departmentSelect').change(function(){
        id = $(this).val();
        if($(this).val()!=''){
          option = "<option value>--Select Task--</option>";
          $.post('../../home/getTask/'+id,{},function(data){
           $(data).each(function(i,v){
            option = option + "<option value='"+v.id+"'>"+v.name+"</option>";
           });
           $('#taskSelect').html(option);
           $('#new_task_list_div').removeClass('hide');
          },'json');
        } else {
          $('#new_task_list_div').addClass('hide');
          $('#new_task_submit_div').addClass('hide');
        }
      });

      $('#taskSelect').change(function(){
        id = $(this).val();
        //alert(id);
        if($(this).val()!=''){
          $('#new_task_submit_div').removeClass('hide');
        } else {
          $('#new_task_submit_div').addClass('hide');
        }
      });

      $('#new_task_button').click(function(){
        task_id =  $('#taskSelect').val();
        if(task_id!=''){
          $.post('../../events/addNewTask',{
            "task_id":task_id,
            "project_id":'<?php echo $project->id?>'
          },function(data){
            if(data == 1) {
              alert('Success');
              location.reload();
            }
          });
        }
      });

      var d = new Date();

      var base_url = '<?php echo base_url();?>';

      $('#newProjectLink').click(function(){
        $('#newProject').modal('show');
      });

      $('.task_remove').click(function(){
        url = $(this).attr('data-href');
        name = $(this).parent().parent().find('td').eq(0).html();
        $('#remove_task_name').html(name);
        $('#taskRemoveConfirm .remove').parent().attr("href",url);
        $('#taskRemoveConfirm').modal('show');
      });


      $('#projectsTable tbody').on('click', 'tr', function(event) {
        var aData = dtTable.fnGetData(this); // get datarow
        if (null != aData) // null if we clicked on title row
        {

          $("#taskId").val(aData[0]);
          $("#taskName").html(aData[1]);
          $("#description").val(aData[5]);
          task = aData[1];
          //$("#subTitleLbl").html("Subtitle - <span style='font-size:.9em'>"+aData[1]+"</span>");
          array = aData[1].split('- ');
          if(array.length>1&&array[array.length-1].indexOf('Concept Approval')==-1)
            $('#subtitle').val(array[array.length-1].replace('</span>',''));
          else $('#subtitle').val('');
        }
        if ($(this).hasClass('danger')) {
            $(this).removeClass('danger');
        } else {
            dtTable.$('tr.danger').removeClass('danger');
            $(this).addClass('danger');
        }
    });

    $("#saveForm").submit(function(event) {
        event.preventDefault();

        $.post(base_url+"events/subtitle", {
            taskId: $("#taskId").val(),
            subtitle: $("#subtitle").val(),
            description: $("#description").val()
        }, function(data, textStatus, xhr) {
            if(data == 1){
                $(".bg-success").show(); 
                $("#task"+$("#taskId").val()).html(' - '+$("#subtitle").val());
                //$('#taskName').html('<p class="text-danger">-Please Click the task you want to modify from the left table</p>');
                $("input,textarea").val("");
                setTimeout(function(){
                    $(".bg-success").hide();
                    $('#TaskEdit').modal('hide');
                }, 3000)
                // $(".bg-success").
            }else{
                $(".bg-danger").html(data).show(); 
                 setTimeout(function(){
                    $(".bg-danger").hide();
                }, 3000)
            }
        });
    });

    });

    </script>
  </head>
  <body>
    <!--Calendar-->

    <!--End of Calendar-->
    <!--Table-->
    <div class="col-sm-8 col-sm-offset-2">
      <h2 style="margin-top:-5px;"><?=$project->title?> <small><?=$project->name?></small></h2>
        <div style="margin-bottom:50px;">
          <a class="pull-left" href="../../home"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Project List Page</a>
          <a class="pull-right" href="../../project/<?=$projectId?>" >Go to Project Page <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
        </div>
      <h4><small>Task List Table</small><a class="btn btn-primary pull-right" data-toggle="modal" data-target="#NewTaskCreate">Add New Task<a></h4>
      <hr>
      <table class="table" id="projectsTable" style="width:100%"> 
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Department</th>
                <th>Edit</th>
                <th>Remove</th>
                <th>Description</th>

            </tr>
        </thead>

      <tbody> 
      <?php 
      // var_dump($tasks);die();
      $c = 0;
      foreach ($tasks as $key => $task) {
      ?> 
        <tr id="<?php echo $task->id;?>">
          <td><?php echo $task->id;?></td>
          <?php
              if (!is_null($task->subname) && !empty($task->subname)) {
                  echo "<td>".$task->task_name."<span id='task".$task->id."' > - ".$task->subname."</span></td>";
              }else{
                  echo "<td>".$task->task_name."<span id='task".$task->id."' >".$task->subname."</span></td>";
              }
           ?>
          <td><?php echo $task->department_name;?></td>
          <td><a data-toggle="modal" href="javascript:void(0)" data-target="#TaskEdit"><span class="glyphicon glyphicon-pencil"></span> Edit </a></td>
          <?php //echo '<td><a href="/project/'.$projectId.'"><span class="glyphicon glyphicon-pencil"></span></td>';  ?>
          <td><a class="task_remove" href="javascript:void(0)" data-href="../../events/remove_task/<?=$task->id?>/<?=$project->id?>" style="color:#d9534f"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
          <td><?php echo $task->task_desc;?></td>
        </tr>
      <?php };?>
      </tbody>

      </table>
    </div>
  </body>

</html>
