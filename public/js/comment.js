$(document).ready(function () {

    const comment_submit = $(".comment_submit");
    const comment_container = $(".comment_item_container");
    comment_submit.click(function (event) {
        var token = $('input[name="_token"]');
        var id_pd = $('input[name="id"]');
        var content = $(".comment textarea");
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/detail_product/addComment",
            data: {
                id: id_pd.val(),
                content: content.val(),
                _token: token.val(),
            },
            success: function (response) {
                console.log(response);
                comment_container.append(
                    `
                    <div class="comment_item">
                    <div class="avatar_name">
                      <div><img src="/images/dog.avif" alt=""></div>
                      <div><span class="text fw-bold">${ response.name}</span></div>
                    </div>
                    <div class="comment_content">
                      ${ content.val() }
                    </div>
                    <div class="view_more">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="value_comment" value="${response.id}">
                    <button class="view_more_button"><i class="fa-solid fa-caret-down"></i> Xem Phản Hồi</button>
                  </div>
                    
                  </div>
                    `
                );

                content.val("");
            },
        });
    });



    $(document).on('click', '.view_more_button', function () {
      $(this).hide()
  
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
        let id = $(this)
            .closest(".view_more")
            .find('input[name="value_comment"]')
            .val();
        var token = $('.view_more input[name="_token"]');
        let comment_container_item = $(this).closest(".comment_container_item");
        console.log("1");
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/detail_product/showReponseComment",
            data: {
                id: id,
                _token: token.val(),
            },
            success: function (response) {
                if(response.length>0) {
                  console.log(response);
                let item_comments = response.map(
                    (element) => `
    <div class="detail_comment">
        <div class="avatar_name">
            <div><img src="/images/dog.avif" alt=""></div>
            <div><span class="text fw-bold">${element.nameOfUser}</span></div>
        </div>
        <div class="comment_content">
            ${element.noidung}
        </div>
    </div>`
                ).join('');
                console.log(item_comments);
                let comment_container = `
        <div class="detail_comment_container">
<div class="detail_comment_show">
 ${item_comments}
   </div>
<div class="reponse_comment">
<input type="hidden" name="_token" value="${csrfToken}">
  <input class="input_id_comment" type="hidden" value="${id}">
  <input type="text" class=" reponse_comment_input">
  <button type="submit" class=" reponse_comment_button">Gửi</button>
</div>
</div>
 
        `;
                comment_container_item.append(comment_container);
                }
                else {
                  comment_container_item.append(`
                  <div class="detail_comment_container">
                  <div class="detail_comment_show">
            
                     </div>
                  <div class="reponse_comment">
                  <input type="hidden" name="_token" value="${csrfToken}">
                    <input class="input_id_comment" type="hidden" value="${id}">
                    <input type="text" class=" reponse_comment_input">
                    <button type="submit" class=" reponse_comment_button">Gửi</button>
                  </div>
                  </div>
                   
                  `);
                }
            },
        });
    });

  
    $(document).on('click', '.reponse_comment_button', function () {
      console.log('1');
        var token = $('.reponse_comment input[name="_token"]');
        var id = $(this)
            .closest(".reponse_comment")
            .find(".input_id_comment")
            .val();
        var content_response = $(this)
            .closest(".reponse_comment")
            .find(".reponse_comment_input");
        var detail_comment_show = $(this)
            .closest(".detail_comment_container")
            .find(".detail_comment_show");

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/detail_product/addReponseComment",
            data: {
                id: id,
                content_response: content_response.val(),
                _token: token.val(),
            },
            success: function (response) {
                detail_comment_show.append(
                    `
          <div class="detail_comment">
          <div class="avatar_name">
           <div><img src="/images/dog.avif" alt=""></div>
           <div><span class="text fw-bold">${response}</span></div>
         </div>
         <div class="comment_content">
          ${content_response.val()}
         </div>
       </div>
          `
                );
                content_response.val("");
            },
        });
    });
});
