 function send_message(){ 
     
           var name =jQuery("#name").val();
           var email =jQuery("#email").val();
           var mobile =jQuery("#mobile").val();
           var message =jQuery("#message").val();
           var is_error='';

           if(name==""){
             alert('Please enter name');
           }
           else if(email==""){
             alert('Please enter emil');
           }
            else if(mobile==""){
             alert('Please enter mobile');
           }
            else if(message==""){
             alert('Please enter message');
           }
           else{
              jQuery.ajax({
                url:'send_message.php',
                type:'post',
                data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
                success:function(response){
                    alert(response);
                    console.log('hey');
                }
              });
           }
           
   }