
$('body').find('span.timeElapse_page').each(function(k,v){
  time = $(this).attr('data');
  $(this).html(moment(time,"YYYY-MM-DD HH:mm:ss").fromNow());
});
$('.popover-dismiss').popover({
  placement:'bottom',
  container:'body',
  html:'true',
  content:'<div class="close">x</div><h3>You have '+alert_num+' pending status to complete.</h3><hr><p>The Ignitor Labs development team is waiting for a response or action from the client! In order to keep this project on track, please complete all of the priority client tasks listed.</p>'
});
$('.progress-bar').tooltip({html:true});

$('body').on('click','.close',function(){
  $('.popover-dismiss').popover('hide');
});


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

function changeContact (client_id) {
  $('div.contactInfo').addClass('hide');
  $('div.contactEdit').removeClass('hide');
}

function saveContact(id) {
  name = $('dl.contactName').find('input').val();
  email = $('dl.contactEmail').find('input').val();
  phone = $('dl.contactPhone').find('input').val();
  if(name!=''&&email!='') {
    $.post('../clients/updateContact',{
      name:name,
      email:email,
      phone:phone,
      id:id
    },function(data){
      if(data == 1) {
        $('.contactInfo dl.contactName').find('dd').html(name);
        $('.contactInfo dl.contactEmail').find('dd').html(email);
        $('.contactInfo dl.contactPhone').find('dd').html(phone);
        $('div.contactEdit').addClass('hide');
        $('div.contactInfo').removeClass('hide');
      } else {alert(data);}
    });
  } else {
    alert('Contact name or contact email cannot be empty.');
  }
}

function cancelcontactchange(){
  $('div.contactInfo').removeClass('hide');
  $('div.contactEdit').addClass('hide');
}

function historyToggle(){
  if($('div.historyToggle').hasClass('hide')) {
    $('div.historyToggle').prev().html('Hide History Record');
    $('div.historyToggle').removeClass('hide');
  } else {
    $('div.historyToggle').addClass('hide');
    $('div.historyToggle').prev().html('Show History Record');
  }
}

$('.addnew').click(function(){
  $(this).attr('disabled',true);
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
              $(this).attr('disabled',false);
              if(data.indexOf('Success')!=-1) location.reload();
              else alert(data);
            });
  

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
  $('.submitNewStatusButton').removeAttr('onclick');
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
                if(data.indexOf('Success')!=-1) location.reload();
               else {alert(data);location.reload();}
            });
}


