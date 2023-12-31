$(document).ready(function () {
    const icon_chat_box =  $('.icon_chat_box');
    const chat_box_container = $('.chat_box_container')
    const chat_box = $(".content_chat");
    const chat_box_back = $(".chat_box_back");
    const question_input = $('.question_text')
    const loading = $('.loading_container')
    loading.hide();
    icon_chat_box.click(function() {
        chat_box_container.addClass('active');
        icon_chat_box.hide();
        question_input.focus()
    });
    chat_box_back.click(function() {
        chat_box_container.removeClass('active');
        icon_chat_box.show();
    });

    $(".icon_send").click(function (event) {
      
        process(event)
        question_input.val('')
        scrollToBottom();
       
    });
    $('.text_chat_item input').keydown(function(event) { 
        if (event.which === 13) {  
        event .preventDefault()   
        process(event)
        scrollToBottom();
        question_input.val('')
   
     
        
    }
    })
    function scrollToBottom() {
        var content_chat = $('.content_chat');
        content_chat.scrollTop(content_chat.prop('scrollHeight'));

    }
    function process(event) {
if(question_input.val()!="") {
        let child_client = `
        <div class="client_chat_item">
                <div class="client_chat_icon chat_icon">
                    <img src="/images/icon_user_chat.jpg" >
                </div>
                <div class="client_chat_content chat_content">
                `+question_input.val()+`
                </div>
            </div>
        `;
        chat_box.append(child_client);
        const token = $('.text_chat_item input[name="_token"]');
        loading.show()
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/gpt",
            data: {
                content:question_input.val() ,
                _token:  token.val()
,
        },
        
            success: function (response) {
                
                console.log(response);
 
                let child_bot = `
                <div class="bot_chat_item">
                        <div class="bott_chat_icon chat_icon">
                            <img src="/images/icon_chat.jpg" alt="">
                        </div>
                        <div class="bot_chat_content chat_content">
                        `+ response +`
                        </div>
                    </div>
                `;
                chat_box.append(child_bot);
                question_input.focus();
                loading.hide()
                scrollToBottom();
            },
            error: function(xhr, status, error) {
                alert("Hiện tại IPA đang bị lỗi");
                loading.hide()

            }

        });

        
    }
}
    

// speeach to voice



var click_to_convert = $('#click_to_convert');
var convert_text_container  = $('.convert_text_container')
var convert_text = $('#convert_text');
var speech = true;
var convert_temp = false;
var right_convert = $('.convert_text_button .fa-circle-check')
var wrong_convert = $('.convert_text_button .fa-xmark')
var hide_convert = $('.convert_text_container .fa-minus')
window.SpeechRecognition = window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();
recognition.interimResults = true;

recognition.addEventListener('result', e => {
    const transcript = Array.from(e.results)
        .map(result => result[0])
        .map(result => result.transcript)
        .join('');

    convert_text.html(transcript);

    if (speech == true) {
        recognition.start();
    }
});



convert_text_container.hide()
click_to_convert.click(function() {
    if(!convert_temp) {
        convert_text_container.show();
        convert_temp = true;
        if (speech == true) {
            recognition.start();
        }
    }
    else {
        convert_text_container.hide()
        convert_temp = false;
    }
   
   
}) 
right_convert.click(function() {
    console.log("1");
    question_input.val(convert_text.val())
    convert_text.val('')
    convert_text_container.hide()
    question_input.focus()

})
wrong_convert.click(function() {
    convert_text.val('')
})
hide_convert.click(function() {
    convert_text_container.hide()
})

// click_to_convert.on('click', function() {
//     if (speech == true) {
//         recognition.start();
//     }
// });





});
