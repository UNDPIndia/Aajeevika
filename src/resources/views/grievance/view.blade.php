@extends('layouts.app')
@section('title', 'Grievance Message | UNDP')
@section('content')

<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1>UNDP</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active"><a href="#">Home</a></li>
    </ol>
    </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
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

    <div class="container">
    <div class="row">
        <div class="col-lg-12">

                <div class="ibox chat-view">
                    <?php //dd($grievanceMessages); ?>
                    <div class="ibox-title">
                        <div class="ticketNo">Ticket no.: <b>{{ $grievanceMessages->ticket_id ? $grievanceMessages->ticket_id : '' }}</b> </div>
                        <div class="ticketInfo">
                            <ul class="d-flex flex-wrap justify-content-start align-items-center">
                                <li>Created on: <b>{{ $grievanceMessages->created_at ? date('M d, Y', strtotime($grievanceMessages->created_at)) : '' }} </b></li>
                                <li>Status: <b>{{ $grievanceMessages->status == 0 ? 'Open' : 'Closed' }}</b></li>
                                @if ($grievanceMessages->status != 1)
                                <li><a href="{{ url('admin/closeTicket') }}/{{ encrypt($grievanceMessages->id) }}/1" class="btn btn-outline-primary btn-sm">Close</a></li>
                                @endif
                                <li>Issue: <b>{{ $grievanceMessages->getIssue->title_en  }}</b></li>
                                <li>Concern: <b>{{ $grievanceMessages->message }} </b></li>
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
                                            <div class="chat-message left">
                                                <div class="message">
                                                    <a class="message-author" href="#"> User </a>
                                                    <span class="message-date">  {{ date('D M d Y - h:i:s', strtotime($grievanceMessage->created_at)) }} </span>
                                                    <span class="message-content">{{ $grievanceMessage->message }} </span>
                                                </div>
                                            </div>
                                            @elseif($grievanceMessage->type == 'by_admin')
                                            <div class="chat-message right">
                                                <div class="message">
                                                    <a class="message-author" href="#"> Aajeevika </a>
                                                    <span class="message-date">  {{ date('D M d Y - h:i:s', strtotime($grievanceMessage->created_at)) }} </span>
                                                    <span class="message-content">{{ $grievanceMessage->message }} </span>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    
                                    @if ($grievanceMessages->status == 0 )
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="chat-message-form">
                                                <div class="form-group position-relative">
                                                    <textarea class="form-control message-input" id="message" name="message" placeholder="Enter message text"></textarea>
                                                    <input type="submit" class="btn btn-primary reply-submit" value="Reply" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            <textarea class="form-control message-input" id="message" name="message" placeholder="Enter message text"></textarea>
                                            <input type="submit" class="btn btn-primary reply-submit" value="Reply" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        


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
        var grievance_id = '{{ $grievanceMessages->id  }}';
        var message = $("#message").val();
        var url = '{{ url('admin/grievanceReply') }}';
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
