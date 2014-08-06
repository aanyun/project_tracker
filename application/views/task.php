<div id="taskDetail" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="current_status"></div>
        <hr>
        <div class="action">
          <form enctype="multipart/form-data" action="../events/newStatus" method="post">
          <div style="font-size:1.2em;color:gray;margin-bottom:15px;margin-top:-15px">Update Status</div>
          <div class="form-group">
            <div class="options"></div>
          </div>
          <div class="form-group">
            <label for="desc">Note</label>
            <textarea class="form-control"  name = "desc" placeholder="More Details about this Status or Review"></textarea>
          </div>
          <div class="form-group">
            <label for="File">Upload File</label>
            <input type="file" name="uploadfile" class="file" id="userfile">
            <p class="help-block">Only accept .zip</p>
          </div>
          </form>
          <div class="form-group">
            <button class="submitNewStatusButton btn btn-info">Submit</button>
          </div>
        </div>
        <hr>
        <div class="history"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
