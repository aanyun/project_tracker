
<div class="col-sm-12 row project_info"> 
  <div class="col-sm-12 project_name">
    <div><span><?php echo $project->title?></span><span><?php echo $project->name?></span></div>
    <!--<h6 class="small"><?php echo $project->desc?></h6>-->
  </div>
  <div class="col-sm-6">
    <div class="desc">
    <dl>
      <dt>Project Description</dt>
      <hr>
      <dd><?=$project->desc?></dd>
    </dl>
    </div>
    <div class="title">Contact Info
      <hr>
    </div>
    <div class="col-sm-6">
      <h4><small><?=$project->name?></small></h4>
      <div class="contactInfo">
        <dl class='contactName'>
          <dt>Contact Name:</dt> 
          <dd><?=$contact->contact_name?></dd>
        </dl>
        <dl class='contactEmail'>
          <dt>Contact Email:</dt>
          <dd><?=$contact->contact_email?></dd>
        </dl>
        <dl class='contactPhone'>
          <dt>Contact Phone:</dt>
          <dd><?=$contact->contact_phone?></dd>
        </dl>
        <a href="javascript:changeContact(<?=$project->client_id?>)">Edit</a>
      </div>
      <div class="contactEdit hide">
        <dl class='contactName'>
          <dt>Contact Name:</dt> 
          <dd><input type="text" value="<?=$contact->contact_name?>" /></dd>
        </dl>
         <dl class='contactEmail'>
          <dt>Contact Email:</dt>
          <dd><input type="email" value="<?=$contact->contact_email?>" /></dd>
        </dl>
        <dl class='contactPhone'>
        <dt>Contact Phone:</dt>
        <dd><input type="phone" value="<?=$contact->contact_phone?>" /></dd>
        </dl>
        <a href="javascript:cancelcontactchange()">Cancel</a> <a href="javascript:saveContact(<?=$project->id?>)">Save</a>
      </div>
    </div>
    <div class="col-sm-6">
      <h4><small>Ignitor Labs</small></h4>
      <div class="ignitorInfo">
        <dl class='ignitorName'>
          <dt>Contact Name:</dt> 
          <dd><?=$project->ignitor_name?></dd>
        </dl>
        <dl class='ignitorEmail'>
          <dt>Contact Email:</dt>
          <dd><?=$project->ignitor_email?></dd>
        </dl>
        <dl class='ignitorPhone'>
          <dt>Contact Phone:</dt>
          <dd><?=$project->ignitor_phone?></dd>
        </dl>
<!--         <a href="javascript:changeContact(<?=$project->client_id?>)">Edit</a> -->
      </div>
    </div>
  </div>



  <div class="col-sm-6">
    <div class="title">Project Progress
      <hr>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div >
          <dl class="col-sm-6" style="padding-left:0px">
            <dt>Production Start Date:</dt>
            <dd style="margin-bottom:15px"><?php echo ($project->production_start!=null||$project->production_start!='')?date('M d, Y ga', strtotime($project->production_start)):"Not Started";?></dd>
          </dl>
          <dl class="col-sm-6" style="padding-left:0px">
            <dt>Total Production Hours:</dt>
            <dd style="margin-bottom:15px"><?php echo $elapsedTime;?> h</dd>
          </dl>
        </div>
        <div><b>Project Overall Progress</b>: <span><?=$overallprogress?>%</span></h2></div>
        <div class="progress">
          <div class="progress-bar progress-bar-success" data-toggle="tooltip" data-placement="top" title="Instructional Dept" style="width: <?php echo ($counter[0]/$totalTasks)*100?>%">
            <?php echo round(($counter[0]/$totalTasks)*100,2)?>%
          </div>
          <div class="progress-bar progress-bar-info" data-toggle="tooltip" data-placement="top" title="3D Dept" style="width: <?php echo ($counter[1]/$totalTasks)*100?>%">
            <?php echo round(($counter[1]/$totalTasks)*100,2)?>%
          </div>
          <div class="progress-bar progress-bar-warning" data-toggle="tooltip" data-placement="top" title="Flash Dept" style="width: <?php echo ($counter[2]/$totalTasks)*100?>%">
            <?php echo round(($counter[2]/$totalTasks)*100,2)?>%
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-4" style="padding-left:0px;padding-right:10px">
          <div><b>Instructional Design</b></div>
          <div class="progress"> 
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $instructionalprogress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $instructionalprogress?>%;">
              <?php echo $instructionalprogress?>%
            </div>
          </div>
        </div>
        <div class="col-sm-4" style="padding-left:10px;padding-right:10px">
          <div><b>3D Modeling</b></div>
          <div class="progress">
            <div class="progress-bar  progress-bar-info" role="progressbar" aria-valuenow="<?php echo $threeDprogress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $threeDprogress?>%;">
              <?php echo $threeDprogress?>%
            </div>
          </div>
        </div>
        <div class="col-sm-4" style="padding-left:10px;padding-right:0px">
          <div><b>Flash Development</b></div>
          <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $flashprogress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $flashprogress?>%;">
              <?php echo $flashprogress?>%
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





<!-- <div class="col-sm-12 row client_alert">  
<div class="col-sm-4 h1_alert">
<p><img src="../../assets/img/alert.png" alt="Client Action Required!">
<span style="position: relative; margin-left: 18px; top:2px; ">Client Action Required!</span></p>
</div>

<div class="col-sm-8 p_alert">
<p>The Ignitor Labs development team is waiting for a response or action from the client! In order to 
keep this project on track, please complete all of the priority client tasks listed.</p>
</div>


</div> -->



<div class="col-sm-12 row instructions">
      <dl>
      <dt data-toggle="collapse" data-target="#instruction"><a href="javascript:void(0)"><i class="glyphicon glyphicon-exclamation-sign"></i>  Instructions</a></dt>
      <dd id="instruction" class="collapse">Complete the tasks below as they are requested. There are two ways to 
        update a task: In the "History" table, click on the 
        <i class="glyphicon glyphicon-pencil"></i> under the "Current Status" 
        column to bring up a form to input updates. In the "Current Tasks" section, 
        click the task box to bring up a form to input updates. An email will be
        sent to the development team or client each time a task is updated. <br />
        
        <br />If you have questions, contact our support team at <a href="mailto:support@ignitorlabs.com?subject=Ignitor Labs Project Tracker">support@ignitorlabs.com</a>
      </dd>
    </dl>
</div>     

</div>
