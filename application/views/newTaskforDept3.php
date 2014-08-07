<div id="Dept3AddNew" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add New Task</h4>
      </div>
      <div class="modal-body">
        <?php if($counter2[2]==$counter_total[2]) {?>
        <div>No more task for this department</div>
        <?php }else {?>
        <form enctype="multipart/form-data" action="../events/add" method="post">
              <input type="hidden" name= "project_id" value="<?php echo $project_id?>">
              <div>
                <select data-department="3" name='project_task_select'>
                <?php 
                $first_task = 0;
                foreach ($project_tasks_data as $task){
                  if($task->d_id == 3&&($task->start_time == null||$task->start_time == "")) {
                    if($first_task==0) $first_task = $task->task_id;
                  ?>
                  <option data-taskid="<?php echo $task->task_id?>" value="<?php echo $task->id?>">
                    <?php 
                      echo $task->task_name;
                      if($task->subname!=null&&trim($task->subname)!=""){
                        echo " - ".$task->subname;
                      }
                    ?>
                  </option>
                  <?php
                  }
                }
                ?>
                </select>
              </div>
              <div>
                <?php 
                $first = $first_task;
                //print_r($task_status[$first]);
                ?>
                <select data-department="3" name='status_select'>
                <?php 
                foreach ($task_status[$first] as $value){
                  ?>
                  <option value="<?php echo $value['id']?>"><?php echo $value['status']?></option>
                  <?php
                }
                ?>
                </select>
              </div>
                <div class="form-group">
                  <label for="desc">Note</label>
                  <textarea class="form-control"  name = "desc" placeholder="More Details or Review of this status"></textarea>
                </div>
                <div class="form-group">
                  <label for="File">File input</label>
                  <input type="file" name="uploadfile" class="file" id="userfile">
                  <p class="help-block">Only accept .zip</p>
                </div>
              
            </form>            
            <button type="button" class="addnew btn btn-success">Add</button>
          <?php }?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
