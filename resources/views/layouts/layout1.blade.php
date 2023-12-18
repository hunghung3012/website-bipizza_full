<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/navfoot.js" defer></script>
    <script src="/js/chatbox-ajax.js"></script>
    <title>@yield('title')</title>
    @yield('css')
    @yield('js')

</head>

<body>
    @include('public.header')

    @yield('content')
    <div class="icon_chat_box">
        <img src="/images/icon_chat.jpg" alt="">
    </div>
    <div class="chat_box_container">
      <div class="chat_box_back">
        <i class="fa-solid fa-backward"></i>
      </div>
        <div class="title_chat">
            ChatBot
        </div>

        <div class="content_chat">
            {{-- Content --}}
            <div class="bot_chat_item">
                <div class="bot_chat_icon chat_icon">
                    <img src="/images/icon_chat.jpg" alt="">
                </div>
                <div class="bot_chat_content chat_content">
                  Chúc Bạn Ngày Mới, bạn có cần gợi ý gì không?

                </div>
            </div>
            
            {{-- Content --}}

        </div>
        <div class="text_chat">
         
            <div class="text_chat_item">
           
              <form >
                @csrf
                <input class="question_text" placeholder="Bạn đang thắc mắc điều gì?" type="text" >
               
              </form>
            </div>
         
            <div class="icon_send">
                <i class="fa-regular fa-paper-plane"></i>
            </div>
       
        </div>

    </div>

 
    @include('public.footer')
