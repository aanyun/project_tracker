<link href="<?php echo base_url() ?>assets/css/datepicker.css" rel="stylesheet" type="text/css" />
<div class="modal fade" id="newProject">
  <div class="modal-dialog">
    <div class="modal-content" id="projectDetails">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Create New Project</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger hide" id="error_message" role="alert"></div>
        <form id="newProjectForm" class="form-horizontal" action="home/newProject" method="post" role="form">
          
          <div id="step1">
            <div class="form-group">
              <label for="new_title" class="col-sm-3 control-label">Project Title</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="new_title" name="new_title" placeholder="Title">
              </div>
            </div>
            <div class="form-group">
              <label for="new_end" class="col-sm-3 control-label">Project Description</label>
              <div class="col-sm-9">
                <textarea class="form-control" id="new_desc" name="new_desc" placeholder="Description"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="new_end" class="col-sm-3 control-label">Client</label>
              <div class="col-sm-9">
                <select id="clientList" name="client">
                  <option value="" selected>----------------</option>
                  <?php 
                  foreach($clients as $client){
                    ?>
                    <option value="<?php echo $client->id?>"><?php echo $client->name;?></option>
                    <?php 
                  }
                  ?>
                </select>
                <a href="javascript:void(0);" id="newClientLnk">New Client</a>
              </div>
            </div>

            <div class="form-group">
              <label for="new_end" class="col-sm-3 control-label">Contact</label>
              <div class="col-sm-9">
                <select id="contactList" name="contactList">
                <option value="" selected>----------------</option>
                </select>
                
              </div>
            </div>

        
              <!-- start new client container -->
                <div id="newClientCont" style="display:none">
                <!-- <form id="newClientForm" class="form-horizontal" action="home/newProject" method="post" role="form"> -->
                  <div class="form-group">
                    <label for="new_title" class="col-sm-3 control-label">Client</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client">
                    </div>
                  </div>
        <!--           <div class="form-group">
                    <label for="new_end" class="col-sm-3 control-label">Notes</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="notes" name="notes" placeholder="Notes"></textarea>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="new_title" class="col-sm-3 control-label">Contact Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contactName" name="contactName" placeholder="Contact Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="new_title" class="col-sm-3 control-label">Phone #</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contactPhone" name="contactPhone" placeholder="Phone Number">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="new_title" class="col-sm-3 control-label">E-Mail</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contactEmail" name="contactEmail" placeholder="E-Mail">
                    </div>
                     <label for="new_title" class="col-sm-3 control-label"></label>
                      <div class="col-sm-9">
                      <button style="margin-top:10px;" id="newClientBtn" type="button" class="btn btn-primary">Create Client</button>
                      <div class="alert alert-dismissable alert-success" id="clientNotification1" style="margin-top:10px; display:none"></div>
                      <div class="alert alert-dismissable alert-danger" id="clientNotification2" style="margin-top:10px; display:none"></div>

                    </div>
                  </div>
                </div> 
              <!-- end new client container -->
          </div>

          <div id="step2" style="display:none">
            <h4>Ignitor Labs Contact Info</h4>
            <div class="form-group">
              <label for="new_title" class="col-sm-3 control-label">Contact Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ignitorName" name="ignitorName" placeholder="Contact Name">
              </div>
            </div>
            <div class="form-group">
              <label for="new_title" class="col-sm-3 control-label">E-Mail</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ignitorEmail" name="ignitorEmail" placeholder="E-Mail">
              </div>
            </div>
            <div class="form-group">
              <label for="new_title" class="col-sm-3 control-label">Phone #</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ignitorPhone" name="ignitorPhone" placeholder="Phone Number">
              </div>
            </div>

          </div>

          <div id="step3" style="display:none">
            <!-- accordion -->
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      <label>Step 1</label> Instructional Design Department
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <!-- body Instructional -->
                      <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" id="checkAllIns" value="">
                        <b>Check all</b>
                      </label>
                    </div>

                     <div class="checkbox">
                      <label>
                        <input name="clientMeetingInsChk" class="checkbox1" type="checkbox" value="1">
                       Client Meeting - Concept Approval
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="trainingDesignInsChk" class="checkbox1" type="checkbox" value="2" >
                        Training Design Document
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="contractInsChk" class="checkbox1" type="checkbox" value="3" >
                        Contract for Project
                      </label>
                    </div>
                      <div class="checkbox">
                      <label>
                        <input name="lessonInsChk" class="checkbox1" type="checkbox" value="4" >
                        Lesson Script 
                      </label>
                      <input style="margin-left:5px" id="instLessQty" name="instLessQty" maxlength="2" size="2" type="text" value="1"/>
                    </div>
                      <div class="checkbox">
                      <label>
                        <input name="finalExamInsChk" class="checkbox1" type="checkbox" value="5" >
                        Final Exam Script
                      </label>
                    </div>
                      <div class="checkbox">
                      <label>
                        <input name="storyboardInsChk" class="checkbox1" type="checkbox" value="6" >
                        Storyboard Development
                      </label>
                    </div>

                      </div>
                    </div><!-- row-->
                    <!-- end body Instructional -->
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    <label>Step 2</label> 3D Department
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body">
                       <div class="row">
                      <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" id="checkAll3D" value="">
                        <b>Check all</b>
                      </label>
                    </div>
                     <div class="checkbox">
                      <label>
                        <input name="reviewClient3DChk" class="checkbox2" type="checkbox" value="7">
                        Review client files for completion
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="modeling3DChk" class="checkbox2" type="checkbox" value="8" >
                        3D modeling
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="modelReview3DChk" class="checkbox2" type="checkbox" value="9" >
                        Model Review (Wireframe for placement)
                      </label>
                    </div>
                      <div class="checkbox">
                      <label>
                        <input name="detailAndTexturing3DChk" class="checkbox2" type="checkbox" value="10" >
                        3D detailing & texturing
                      </label>
                    </div>
                      <div class="checkbox">
                      <label>
                        <input name="modelReview23DChk" class="checkbox2" type="checkbox" value="11" >
                        Model review (Full details)
                      </label>
                    </div>
                      <div class="checkbox">
                      <label>
                        <input name="rendering3DChk" class="checkbox2" type="checkbox" value="12" >
                        Rendering
                      </label>
                    </div>

                      </div>
                    </div><!-- row-->
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    <label>Step 3</label> Flash Department
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                  <div class="panel-body">
                        <div class="row">
                      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="checkAllFlash" value="">
                        <b>Check all</b>
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="logoBrandingFlChk" class="checkbox3" type="checkbox" value="13">
                        Received Logo and Branding Standards from Client
                      </label>
                    </div>
                     <div class="checkbox">
                      <label>
                        <input name="userInterfaceFlChk" class="checkbox3" type="checkbox" value="14">
                        User Interface Design
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="lessonProgressFlChk" class="checkbox3" type="checkbox" value="15">
                        Lesson Progress
                      </label>
                      <input style="margin-left:5px" name="flLessQty" id="flLessQty" maxlength="2" size="2" type="text" value="1"/>

                    </div>

                   
                      </div>
                    </div><!-- row-->
                  </div>
                </div>
              </div>
            </div> 
        <!-- end accordion -->
          </div>
        </form>
      </div> <!--end modal body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="close_new" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" style="display:none" id="backBtn">Back</button>
        <!-- <button type="button" class="btn btn-primary" id="submit_new_project">Create Project</button> -->
        <button type="button" class="btn btn-primary" id="nextBtn">Next Step</button>
        <button type="button" class="btn btn-primary" style="display:none" id="submit_new_project">Create Project</button>

      </div>

<!-- </form>
    <!-- end new client container -->
<!--       </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" id="submit_new_project">Create Project</button>
      </div> -->
    </div><!-- /.modal-content next step --> 

  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


