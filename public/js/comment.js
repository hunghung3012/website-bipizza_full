$(document).ready(function() {

    const comment_submit = $('.comment_submit');
    const comment_container = $('.comment_item_container');
    comment_submit.click(function(event) {
        event.preventDefault
        var token = $('input[name="_token"]')
        var id_pd = $('input[name="id"]')
        var content = $('.comment textarea')
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/detail_product/addComment",
            data: {
                id:id_pd.val() ,
                content:content.val() ,
                _token:  token.val()
,
        },
            success: function (response) {
                console.log(response);
                comment_container.append(
                    `
                    <div class="comment_item">
                    <div class="avatar_name">
                      <div><img src="/images/dog.avif" alt=""></div>
                      <div><span class="text fw-bold">`+response+`</span></div>
                    </div>
                    <div class="comment_content">
                      `+content.val()+`
                    </div>
                    
                  </div>
                    `
                   
                )

                content.val('')
            }
        });
    })
})