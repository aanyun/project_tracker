<!--History-->
    <div id="activities" class='col-sm-12 row tab-pane active hist'>
      <div class="download_option">
        <a download="Project_Tracker.xls" href="#" onclick="return ExcellentExport.excel(this, 'datatable', 'Sheet Name Here');">
          <span class="glyphicon glyphicon-save"></span> Download
        </a>


        <a href="javascript:window.print()"><span class="glyphicon glyphicon-print"></span> Print</a>

      </div>


      <div class="history_styles hist">

      <table class="table table-bordered" id="datatable">
        <thead>
          <tr><th>Task Name</th><th>Last Status by<br>Ignitorlabs</th><th>Last Status by<br> <?=$project->name?></th><th>Start Time</th><th>End Time</th><th>Status<br />Elapsed Time</th><th>Task<br />Elapsed Time</th></tr>
        </thead>
        <tbody>
          <?php 
          $project_tasks_by_department = array();
          foreach($project_tasks_data as $key=>$value){
            $project_tasks_by_department[$value->d_id][] = $value;
          }
          $color_list = array('success','info','warning');
          for( $i=1;$i<=3;$i++){
          if(array_key_exists($i,$project_tasks_by_department)){
          echo "<tr class='".$color_list[$i-1]."'><td colspan='7' class='text-center'>".$project_tasks_by_department[$i][0]->department_name."</td></tr>";
          foreach($project_tasks_by_department[$i] as $project_task){
            if(is_null($project_task->start_time)||$project_task->start_time=="")
            
            echo "<tr class='unactivate'>
            <td style='width:340px;'>".$project_task->task_name." ".$project_task->subname."</td>
            <td>Not Started</td>
            <td></td>
            <td></td>
            <td></td>
            <td style='width: 110px;'></td>
            <td  style='width: 110px;'></td>
            </tr>";
            else {
            $copy_activities = $activities;
            $progress = $copy_activities[$project_task->id]; 
            $lastStatus = array_pop($copy_activities[$project_task->id]);
//get ignitorlabs last status
            if($lastStatus->isClient == 1) {
              $client_last_status = $lastStatus->status_name; 
              while(count($copy_activities[$project_task->id])>0){
                $search = array_pop($copy_activities[$project_task->id]);
               
                  if($search->isClient==0){
                    $ignitorlabs_last_status = $search->status_name; 
                    break;
                  } 
                
              }
            } else {
              $ignitorlabs_last_status = $lastStatus->status_name; 
              $client_last_status = "";
              if($ignitorlabs_last_status=="Completed"){
                $client_last_status = "-";
                while(count($copy_activities[$project_task->id])>0){
                $search = array_pop($copy_activities[$project_task->id]);
               
                  if($search->isClient==1){
                    $client_last_status = $search->status_name; 
                    break;
                  } 
                
                }
              }
            }


//get client last status





            $datetime1 = date_create($lastStatus->start_time);
            $datetime2 = date_create();
            $interval = date_diff($datetime1, $datetime2);
            $elapsedtime = $interval->format('%h h %i m'); 
            if($lastStatus->status_name == "Completed") {
              $elapsedtime = '-';
            }
            $status ='';
            if(($isAdmin == 1&&$lastStatus->isClient == 0&&$ignitorlabs_last_status!="Completed")||($isAdmin==0&&$lastStatus->isClient == 1)){
              $status = '<div class="current_task" data-id="'.$project_task->id.'">'.$lastStatus->status_name."<span class='glyphicon glyphicon-pencil pull-right'></span></div>";
            } 
            // else if($lastStatus->status_name == "Completed"&&$isAdmin==1) {
            //   $status = '<div class="current_task" data-id="'.$project_task->id.'"><span class="text-success">'.$lastStatus->status_name."</span><span class='glyphicon glyphicon-pencil pull-right'></span></div>";
            // } 
            else if($lastStatus->status_name == "Completed") {
              $status ='<span class="text-success">Completed</span>';
            } else{
              $status = $lastStatus->status_name;
            }


            if(($isAdmin == 1&&$lastStatus->isClient == 0)||($lastStatus->isClient == 0&&$lastStatus->feedback_required==0)){
              $takenby="<td>".$status."</td><td>".$client_last_status."</td>";
            } else if($lastStatus->isClient == 0&&$lastStatus->feedback_required==1){
              $takenby="<td>".$status.'</td><td><div class="current_task" data-id="'.$project_task->id.'">'.$client_last_status.'<span class="glyphicon glyphicon-pencil pull-right" style="color:#d44950"></span></td>';
            } else if (($isAdmin == 1&&$lastStatus->isClient == 1)){
                $takenby='<td><div class="current_task" data-id="'.$project_task->id.'">'.$ignitorlabs_last_status.'<span class="glyphicon glyphicon-pencil pull-right" style="color:#d44950"></span></td><td>'.$status."</td>";
            }
            else {
              $takenby="<td>".$ignitorlabs_last_status."</td><td>".$status."</td>";
            }
            $end_time = ($project_task->end_time!=null)?date('m/d/y h:ia',strtotime($project_task->end_time)):'';
            echo "<tr class='active_task' data-project_tast_id ='".$project_task->id."'>
            <td style='width:340px;'>".$project_task->task_name." ".$project_task->subname;
            echo (count($progress)>1)?"<span class='glyphicon glyphicon-eye-open pull-right'></span>":"";
            echo "</td>".$takenby."
            <td>".date('m/d/y h:ia',strtotime($project_task->start_time))."</td>
            <td>".$end_time."</td>";
            if($project_task->end_time=="")
            echo "<td class='text-primary'>".$elapsedtime."</td>";
            else echo "<td style='width: 110px;'>".$elapsedtime."</td>";
            $diff = date_diff(date_create($project_task->start_time),date_create($project_task->end_time));
            echo "<td  style='width: 110px;'>".(($diff->format('%a')*24)+$diff->format('%h'))." h ".$diff->format('%i')." m</td>";
            echo "</tr>";

            if(count($progress)>1){
            foreach($progress as $subtask){
              if($subtask->isClient == 0){
                $takenby="<td>".$subtask->status_name."</td><td></td>";
              } else {
                $takenby="<td></td><td>".$subtask->status_name."</td>";
              }
              $end_time = ($subtask->end_time!=null)?date('m/d/y h:ia',strtotime($subtask->end_time)):'';
              $datetime1 = date_create($subtask->start_time);
              $datetime2 = date_create($subtask->end_time);
              $interval = date_diff($datetime1, $datetime2);
              $elapsedtime = $interval->format('%h h %i m');
              if($subtask->status_name == "Completed") $elapsedtime = '-';
                echo "<tr class='hide progress' data-project_tast_id ='".$project_task->id."' >
                      <td style='width:340px;'></td>
                      ".$takenby."
                      <td>".date('m/d/y h:ia',strtotime($subtask->start_time))."</td>
                      <td>".$end_time."</td>
                      <td style='width: 110px;'>".$elapsedtime."</td>
                      <td  style='width: 110px;'></td>
                    </tr>";
              }
            }
          }

          }
        }}
          ?>
        </tbody>
      </table>

</div> <!--end history styles -->

    </div>

  </div>