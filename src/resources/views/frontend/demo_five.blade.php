@extends('layouts.header') @section('title', 'Demo Two | UNDP') @section('content')

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <script>
    $(document).ready(function(){
      $(".like-btn .like").click(function(){
        $(".like-btn .like").addClass("active");
      });
    });
  </script> 

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
                  <ul class="members-wrap">
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                    <li class="members">
                      <div class="members-img">
                        <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                      </div>
                      <div class="members-info">
                        <span class="members-name">Scarlett Masison</span>
                        <span class="members-msg">Hi, How are you?</span>
                        <span class="msg-time">25/05/2021</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="right-bar">
                <div class="top-bar-main-chat">
                  <div class="member-name-chat">
                    <h6>Alice</h6>
                  </div>
                  <div class="like-btn">
                    <a href="#0" class="like"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                  </div>
                </div>
                <div class="inner-wrep-chat">
                  <div class="full-chat-wrap">
                    <ul class="full-chat">
                      <li class="chat-item">
                        <div class="chat-img">
                          <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                        </div>
                        <div class="chat-info">
                          <div class="chat-desc">
                            Hi, how are you?
                          </div>
                          <span class="chat-date">05:32</span>
                        </div>
                      </li>
                      <li class="chat-item">                       
                        <div class="chat-info">
                          <div class="chat-desc">
                            Hi, how are you?
                          </div>
                          <span class="chat-date">05:32</span>
                        </div>
                      </li>
                      <li class="chat-item">
                        <div class="chat-img">
                          <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                        </div>
                        <div class="chat-info">
                          <div class="chat-desc">
                            Nice!
                          </div>
                          <span class="chat-date">05:34</span>
                        </div>
                      </li>
                      <li class="chat-item">                       
                        <div class="chat-info">
                          <div class="chat-desc">
                            So, What brings you on this platform?
                          </div>
                          <span class="chat-date">05:37</span>
                        </div>
                      </li>
                       <li class="chat-item">
                        <div class="chat-img">
                          <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                        </div>
                        <div class="chat-info">
                          <div class="chat-desc">
                            Hi, how are you?
                          </div>
                          <span class="chat-date">05:32</span>
                        </div>
                      </li>
                      <li class="chat-item">                       
                        <div class="chat-info">
                          <div class="chat-desc">
                            Hi, how are you?
                          </div>
                          <span class="chat-date">05:32</span>
                        </div>
                      </li>
                      <li class="chat-item">
                        <div class="chat-img">
                          <img src="https://api.undp-uttarakhand.tk/assets/images/logo4.png" alt="img" class="img-fluid">
                        </div>
                        <div class="chat-info">
                          <div class="chat-desc">
                            Nice!
                          </div>
                          <span class="chat-date">05:34</span>
                        </div>
                      </li>
                      <li class="chat-item">                       
                        <div class="chat-info">
                          <div class="chat-desc">
                            So, What brings you on this platform?
                          </div>
                          <span class="chat-date">05:37</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="sand-number">
                    <a href="#" class="nuber-btn">Share your Number</a>
                  </div>
                </div>
                <div class="chats-footer">
                  <ul class="chat-tags">
                    <li>
                      <a href="#0" class="chat-tage">Nice</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Namaste</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">What's the Price</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Hi</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Is it Available?</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Not Interested</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">How are you?</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Nice</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Namaste</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">What's the Price</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Hi</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Is it Available?</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Not Interested</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">How are you?</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Nice</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Namaste</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">What's the Price</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Hi</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Is it Available?</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">Not Interested</a>
                    </li>
                    <li>
                      <a href="#0" class="chat-tage">How are you?</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</div>
   

 

    @endsection
