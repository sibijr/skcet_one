//My Profile
$('.alert a').click(function(e)
			{
				e.preventDefault();
				$(this).parent().hide();
			});
                $('#btn-pwd').click(function(){
                $('#ch-pwd').toggle();
            });
			$('.edit').click(function(){
				var cur=$(this).data('id');
				var value=$('#'+cur).val();
				$('#'+cur).attr('readonly',false).focus().val('');
				$('#'+cur).blur(function(){
					$('#'+cur).attr('readonly',true);
				});
			});
			$(document).ready(function(){
			$(".save_data").click(function(e){
			var cur=$(this).data('id');
			var value=$('#'+cur).val();
			$.post("update.php",
			{
			name: value,
			field: cur 
			},function(data)
			{
			$("#"+cur+"_alert").css('display','block');
			$('#'+cur).val(val);
			});});});
			
			$(document).ready(function(){	
			$("#pass_change").click(function(e){
			var cur=$(this).data('id');
			var value=$('#'+cur+"old").val();
			var value1=$('#'+cur+"new").val();
			var value2=$('#'+cur+"newagain").val();
			if(value1!=value2)
			{
				$("#password_alert_match").show();
			}
			else{
			$.post("change_password.php",
			{
			password:value,
			passwordnew:value1 
			},function(data)
			{
				 data=$.parseJSON(data);
				 var error=data.error;
				 if(error==1)
				 {
					 $("#password_alert_fail").show();
				 }
				 else{
					 $("#password_alert").show();
				 }
				 
			});}});});
			
			
	$( '#pro-upload' ).submit( function( e ) {
    $.ajax( {
      url: 'profile_pics_update.php',
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
	  success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
				$(window).load();
				$("#profile-link").click();
            }
            else
            {
				alert("false");	
            }
        }
    });
    e.preventDefault();
  } );
			


//User Management
$("#user-tab li a").click(function(e){
            e.preventDefault();
            var tar=$(this).attr('href');
            $("div.abc").hide();
            $("div#"+tar).show();
});
$( '#multi_user' ).submit( function( e ) {
    $.ajax( {
      url: 'add_user_excel.php',
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
	  success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
                alert("hi");
            }
            else
            {
				alert("false");	
            }
        }
    });
    e.preventDefault();
 });
 
 