
            function send_message(){ 
     
           var name =$("#name").val();
           var email =$("#email").val();
           var mobile =$("#mobile").val();
           var message =$("#message").val();
           var is_error='';

           if(name==""){
             alert('Please enter name');
           }
          if(email==""){
             alert('Please enter emil');
           }
            if(mobile==""){
             alert('Please enter mobile');
           }
             if(message==""){
             alert('Please enter message');
           }
           else{
              $.ajax({
                url:'send_message.php',
                type:'post',
                data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
                success:function(response){
                    alert('Thank you');
                    $("#contact-form").reset();
                }
              });
           }
           
   }
    