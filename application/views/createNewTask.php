<div id="NewTaskCreate" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add New Task</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
        <div class="form-group">
        <label class="col-sm-3">Department: </label>
        <select class="col-sm-5" id="departmentSelect" name='department'>
          <option value>--Select Department--</option>
          <option value="1">Instructional Design Department</option>
          <option value="2">3D Department</option>
          <option value="3">Flash Department</option>
        </select>
        </div>
        <div id="new_task_list_div" class="form-group hide">
        <label class="col-sm-3">Task: </label>
        <select class="col-sm-5" id="taskSelect" name='department'>
        </select>
        </div>
        </form>
        <div id="new_task_submit_div" class="hide">
          <button class="btn btn-info" id="new_task_button">Create</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
