<div id="TaskEdit" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Edit Task</h4>
      </div>
      <div class="modal-body">
        <p class="bg-success" style="display:none">Update succesfully!</p>
        <p class="bg-danger" style="display:none"></p>

        <form role="form" id="saveForm">
          <label>Task Name</label>
          <div id="taskName"><p class="text-danger"></p></div>
            <input type="hidden" id="taskId" value='' />
          <div class="form-group">
            <label for="exampleInputEmail1" id="subTitleLbl">Subtitle</label>
            <input type="text" class="form-control" id="subtitle" placeholder="Enter the subtitle">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea id="description" placeholder="Enter the description" class="form-control" rows="2"></textarea>
          </div>

          <button type="submit" class="btn btn-default">Save</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
