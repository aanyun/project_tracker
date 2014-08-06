<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php echo $pageTitle ?></title>
    <link href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css" rel="stylesheet"> 
    <link href="../assets/css/bootstrap.css" rel="stylesheet"> 
    <link href='../assets/css/fullcalendar.css' rel='stylesheet' />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.js"> </script>
    <script src='../assets/js/moment.min.js'></script>
    <script src='../assets/js/jquery.form.js'></script>
    <script src='../assets/js/fullcalendar.js'></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/new_project.js"></script>

     <?php //var_dump($projects[0]->id);?>
    <script>

    $(document).ready(function() {
      var cal;
      var lastProjectId = "<?= $projects[0]->id ?>";
      //dtTable = $('#projectsTable').dataTable();
       dtTable = $('#projectsTable').dataTable(
        {"order": [[ 0, "desc" ]],
          "columnDefs": [
            {
                "targets": [0],
                "visible": false
            },
             {
              "targets": [1],
              "width": "280px"
                
            },
            {
              "targets": [3]
              // "width": "10px"
                
            },
            {
              "targets": [4],
              "width": "100px"
                
            },
                        {
              "targets": [5],
              "width": "100px"
                
            }

            ]
          }
        );
       $.getJSON('../events/history/'+lastProjectId, function(jsonData) {
          //console.log(jsonData);
          cal = $('#calendar').fullCalendar({
            defaultDate: d,
            events: jsonData,
            eventClick: function(event) {

            }
          });
       });

      var d = new Date();

      $('a.remove_project').click(function(){
        url = $(this).attr('data-href');
        name = $(this).parent().parent().find('td').eq(0).html();
        $('#projectRemoveConfirm .remove').parent().attr("href",url);
        $('#remove_project_name').html(name);
        $('#projectRemoveConfirm').modal('show');
      });

      $('#newProjectLink').click(function(){
         $('#newProject').modal('show');
      });

      $('#projectsTable tbody').on('click', 'tr', function(event) {
        var aData = dtTable.fnGetData(this); // get datarow
        if (null != aData) // null if we clicked on title row
        {

          cal.fullCalendar( 'removeEvents');
          cal.fullCalendar( 'addEventSource', '../events/history/'+aData[0] );

        }
        if ($(this).hasClass('danger')) {
            $(this).removeClass('danger');
        } else {
            dtTable.$('tr.danger').removeClass('danger');
            $(this).addClass('danger');
        }
    });

    });

    </script>
  </head>
  <body>
    <!--Calendar-->
    <div class="col-sm-5">

      <div id='calendar'></div>
    </div>
    <!--End of Calendar-->
    <!--Table-->
    <div class="col-sm-7">
      <div>
        <h3>Project List</h3>
        <hr>
      </div>
      <table class="table" id="projectsTable"> 
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Client</th>
                <th>Start Date</th>
                <th>Production Start Date</th>
                <th>Tasks Detail</th>
                <th>Remove</th>
                <th>Project Detail</th>
                
            </tr>
        </thead>

      <tbody> 
      <?php 
      $c = 0;
      //print_r($projects);
      foreach ($projects as $key => $project) {
      ?> 
        <tr id="<?php echo $project->id;?>">
          <td><?php echo $project->id;?></td>
          <?php
            if($key == 0)
              // <span style='font-size: .9em;'class='glyphicon glyphicon-ok'> </span>
                echo "<td> ".$project->title."</td>";
            else
              echo "<td>".$project->title."</td>";
           ?>
          <td><?php echo $project->name;?></td>
          <td>
          <?php 
          $dt = (is_null($project->start) || $project->start == "0000-00-00 00:00:00" ) ? "----" : date("m/d/Y H:i", strtotime($project->start));
          echo $dt;
          ?>
          </td>
          <td><?php echo ($project->production_start!="")?date("m/d/Y H:i", strtotime($project->production_start)):'----';?></td>
          <?php echo '<td ><a href="../home/task/'.$project->id.'"><span class="glyphicon glyphicon-th-list"></span></td>';  ?>
          <td><a href="javascript:void(0)" class="remove_project" data-href="events/remove_project/<?=$project->id?>" style="color:#d9534f"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
          <?php echo '<td><a href="/project/'.$project->id.'"><span class="glyphicon glyphicon-circle-arrow-right"></span></td>';  ?>
          
        </tr>
      <?php };?>
      </tbody>

      </table>
    </div>
  </body>

</html>
