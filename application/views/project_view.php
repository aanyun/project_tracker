
   <!-- <div class='col-sm-12 row' style="margin-left:0px">
      <hr style="border-width:5px 0 0"> 
    </div> -->
    <div class='col-sm-12 row sortby'>
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#activities" role="tab" data-toggle="tab">History</a></li>
        <li><a href="#currentTasks" role="tab" data-toggle="tab">Current Tasks / Start Task</a></li>
        <li><a href="#historyTasks" role="tab" data-toggle="tab">Completed Tasks</a></li>
      </ul>
    </div>

    <div class="tab-content">
<!--Completed Task-->
    <div id="historyTasks" class='col-sm-12 row tab-pane hist'>
    <div class="col-sm-4"> 
      <h3 class="panel-title">Instructional Design</h3>  
        <?php 
        foreach($activities as $key=>$event){
          $event = array_pop($event);
          if($event->department_id==1&&$event->task_end_time!=null){
          ?>
            <div class="panel panel-default panel-history" data-id="<?php echo $key?>">
              <div class="panel-body">
                <h4><?php echo $event->task_name.' '.$event->task_sub_name;?></h4>
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
        <h3 class="panel-title">3D Modeling</h3>
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==2&&$event->task_end_time!=null){
          ?>
            <div class="panel panel-default panel-history" data-id="<?php echo $key?>">
              <div class="panel-body">
                <h4><?php echo $event->task_name.' '.$event->task_sub_name;?></h4>
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
        <h3 class="panel-title">Flash Development</h3>
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==3&&$event->task_end_time!=null){
          ?>
            <div class="panel panel-default panel-history" data-id="<?php echo $key?>">
              <div class="panel-body">
                <h4><?php echo $event->task_name.' '.$event->task_sub_name;?></h4>
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

    <div id="currentTasks" class='col-sm-12 row tab-pane hist'>
      <div class="col-sm-4 bg-success"> 
     <h3 class="panel-title">Instructional Design</h3>  
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
                    if($event->isClient == 1)
                      echo '<span class="text-danger glyphicon glyphicon-flag pull-right"></span>';
                  ?>
                </h4>
                <div><b>Status: </b><?php echo $event->status_name;?><span class="timeElapse_page pull-right" data='<?php echo $event->start_time?>'></span></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
          <!--Create New-->
        <div class="create_new_task panel panel-success" data-toggle="modal" data-target="#Dept1AddNew">
          <div class="panel-body">
            <div class="add-title"><span class="glyphicon glyphicon-plus-sign"></span> Start Task</div>
          </div>
        </div>
       
      </div>
      <div class="col-sm-4 bg-info">
        <h3 class="panel-title">3D Modeling</h3>
          <!--Current Task-->
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==2&&$event->task_end_time==null){
          ?>
            <div class="panel panel-default current_task" data-id="<?php echo $key;?>">
              <div class="panel-body">
                <h4><?php echo $event->task_name.' '.$event->task_sub_name;?></h4>
                <div><b>Status: </b><?php echo $event->status_name;?><span class="timeElapse_page pull-right" data='<?php echo $event->start_time?>'></span></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
          <!--Create New-->
        <div class="create_new_task panel panel-info" data-toggle="modal" data-target="#Dept2AddNew">
          <div class="panel-body">
            <div class="add-title"><span class="glyphicon glyphicon-plus-sign"></span> Start Task</div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 bg-warning">
        <h3 class="panel-title">Flash Development</h3>
          <!--Current Task-->
        <?php 
        foreach($activities as $key=>$event){
           $event = array_pop($event);
          if($event->department_id==3&&$event->task_end_time==null){
          ?>
            <div class="panel panel-default current_task" data-id="<?php echo $key;?>">
              <div class="panel-body">
                <h4><?php echo $event->task_name.' '.$event->task_sub_name;?></h4>
                <div><b>Status: </b><?php echo $event->status_name;?><span class="timeElapse_page pull-right" data='<?php echo $event->start_time?>'></span></div>
              </div>
            </div>
          <?php
          }
        }
        ?>
          <!--Create New-->
        <div class="panel panel-warning create_new_task" data-toggle="modal" data-target="#Dept3AddNew">
          <div class="panel-body">
            <div class="add-title"><span class="glyphicon glyphicon-plus-sign"></span> Start Task</div>
          </div>
        </div>        
      </div>
    </div>



   

