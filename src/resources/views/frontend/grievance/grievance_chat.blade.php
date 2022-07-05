@extends('layouts.header') @section('title', 'Grievance | UNDP') @section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'शिकायत':'Grievance'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <style>
.wrapper-content {
    padding: 20px 0 40px;
}
.ibox {
    clear: both;
    margin-bottom: 25px;
    margin-top: 0;
    padding: 0;
}
.chat-view {
    z-index: 20012;
}
.ibox-title {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #ECF7EE;
    border-color: #ECF7EE;
    border-image: none;
    border-style: solid solid none;
    border-width: 2px 0 0;
    color: inherit;
    margin-bottom: 0;
    padding:25px 90px 25px 25px;
    min-height: 48px;
    position: relative;
    clear: both;
}
.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
    clear: both;
}
.chat-view .ibox-content {
    padding: 0;
}
.text-muted {
    color: #888888 !important;
}
.chat-discussion {
    background: #fbfbfb;
    padding: 15px;
    height: 550px;
    overflow-y: auto;
}
.chat-message {
    padding: 10px 20px;
}
.message-avatar {
    height: 48px;
    width: 48px;
    border: 1px solid #e7eaec;
    border-radius: 4px;
    margin-top: 1px;
}

.chat-discussion .chat-message.left .message {
    text-align: left;
    
    background-color: #45B25C;
    border: 1px solid #45B25C;
}
.message {
    background-color: #ECF7EE;
    border-color: #ECF7EE;
    text-align: left;
    display: block;
    padding: 10px 20px;
    position: relative;
    border-radius: 10px;
}
.chat-discussion .chat-message.left .message{
    border-top-right-radius: 0;   
}
.chat-discussion .chat-message.right .message{
    border-top-left-radius: 0;   
    margin-left: 55px;
}
.chat-discussion .chat-message .message-date {
    float: right;
}
.message-date {
    font-size: 10px;
    color: #888888;
}
.message-content {
    display: block;
}

.chat-discussion .chat-message.left .message {
    color: #fff;
    margin-right: 55px;
}
.chat-discussion .chat-message.left .message-date {
    color: #fff;
}
.chat-discussion .chat-message.left .message-author{
    color: #fff;
}
.message-input {
    height: 54px !important;
    resize: none;
    padding:13px 110px 15px 15px;
}
.chat-message-form .btn{
    color: #fff;
    background-color: #EA8634;
    border-color: #EA8634;
    position: absolute;
    right: 5px;
    top: 0;
    bottom: 0;
    margin: auto;
    height: 40px;
    min-width: 100px;
}
.chat-message-form .btn:hover,
.chat-message-form .btn:focus{
    color: #fff;
    background-color: #c7732e;
    border-color: #c7732e;
}
.message-author,
.message-author:hover{
    color: #333;
    font-size: 17px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 5px;
    display: inline-block;
}

.ibox-title .ticketNo{
    font-size: 16px;
    margin-bottom: 10px;
}
.ibox-title .title{
    font-size: 22px;
    line-height: 1.2;
    margin-bottom: 15px;
}
.ticketInfo ul{
    margin: 0;
    padding: 0;
    list-style: none;
}
.ticketInfo ul li{
    font-size: 16px;
    position: relative;
}
.ticketInfo ul li:not(:first-child){
    margin-left: 15px;
    padding-left: 18px;
}
.ticketInfo ul li:not(:first-child)::before{
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    top: 0;
    margin: auto;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #333;
    display: inline-block;
}
@media (max-width:767px) {
    .chat-message {
        padding: 10px 5px;
    }
    .message-date{
        display: block;
        width: 100%;
        margin-bottom: 5px;
    }
    .message-author{
        font-size: 16px;
        margin-bottom: 2px;
    }
    .chat-discussion {
        padding: 15px 10px;
    }
    .ibox-title{
        padding: 15px;
    }
    .ibox-title .title{
        font-size: 20px;
    }
    .ibox-title .ticketNo,
    .ticketInfo ul li{
        font-size: 14px;
    }
    .ticketInfo ul li:not(:first-child) {
        margin-left: 7px;
        padding-left: 12px;
    }
    .chat-discussion .chat-message.left .message{
        margin-right: 20px;
    }
    .chat-discussion .chat-message.right .message{
        margin-left: 20px;
    }
    .message-input {
        padding:13px 90px 15px 15px;
    }
    .chat-message-form .btn{
        min-width: 40px;
    }

}

</style>

 <div class="main-content">
    <div class="container">
    <div class="row">
        <div class="col-lg-12">

                <div class="ibox chat-view">
                    <?php //dd($grievanceMessages); ?>
                    <div class="ibox-title">
                        <div class="ticketNo">{{Session::get('weblangauge') == 'kn' ? 'टिकट संख्या:':'Ticket no:'}} <b>{{ $grievanceMessages->ticket_id ? $grievanceMessages->ticket_id : '' }}</b> </div>
                        <div class="ticketInfo">
                            <ul class="d-flex flex-wrap justify-content-start align-items-center">
                                <li>{{Session::get('weblangauge') == 'kn' ? 'बनाया गया:':'Created on:'}} <b>{{ $grievanceMessages->created_at ? date('M d, Y', strtotime($grievanceMessages->created_at)) : '' }} </b></li>
                                <li>{{Session::get('weblangauge') == 'kn' ? 'स्थिति:':'Status:'}} @if(Session::get('weblangauge') == 'kn')<b style="color:#EA8634">{{ $grievanceMessages->status == 0 ? 'खुला है':'बंद' }}</b>@else<b style="color:#EA8634">{{ $grievanceMessages->status == 0 ? 'Open' : 'Closed' }}</b>@endif</li>
                                <li>{{Session::get('weblangauge') == 'kn' ? 'समस्या:':'Issue:'}} <b>{{ $grievanceMessages->getIssue->title_en  }}</b></li>
                                <li>{{Session::get('weblangauge') == 'kn' ? 'चिंता:':'Concern:'}} <b>{{ $grievanceMessages->message }} </b></li>
                            </ul>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-12">
                                <div class="chat-discussion" id="chat-discussion">
                                <!-- <div class="chat-message left">
                                    <div class="message">
                                        <a class="message-author" href="#"> User </a>
                                        <span class="message-date">  {{ date('D M d Y - h:i:s', strtotime($grievanceMessages->created_at)) }} </span>
                                        <span class="message-content">{{ $grievanceMessages->message }} </span>
                                    </div>
                                </div> -->
                                    @forelse($grievanceMessages->getMessage as $grievanceMessage)
                                        @if($grievanceMessage->type == 'by_user')
                                        <div class="chat-message right">
                                                <div class="message">
                                                    <a class="message-author" href="#"> You </a>
                                                    <span class="message-date">  {{ date('D M d Y - h:i:s', strtotime($grievanceMessage->created_at)) }} </span>
                                                    <span class="message-content">{{ $grievanceMessage->message }} </span>
                                                </div>
                                            </div>
                                           
                                            @elseif($grievanceMessage->type == 'by_admin')
                                            <div class="chat-message left">
                                                <div class="message">
                                                    <a class="message-author" href="#"> {{Session::get('weblangauge') == 'kn' ? 'आजीविका':'Aajeevika'}} </a>
                                                    <span class="message-date">  {{ date('D M d Y - h:i:s', strtotime($grievanceMessage->created_at)) }} </span>
                                                    <span class="message-content">{{ $grievanceMessage->message }} </span>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    
                                    @if ($grievanceMessages->status == 0 )
                                    
                                @endif
                                    @endforelse

                                </div>

                            </div>
                        </div>
                        @if ($grievanceMessages->status == 0 )
                            <div class="row">
                                <div class="col-12">
                                    <div class="chat-message-form">
                                        <div class="form-group position-relative">
                                            <textarea class="form-control message-input" id="message" name="message" placeholder="{{Session::get('weblangauge') == 'kn' ? 'संदेश दर्ज करें':'Enter message text'}}"></textarea>
                                            <input type="submit" class="btn btn-primary reply-submit" value="{{Session::get('weblangauge') == 'kn' ? 'उत्तर दें':'Reply'}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row message-not">
                            <div class="message">
                            <div> {{Session::get('weblangauge') == 'kn' ? 'यह टिकट बंद कर दिया गया है। यदि आपकी समस्या का समाधान नहीं होता है, तो एक नया टिकट खोलें।':'This ticket has been marked closed. In case if your issue is not resolved, open a new ticket.'}} </div>
</div>
</div>
                        @endif
                        


                    </div>

                </div>
        </div>

    </div>
  </div>
  </div>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
 $('#chat-discussion').scrollTop($('#chat-discussion')[0].scrollHeight);
    $(".reply-submit").click(function(e){
        e.preventDefault();
        $('.bg-loader').show();
        
        var grievance_id = '{{ $grievanceMessages->id  }}';
        var message = $("#message").val();
        if(message == ''){
            $('.bg-loader').hide();
            return false;
        }
        var url = '{{ url('/grievanceReply') }}';
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
           url:url,
           method:'POST',
           data:{
                  grievance_id:grievance_id, 
                  message:message
                },
            dataType: "json",
            
            success:function(response){
                $('.bg-loader').hide();
                if(response.success){
                    //alert(response.message) //Message come from controller
                    location.reload();
                   
                }else{
                    console.log("Error")
                }
            },
            error:function(error){
                console.log(error)
            }
        });

});
</script>
    @endsection