
$('body').find('span.timeElapse_page').each(function(k,v){
  time = $(this).attr('data');
  $(this).html(moment(time,"YYYY-MM-DD HH:mm:ss").fromNow());
});

$('.progress-bar').tooltip({html:true});

$('select[name="project_task_select"]').on('change',function(){
  //alert();
  id = $(this).find('option:selected').attr('data-taskid');
  //alert(id);
  string = '';
  console.log(task_status);
  $(task_status[id]).each(function(key,val){
    string = string + "<option value='" + val.id + "'>" + val.status + "</option>";
  });
  $(this).parent().parent().find('select[name="status_select"]').html(string);
});





$('.current_task,.panel-history').click(function(){
  id = parseInt($(this).attr('data-id'));
  activities = taskDetails[id];
  taskDetail = activities[activities.length-1];
  if(taskDetail.task_sub_name == null) taskDetail.task_sub_name = '';
  if(taskDetail.note == null) taskDetail.note = '';
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

  console.log(taskDetail);
  if(taskDetail.status_name == "Completed"||task_status[taskDetail.task_id]==null||taskDetail.feedback_required==0){
    $('#taskDetail .modal-body .action').addClass('hide');
    $('#taskDetail .modal-body .action').next().addClass('hide');
  } else {
    $('#taskDetail .modal-body .action').removeClass('hide');
    $('#taskDetail .modal-body .action').next().removeClass('hide');
    options = '';
    $(task_status[taskDetail.task_id]).each(function(skey,sval){
      if(sval.id == taskDetail.status_id) options = options + "<option value='" + sval.id + "' disabled>" + sval.status + "</option>";
      else options = options + "<option value='" + sval.id + "'>" + sval.status + "</option>";
    });
    $('#taskDetail .modal-body .action .options').html('<b>Upate Status </b>:<br>'
                                  +'<select name="status_id">'
                                  +options
                                  +'</select>'
                                  );

  }
    //history
    string = "";
    note = "";
    url = "";
    for(i = activities.length-2;i>=0;i--){
      if(activities[i].note == null||activities[i].note == "") 
        note = ""; 
      else note = '\"'+activities[i].note+'\"';
      if(activities[i].file_url == null||activities[i].file_url == '') 
        url = "";
      else url = '<a href="../'+activities[i].file_url+'"><span class="glyphicon glyphicon-paperclip"></span>Attachment</a>'; 
      string = string + '<div>'
                            +'<div><span class="history_status">' + activities[i].status_name+ '</span>   '+note+'</div>'
                            +'<div>'+url+'</div>'
                            +'<div class="history_time">' +moment(activities[i].start_time,"YYYY-MM-DD HH:mm:ss").format('MMM,D YYYY ha') +'</div>'
                          +'</div>';
    }
    if(string == "") string = "<h5><small>No history</small></h5>";
  
  $('#taskDetail .modal-body .history').html(string);
  $('#taskDetail .modal-body button.submitNewStatusButton').attr('onclick','newStatus('+taskDetail.id_project_task+')');
  
 
  $('#taskDetail').modal('show');
});



$('.addnew').click(function(){

  form = $(this).parent().find('form');
  var formData = new FormData($(this).parent().find('form')[0]);
  data = $(form).serializeArray();
   $.ajax({
              url: "../events/startTask",
              type: "POST",
              data: formData,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                //console.log("PHP Output:");
                alert(data);
            });
  

  //$.post('../events/add',formData,function(data){alert(data)});

});

$('tr.active_task td:first-child').click(function(){
  if(!$(this).parent().hasClass('open')){
    $(this).parent().addClass('open');
    target = $(this).parent().attr('data-project_tast_id');
    //alert(target);
    $('tr.progress').each(function(k,v){
      if($(this).attr('data-project_tast_id') == target)
        $(this).removeClass('hide');
    });
  } else {
    $(this).parent().removeClass('open');
    target = $(this).parent().attr('data-project_tast_id');
    //alert(target);
    $('tr.progress').each(function(k,v){
      if($(this).attr('data-project_tast_id') == target)
        $(this).addClass('hide');
    });

  }
});




function newStatus(id_project_task){
  form = $('#taskDetail form');
  var formData = new FormData($('#taskDetail form')[0]);
  formData.append("id_project_task",id_project_task);
  $.ajax({
              url: "../events/newStatus",
              type: "POST",
              data: formData,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                //console.log("PHP Output:");
                alert(data);
            });
}

