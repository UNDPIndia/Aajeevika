@extends('layouts.header')
@section('title', 'ind Chat | UNDP') 
@section('content')

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <!-- <script>
    $(document).ready(function(){
      $(".like-btn .like").click(function(){
        $(".like-btn .like").addClass("active");
      });
    });
  </script>  -->

<div class="main">
    <div class="category-banner">
      <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1 class="text-white">My Chats</h1>
            </div>
        </div>
      </div>
    </div>
    <div class="my-chats-wrap">
      <div class="container">
        <div class="my-chats">
            <div class="inner-wrep">
              <div class="left-bar">
                <div class="chats-members">
                  <ul class="members-wrap chat-list-show">
                    <!-- 
                    Chat List Area--------------------------  
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li> -->
                    
                  </ul>
                </div>
              </div>
              <div class="right-bar">
                <div class="top-bar-main-chat">
                  <div class="member-name-chat chat-name">
                    
                  </div>
                  <!-- <div class="like-btn">
                    <a href="#0" class="like"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                  </div> -->
                </div>
                <div class="inner-wrep-chat">
                  <div class="full-chat-wrap">
                  <!-- <div class="user-chat-area-note"><span>Hi there ! I am using Aajeevika.</span></div> -->
                    <ul class="full-chat user-chat-area">
                      
                    </ul>
                    
                  </div>
                 
                </div>
                <div class="sand-number">
                  <a href="#0" class="chat-tage nuber-btn sendmsg" msgen="{{'My phone number is '.$mobile}}" msghi="{{'मेरा फोन नंबर है '.$mobile}}">Share your Number</a>
                    <!-- <a href="#" class="nuber-btn">Share your Number</a> -->
                  </div>
                <div class="chats-footer">
                  
                  <ul class="chat-tags">
                  <!-- <li class="sand-number">
                    <a href="#0" class="chat-tage nuber-btn sendmsg" msgen="{{$mobile}}" msghi="{{$mobile}}">Share your Number</a>
                  </li> -->
                  <?php $language = session()->get('weblangauge'); ?>
                    @foreach($chatTag as $tag)
                    <li>
                      <a href="#0" class="chat-tage sendmsg" msgen="{{$tag->msg_en}}" msghi="{{$tag->msg_hi}}" ><?php echo ($language == 'en') ? $tag->msg_en : $tag->msg_hi ?></a>
                    </li>
                    @endforeach
                    
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</div>
   

 
<input type="hidden" id="recieverName" value="">
        <input type="hidden" id="recieverId" value="">
        <input type="hidden" id="receiverFCMToken" value="">
        <input type="hidden" id="deviceType" value="">
        <input type="hidden" id="userID" value="">
        <input type="hidden" id="byUserWishListId" value="">
        <input type="hidden" id="userWishListId" value="">
        <input type="hidden" id="orderId" value="">
        <input type="hidden" id="libraryId" value="">
        <input type="hidden" id="orderUserId" value="">
        <input type="hidden" id="aliasId" value="">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script>
  
    $(document).ready(function() {
      $('.bg-loader').show();
        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
        var socket_id;
        
     let loginId = "<?php echo Auth::user()->id; ?>";
     let selectedFromUserId = "<?php echo Session::get('session_from_user_id'); ?>"; 
     let selectedUserName = "<?php echo $selectedUserName ?>"; 
     let languageWeb = '<?php echo session()->get('weblangauge') ?>'; 
     var socket = io.connect('https://undp-chat.undp-uttarakhand.tk:3002/',{query: 'userId='+loginId });
        
        socket.on('disconnect', function(){
          //socket.removeAllListeners("add-message-response");
          console.log('sokect disconnect..............................');
          //$('.chat-list-show').html('');
          //$(".user-chat-area").html('');
        });
        socket.on('connect', () => {
            socket_id = socket.id;
            console.log('sokect id..............................',socket_id);
            
            var datasString = {
                userId: loginId,
            };

            var readData = {
                fromUserId:loginId,
                //toUserId:'17',
            };

            socket.emit('chat-list', datasString);
            socket.on('add-message-response', function(response) {
              console.log('add message.....');
                var date = new Date();
                                        var hours = date.getHours();
                                        var minutes = date.getMinutes();
                                        var ampm = hours >= 12 ? 'pm' : 'am';
                                        hours = hours % 12;
                                        hours = hours ? hours : 12; // the hour '0' should be '12'
                                        minutes = minutes < 10 ? '0'+minutes : minutes;
                                        var strTime = hours + ':' + minutes + ' ' + ampm;
                                       
                                        //var languageWeb = 'en'; 
                                                if(languageWeb == 'en'){
                                                  var message0 = response.messageen;
                                                }else{
                                                  var message0 = response.messagehi;
                                                }
                                        if(response.type == 'image'){
                                                chathtml = '<li class="sent"> <img src="'+ message0 +'" class="send-image"><span>'+ ' ' + strTime + '</span> </li>';

                                            }else{
                                              
                                              var chathtml ='<li class="chat-item">   <div class="chat-info"><div class="chat-desc">' + message0 + '</div><span class="chat-date">' + strTime + '</span></div></li>';

                                               // chathtml = '<li class="sent"> <p>' + response.message + '<span class="time">' + strTime + '</span></p> </li>';

                                            }
                     $(".user-chat-area").append(chathtml);
                 });
           
        });
       
            socket.on('chat-list-response', function(response) {
              $('.chat-list-show').html('');
              $('.right-bar').hide();
              
                var count = response.userList.length;
                //console.log('list response...........',response);
                //console.log('list count...........',count);
                userImageNew = '';
                
                for(var i=0; i<count; i++){
                    var name = response.userList[i].receiverName;
                    var aliasUserName = response.userList[i].aliasUserName;
                    var aliasId = response.userList[i].aliasId;
                    var userImage = response.userList[i].receiverImage;
                    var fromUserId = response.userList[i].fromUserId;
                    var toUserId = response.userList[i].toUserId;
                    var orderUserId = response.userList[i].toUserId;
                    var byUserWishListId = response.userList[i].byUserWishListId;
                    var userWishListId = response.userList[i].userWishListId;
                    var libraryId = response.userList[i].libraryId;
                    var orderId = response.userList[i].orderId;
                    var updatedDate = response.userList[i].updatedAt;
                    //console.log('user name................',response.userList[0].receiverName);
                    
                    
                    if(userImage == ''){
                      
                        var userImageNew = "assets/images/logo4.png";
                        //var userImageNew = "public/front/user_profile/default.png";
                    }else{
                        var sos = userImage.indexOf("http");
                        //console.log(sos);
                        if(sos == 0){
                           // console.log('ssssssss');
                            var userImageNew = userImage;
                        }else{
                            var userImageNew = userImage;
                        }
                    }
                    if(response.userList[i].messagesData != null){
                    var a = timeConverter(response.userList[i].messagesData.timestamp);
                         if(languageWeb == 'en'){
                          var lastMessage = response.userList[i].messagesData.messageen;
                            }else{
                              var lastMessage = response.userList[i].messagesData.messagehi;
                            }
                         
                   }else{
                       //console.log(updatedDate);
                       updatedDate=new Date(updatedDate)
                    var a = timeConverter(updatedDate);
                    if(languageWeb == 'en'){
                      var lastMessage = 'Hi there ! I am using Aajeevika.';
                            }else{
                              var lastMessage = 'नमस्ते ! मैं आजीविका का उपयोग कर रहा हूं।';
                            }
                    
                   
                    
                   }
                   //console.log('lastMessage.........',lastMessage);
                   var dt = new Date();

                  // console.log('today afate');
                 //  console.log(dt);
                var pastt = new Date(a);
               // console.log(pastt);
                  // console.log(dt);
                var chatTime = calcDate(dt,pastt);
                var orderHId = $(this).attr('data-orderId');
                var aliasUserNameN = '';
              //  if(loginId == 725 || loginId == 97){
              //   var aliasUserNameN = '('+aliasUserName+')';
              //  }
                
                var orderHId = $(this).attr('data-orderId');
                
                //chathtml = ' <div class="conversation userlist-'+orderId+' d-flex flex-wrap justify-content-start align-items-center chat-list-user" data-deviceType="" data-fcm="" data-name="'+name+'" data-userID="{{Auth::user()->id}}" data-aliasId="'+aliasId+'" data-toUserId="'+toUserId+'" data-recID="'+fromUserId+'" data-byUserWishListId="'+byUserWishListId+'" data-userWishListId="'+userWishListId+'" data-orderId="'+orderId+'"  data-libraryId="'+libraryId+'"> <div class="userImg">  <img src="'+userImageNew+'" class="img-fluid" alt="" /></div><div class="userDetail"> <div class="name">'+ response.userList[i].receiverName  +''+aliasUserNameN+'</div> <div class="time">' + chatTime + '</div></div><a href="javascript:void(0)"  class="hyper"></a></div>';
                if(loginId == toUserId){
                  var selectedId = fromUserId;
                }else{
                  var selectedId = toUserId;
                }
                // console.log('toUserId con..........',toUserId);
                // console.log('fromUserId con..........',fromUserId);
                // console.log('selected con..........',selectedId);
                // console.log('session id',selectedFromUserId);
                chatlisthtml = '<li class="members fromUserId-'+selectedId+' chat-list-user" data-deviceType="" data-fcm="" data-name="'+name+'" data-userID="{{Auth::user()->id}}" data-aliasId="'+aliasId+'" data-toUserId="'+toUserId+'" data-recID="'+fromUserId+'" data-byUserWishListId="'+byUserWishListId+'" data-userWishListId="'+userWishListId+'" data-orderId="'+orderId+'"  data-libraryId="'+libraryId+'"> <div class="members-img"> <img src="https://api.undp-uttarakhand.tk/'+userImageNew+'" alt="img" class="img-fluid"> </div> <div class="members-info"> <span class="members-name">'+ response.userList[i].receiverName  +'</span> <span class="members-msg">'+ lastMessage +'</span> <span class="msg-time">' + chatTime + '</span></div></li>';
             if(selectedFromUserId){
               $('.fromUserId-'+selectedFromUserId).addClass("active");
              //if(orderId == sessionOrderId){
                $('.bg-loader').hide();
               if(selectedFromUserId == selectedId){
                var userID = loginId;
                var aliasId = aliasId;
                    //var recID = fromUserId;
                    var recID = fromUserId;
                    var toUserId = toUserId;
                    var recName = name;
                   
                    var byUserWishListId = byUserWishListId;
                    var userWishListId = userWishListId;
                    var orderId = orderId;
                    
                    var chatlisthtml;
                    
                if(userID == recID){
                    var newRecID = toUserId;
                    var toUserId = recID;
                }else{
                    var newRecID = recID;
                   
                }
                
                    $("#orderUserId").val(orderUserId);
                    $("#aliasId").val(aliasId);
                    $("#recieverName").val(recName);
                    $("#recieverId").val(selectedFromUserId);
                    $("#receiverFCMToken").val(receiverFCMToken);
                    $("#deviceType").val(deviceType);
                    $("#userID").val(userID);
                    $("#byUserWishListId").val(byUserWishListId);
                    $("#userWishListId").val(userWishListId);
                    $("#orderId").val(orderId);
                    $("#libraryId").val(libraryId);
                    $('.chat-name').html(recName);
                    getUserMessage();
                   
                   // $(".right-bar").stop().animate({ scrollTop: $(".full-chat-wrap")[0].scrollHeight}, 1000);
               }
                }
                $(".chat-list-show").append(chatlisthtml);
                $('.bg-loader').hide();
            }
            });
         
            
            $(document).on("click", ".chat-list-user", function() {
                   
                    $('.bg-loader').show();
                    //$(".chatshow").html("");
                    $('.members').removeClass("active");
                    $(".user-chat-area").html('');
                    
                    var userID = $(this).attr('data-userID');
                    var aliasId = $(this).attr('data-aliasId');
                    var recID = $(this).attr('data-recID');   //from user id
                    var toUserId = $(this).attr('data-toUserId');
                    var orderUserId = $(this).attr('data-toUserId');
                    var recName = $(this).attr('data-name');
                    var receiverFCMToken = $(this).attr('data-fcm');
                    var deviceType = $(this).attr('data-deviceType');
                    var byUserWishListId = $(this).attr('data-byUserWishListId');
                    var userWishListId = $(this).attr('data-userWishListId');
                    var orderId = $(this).attr('data-orderId');
                    var libraryId = $(this).attr('data-libraryId');
                    //$('.userlist-'+orderId).addClass("active");
                
                    // console.log('toUserId.......',toUserId);
                    // console.log('userID.......',userID);
                    // console.log('recID.......',recID);
                    var chathtml;
                if(userID == recID){
                    var newRecID = toUserId;
                    var toUserId = recID;
                  
                }else{
                    var newRecID = recID;
                }
                // console.log('newRecID.......',newRecID);
                $("#orderUserId").val(orderUserId);
                    $("#recieverName").val(recName);
                    $("#aliasId").val(aliasId);
                    $("#recieverId").val(newRecID);
                    $("#receiverFCMToken").val(receiverFCMToken);
                    $("#deviceType").val(deviceType);
                    $("#userID").val(userID);
                    $("#byUserWishListId").val(byUserWishListId);
                    $("#userWishListId").val(userWishListId);
                    $("#orderId").val(orderId);
                    $("#libraryId").val(libraryId);
                   
                    
                    $('.fromUserId-'+newRecID).addClass("active");
                    //$('.userlist-'+orderId).addClass("active");
                    var dataString = {
                        toUserId: newRecID,
                        userId: userID,
                    };
                    var readData = {
                        toUserId: newRecID,
                        fromUserId: userID,
                    };
                   // $('.bg-loader').hide();
                       // $("#chat_box_ajax").html(response);
                       // var recieverName = $("#recieverName").val();
                        
                          $('.chat-name').html(recName);
                            
                            getUserMessage();
               
            });      
         

            function getUserMessage(){
              $(".user-chat-area").html('');
              $('.right-bar').show();
                var recieverId = $("#recieverId").val();
                console.log('recieverId..........',recieverId);
                var userID = $('#userID').val();
                console.log('userID..........',userID);

                var aliasId = $('#aliasId').val();
                 var dataString = {
                    toUserId: recieverId,
                        userId: userID,
                        aliasId: aliasId
                    };
                    var readData = {
                        toUserId: recieverId,
                        fromUserId: userID,
                        aliasId: aliasId
                    };
                    
                $.ajax({
                    type: "POST",
                    url: "https://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/getMessages",
                    data: dataString,
                        success: function(data) {
                          $('.bg-loader').hide();
                           // console.log('chat message...............',data.messages);
                        if(data.messages.length > 0){
                            //$(".user-chat-area-note").hide();
                                $.each(data, function(key, value){
                                    $.each(value, function (k, v) {
                                        var ts = v.timestamp;
                                        var date = new Date(ts );
                                        var hours = date.getHours();
                                        var minutes = date.getMinutes();
                                        var ampm = hours >= 12 ? 'pm' : 'am';
                                        hours = hours % 12;
                                        hours = hours ? hours : 12; // the hour '0' should be '12'
                                        minutes = minutes < 10 ? '0'+minutes : minutes;
                                        var strTime = hours + ':' + minutes + ' ' + ampm;
                                        
                                                if(languageWeb == 'en'){
                                                  var message1 = value[k]['messageen'];
                                                }else{
                                                  var message1 = value[k]['messagehi'];
                                                }
                                        if (v.fromUserId == userID) {
                                         
                                            if(value[k]['type'] == 'image'){
                                                chathtml = '<li class="reply"> <a href="'+value[k]['message']+'" download><img src="'+ value[k]['message'] +'" class="send-image"></a><span>'+ ' ' + strTime + '</span> </li>';

                                            }else{
                                              
                                              var chathtml ='<li class="chat-item reply">   <div class="chat-info"><div class="chat-desc">' + message1 + '</div><span class="chat-date">' + strTime + '</span></div></li>';

                                               // chathtml = '<li class="reply"> <p>' + value[k]['message'] + '<span class="time">' + strTime + '</span></p> </li>';

                                            }
                                        } else {
                                            if(value[k]['type'] == 'image'){
                                                chathtml = '<li class="sent"> <a href="'+value[k]['message']+'" download><img src="'+ value[k]['message'] +'" class="send-image"></a><span>'+ ' ' + strTime + '</span> </li>';

                                            }else{
                                              var chathtml ='<li class="chat-item">   <div class="chat-info"><div class="chat-desc">' + message1 + '</div><span class="chat-date">' + strTime + '</span></div></li>';

                                               // chathtml = '<li class="sent"> <p>' + value[k]['message'] + '<span class="time">' + strTime + '</span></p> </li>';

                                            }
                                        }
                                            //socket.emit('isRead', readData);
                                        $(".user-chat-area").append(chathtml);
                                       // $(".chat-area").stop().animate({ scrollTop: $(".scrrol-down")[0].scrollHeight}, 1000);
                                       // $(".chat-item").stop().animate({ scrollTop: $(".inner-wrep-chat")[0].scrollHeight}, 1000);
                                       var height = 0;
                      $('.full-chat-wrap').each(function(i, value){
                          height += parseInt($(this).height());
                      });
                       height += '';
                      $('.inner-wrep-chat').animate({scrollTop: height}, 10);
                                    
                                    });
                                });
                                }else{
                                    $(".user-chat-area-note").show();
                                }
                        },
                        error: function(xhr, status, error) {
                           // alert(error);
                        },
                });
    
            }
         
       
  

            $(document).on("click", ".sendmsg", function(e) {
              if(languageWeb == 'en'){
                var message = $(this).attr('msgen');
              }else{
                var message = $(this).attr('msghi');
              }
              
              var messagehi = $(this).attr('msghi');
              var messageen = $(this).attr('msgen');
               
            if (message == "") {
                return false;
                //alert("cannot send empty message");
            } else {
               // $(".user-chat-area-note").hide();
                var date = new Date();
                                        var hours = date.getHours();
                                        var minutes = date.getMinutes();
                                        var ampm = hours >= 12 ? 'pm' : 'am';
                                        hours = hours % 12;
                                        hours = hours ? hours : 12; // the hour '0' should be '12'
                                        minutes = minutes < 10 ? '0'+minutes : minutes;
                                        var strTime = hours + ':' + minutes + ' ' + ampm;
              // var chathtml ='<li class="reply"> <p>' + message + '<span class="time">' + strTime + '</span></p> </li>';
               var chathtml ='<li class="chat-item reply">   <div class="chat-info"><div class="chat-desc">' + message + '</div><span class="chat-date">' + strTime + '</span></div></li>';
                $(".user-chat-area").append(chathtml);
                var height = 0;
                      $('.full-chat-wrap').each(function(i, value){
                          height += parseInt($(this).height());
                      });
                       height += '';
                      $('.inner-wrep-chat').animate({scrollTop: height}, 10);



                var timestamp = new Date().getTime();
                var recieverName = $("#recieverName").val();
                var recieverId = $("#recieverId").val();
                var deviceType = $('#deviceType').val();
                var userId = $('#userID').val();
                var libraryId = $('#libraryId').val();
                var byUserWishListId = $('#byUserWishListId').val();
                var userWishListId = $('#userWishListId').val();
                var orderUserId = $('#orderUserId').val();
                var aliasId = $('#aliasId').val();

               console.log('send msg......................................');
               console.log('recieverId........',recieverId);
               console.log('userId........',userId);
               console.log('orderUserId........',orderUserId);
               //console.log(byUserWishListId);
              // console.log(userWishListId);
              //alert(aliasId);
              if(orderUserId == loginId){

                var byUserWishListIdNew = userWishListId;
                   var userWishListIdNew = byUserWishListId;
                
                   
                }else{
                    var byUserWishListIdNew = byUserWishListId;
                   var userWishListIdNew = userWishListId;
                   
                }
                var type = "text";
                var dataAdd = {
                    toUserId: recieverId,
                    fromUserId: loginId,
                    message: message,
                    messagehi: messagehi,
                    messageen: messageen,
                    type: type,
                    libraryId: libraryId,
                    byUserWishListId: byUserWishListIdNew,
                    userWishListId: userWishListIdNew,
                    receiverUserId:loginId,
                    aliasId: "0",
                };
              console.log(dataAdd);
                socket.emit('add-message',dataAdd);
            }
         });
         $(document).on("change", ".user-send-file", function(e) {
            $(".site-loader").show();
            var chathtml;
           let reader = new FileReader();
      
           reader.onload = (e) => { 
         
           }
          
           var chathtml;
                var image = $('.image').val();
                var formData = new FormData($(".chatform")[0]);
                var timestamp = new Date().getTime();
                var recieverName = $("#recieverName").val();
                var recieverId = $("#recieverId").val();
                var deviceType = $('#deviceType').val();
                var userId = $('#userID').val();
                var libraryId = $('#libraryId').val();
                var byUserWishListId = $('#byUserWishListId').val();
                var userWishListId = $('#userWishListId').val();
                var orderUserId = $('#orderUserId').val();
                var aliasId = $('#aliasId').val();
                if(orderUserId == loginId){

            var byUserWishListIdNew = userWishListId;
            var userWishListIdNew = byUserWishListId;

            
            }else{
                var byUserWishListIdNew = byUserWishListId;
            var userWishListIdNew = userWishListId;
            
            }
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    url: "http://undp-chat.undp-uttarakhand.tk:3002/shopmate/v1/imageUpload",
                    type: "POST",
                    data: formData,
                    success:function(response){
                        $(".site-loader").hide();
                        //$(".user-chat-area-note").hide();
                        var dataAdd = {
                                    toUserId: recieverId,
                                    fromUserId: loginId,
                                    message: response.result,
                                    type: 'image',
                                    libraryId: libraryId,
                                    byUserWishListId: byUserWishListIdNew,
                                    userWishListId: userWishListIdNew,
                                    receiverUserId:loginId,
                                    aliasId: aliasId
                                };
                        socket.emit('add-message',dataAdd);
                            var date = new Date();
                                        var hours = date.getHours();
                                        var minutes = date.getMinutes();
                                        var ampm = hours >= 12 ? 'pm' : 'am';
                                        hours = hours % 12;
                                        hours = hours ? hours : 12; // the hour '0' should be '12'
                                        minutes = minutes < 10 ? '0'+minutes : minutes;
                                        var strTime = hours + ':' + minutes + ' ' + ampm;
                            var chathtml ='<li class="reply"> <img src="'+ response.result +'" class="send-image"><span>'+ ' ' + strTime + '</span> </li>';
                            $(".user-chat-area").append(chathtml);
                            $(".chat-area").stop().animate({ scrollTop: $(".scrrol-down")[0].scrollHeight}, 1000);
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    error:function(response){
                    }
                });
          });
            
            socket.on('disconnected', function() {
                $('.chat-list-show').html('');
             });



    //end of code...in socket
       
        
});
     
    function timeSince(date) {

 

var seconds = date;



var interval = seconds / 31536000;



if (interval > 1) {
  return Math.floor(interval) + " years";
}
interval = seconds / 2592000;
if (interval > 1) {
  return Math.floor(interval) + " months";
}
interval = seconds / 86400;
if (interval > 1) {
  return Math.floor(interval) + " days";
}
interval = seconds / 3600;
if (interval > 1) {
  return Math.floor(interval) + " hours";
}
interval = seconds / 60;
if (interval > 1) {
  return Math.floor(interval) + " minutes";
}
return Math.floor(seconds) + " seconds";
}

function calcDate(date1,date2) {
  var diff = Math.floor(date1.getTime() - date2.getTime());
  var day = 1000 * 60 * 60 * 24;



  var days = Math.floor(diff/day);
  var months = Math.floor(days/31);
  var years = Math.floor(months/12);



  var message
message += " was "
  message += days + " days " 
  message += months + " months "
  message += years + " years ago \n"
//  return message
  if(Number(days)>=365){
  message =parseInt(days/365) +" year ago"
  }
  if(Number(days)>=30 && Number(days)<=365){
  message=parseInt(days/30) +" month ago"
  }
   if(Number(days)<30){
  message =parseInt(days) +" day ago"
  }
if(days ==0){




// adjust 0 before single digit date
let date = ("0" + date2.getDate()).slice(-2);



// current month
let month = ("0" + (date2.getMonth() + 1)).slice(-2);



// current year
let year = date2.getFullYear();



// current hours
let hours = date2.getHours();



// current minutes
let minutes = date2.getMinutes();



// current seconds
let secondse= date2.getSeconds();



var aDay = hours*minutes*secondse;


console.log( date2.getTime())
console.log(Date.now())
console.log(new Date(Date.now()))
var timediffer=(Date.now()- date2.getTime())/1000
return timeSince(timediffer);
}else{
return message
}
  
  }


  function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp );
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
  return time;
}



</script>

    @endsection
