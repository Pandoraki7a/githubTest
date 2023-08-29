$(document).ready(function(){

    $(".btn-view").click(function(){
     uid = $(this).attr('id')
    $.ajax({
      url: "process.php",
      method: "post",
      data: {user_id: uid},
      success: function(response){
        $('.modal-body-view').html(response);
        $('#myModal').modal('show');
      }
    });
    });

    
    $(".btn-del").click(function(){
      uid = $(this).attr('id')
      $("#del-id").val(uid)
      $("#myModalDel").modal("show");
    });
  



  });