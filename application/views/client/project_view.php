
   <!-- <div class='col-sm-12 row' style="margin-left:0px">
      <hr style="border-width:5px 0 0"> 
    </div> -->
    <div class='col-sm-12 row sortby'>
      <ul class="nav nav-tabs" role="tablist">
        <li><p><strong>Sort by:</strong></p></li>
        <li><a href="#currentTasks" role="tab" data-toggle="tab">Current Tasks</a></li>
        <li><p>  |</p></li>
        <li><a href="#historyTasks" role="tab" data-toggle="tab">Completed Tasks</a> </li>
        <li><p>  |</p></li>
        <li class="active"><a href="#activities" role="tab" data-toggle="tab">History</a></li>
      </ul>
    </div>

    <div class="tab-content">
<!--Completed Task-->
    <div id="historyTasks" class='col-sm-12 row tab-pane hist' style="margin-left:0px">
    <div class="col-sm-4"> 
      <h3 class="panel-title">Instructional Design Department</h3>   
        <?php 
        foreach($activities as $key=>$event){
          $event = array_pop($event);
          if($event->department_id==1&&$event->task_end_time!=null){
          ?>
            <div class="panel panel-default panel-history" data-id="<?php echo $key?>">
              <div class="panel-body">
                <p class="title"><?php echo $event->task_name.' '.$event->task_sub_name;?></p>
                <div class="status">Completed</div>
                <div class="time"><?php echo date('M d,Y ga', strtotime($event->task_start_time));?>  -  <?php echo date('M d,Y ga', strtotime($event->task_end_time));?></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
       
      </div>
      <div class="col-sm-4">
        <h3 class="panel-title">3D Department</h3>
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==2&&$event->task_end_time!=null){
          ?>
            <div class="panel panel-default panel-history" data-id="<?php echo $key?>">
              <div class="panel-body">
                <p class="title"><?php echo $event->task_name.' '.$event->task_sub_name;?></p>
                <div class="status">Completed</div>
                <div class="time"><?php echo date('M d,Y ga', strtotime($event->task_start_time));?>  -  <?php echo date('M d,Y ga', strtotime($event->task_end_time));?></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
      </div>
      <div class="col-sm-4">
        <h3 class="panel-title">Flash Department</h3>
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==3&&$event->task_end_time!=null){
          ?>
            <div class="panel panel-default panel-history" data-id="<?php echo $key?>">
              <div class="panel-body">
                <p class="title"><?php echo $event->task_name.' '.$event->task_sub_name;?></p>
                <div class="status">Completed</div>
                <div class="time"><?php echo date('M d,Y ga', strtotime($event->task_start_time));?>  -  <?php echo date('M d,Y ga', strtotime($event->task_end_time));?></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
       
      </div>
    </div>
<!--End of Completed Task-->
<!--Current Task-->
    <div id="currentTasks" class='col-sm-12 row tab-pane hist' style="margin-left:0px">
      <div class="col-sm-4 bg-success"> 
      <h3 class="panel-title">Instructional Design Department</h3>   
          <!--Current Task-->
        <?php 
        foreach($activities as $key=>$event){
          $event = array_pop($event);
          if($event->department_id==1&&$event->task_end_time==null){
          ?>
            <div class="panel panel-default current_task" data-id="<?php echo $key?>">
              <div class="panel-body">
                <h4>
                  <?php echo $event->task_name.' '.$event->task_sub_name;
                    if($event->isClient == 0&&$event->feedback_required)
                      echo '<span class="text-danger glyphicon glyphicon-pencil pull-right"></span>';
                  ?>
                </h4>
                <div><b>Status: </b><?php echo $event->status_name;?><span class="timeElapse_page pull-right" data='<?php echo $event->start_time?>'></span></div>
              </div>
            </div>
          <?php
          }
        }
        ?>     
      </div>
      <div class="col-sm-4 bg-info">
        <h3 class="panel-title">3D Department</h3>
          <!--Current Task-->
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==2&&$event->task_end_time==null){
          ?>
            <div class="panel panel-default current_task" data-id="<?php echo $key;?>">
              <div class="panel-body">
                <h4>
                  <?php echo $event->task_name.' '.$event->task_sub_name;
                    if($event->isClient == 0&&$event->feedback_required)
                      echo '<span class="text-danger glyphicon glyphicon-pencil pull-right"></span>';
                  ?>
                </h4>
                <div><b>Status: </b><?php echo $event->status_name;?><span class="timeElapse_page pull-right" data='<?php echo $event->start_time?>'></span></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
      </div>
      <div class="col-sm-4 bg-warning">
        <h3 class="panel-title">Flash Department</h3>
          <!--Current Task-->
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==3&&$event->task_end_time==null){
          ?>
            <div class="panel panel-default current_task" data-id="<?php echo $key;?>">
              <div class="panel-body">
                <h4>
                  <?php echo $event->task_name.' '.$event->task_sub_name;
                    if($event->isClient == 0&&$event->feedback_required)
                      echo '<span class="text-danger glyphicon glyphicon-pencil pull-right"></span>';
                  ?>
                </h4>
                <div><b>Status: </b><?php echo $event->status_name;?><span class="timeElapse_page pull-right" data='<?php echo $event->start_time?>'></span></div>
              </div>
            </div>
          <?php
          }
        }
        ?>      
      </div>
    </div>

