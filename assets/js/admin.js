$('.current_task,.panel-history').click(function(){
  id = parseInt($(this).attr('data-id'));
  activities = taskDetails[id];
  taskDetail = activities[activities.length-1];
  console.log(activities);
  // $(taskDetails).each(function(key,val){
  //   taskid = parseInt(val.id);
  //   if(id == taskid){
      options = '';
      $(task_status[taskDetail.task_id]).each(function(skey,sval){
        if(sval.id == taskDetail.status_id) options = options + "<option value='" + sval.id + "' disabled>" + sval.status + "</option>";
        else options = options + "<option value='" + sval.id + "'>" + sval.status + "</option>";
      });
  if(taskDetail.task_sub_name == null) taskDetail.task_sub_name = '';
  if(taskDetail.note == null || taskDetail.note == "") taskDetail.note = '';
  if(taskDetail.file_url == null||taskDetail.file_url == "") file_url = '';
  else {
    file_url = '<a href="../'+taskDetail.file_url+'"><span class="glyphicon glyphicon-paperclip"></span> Download Attachment</a>';
  }
  if(taskDetail.task_desc == null) taskDetail.task_desc = '';
  $('#taskDetail .modal-title').html('<b>Task: </b> '+taskDetail.task_name+' '+taskDetail.task_sub_name);
  $('#taskDetail .modal-body .current_status').html(
                                  '<div class="desc_task">'+taskDetail.task_desc+'</div>'
                                  +'<div><b>Current Status:  <span class="c_status_text">'+taskDetail.status_name+'</span></b> <span class="department_text">'+taskDetail.department_name+'</span></div>'
                                  +'<div><b>Status Begin At:</b> '+moment(taskDetail.start_time,"YYYY-MM-DD HH:mm:ss").format('MMM,D YYYY ha')+' <span class="timeelapse">'+moment(taskDetail.start_time,"YYYY-MM-DD HH:mm:ss").fromNow()+'</span></div>'
                                  +'<div>'+taskDetail.note+'</div>'
                                  +'<div>'+file_url+'</div>'
                                  );



  $('#taskDetail .modal-body .action .options').html('<b>Select Status </b>: <small> (Note: Completed Status will End this Task)</small><br>'
                                  +'<select name="status_id">'
                                  +options
                                  +'</select>'
                                  );



    string = "";
    for(i = activities.length-2;i>=0;i--){
      if(activities[i].note == null || activities[i].note == '') 
        note = ''; 
      else note = '\"'+activities[i].note+'\"';
      if(activities[i].file_url == null || activities[i].file_url == "") 
        file_url = "";
      else file_url = '<a href="../'+activities[i].file_url+'"><span class="glyphicon glyphicon-paperclip"></span>Attachment</a>'; 
      string = string + '<div>'
                            +'<div><span class="history_status">' + activities[i].status_name+ '</span>   '+note+'</div>'
                            +'<div>'+file_url+'</div>'
                            +'<div class="history_time">' +moment(activities[i].start_time,"YYYY-MM-DD HH:mm:ss").format('MMM,D YYYY ha') +'</div>'
                          +'</div>';
    }
    if(string == "") string = "<h5><small>No history</small></h5>";
    else string = "<a href='javascript:historyToggle()'>Show History Record</a>" + "<div class='hide historyToggle'>" +string+ "</div>";
  
  $('#taskDetail .modal-body .history').html(string);
  $('#taskDetail .modal-body button.submitNewStatusButton').attr('onclick','newStatus('+taskDetail.id_project_task+')');
  
 
  $('#taskDetail').modal('show');
});