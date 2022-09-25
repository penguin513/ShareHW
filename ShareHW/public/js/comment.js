const user_id = @json($user_id);

$(function () {
    get_data();
});

function get_data() {
    $.ajax({
        url: "result/ajax/",
        dataType: "json",
        success: data => {
            $("#comment-data")
                .find(".comment-visible")
                .remove();

            for (var i = 0; i < data.comments.length; i++) {
                var html = `
                    <div id="scroll_b" class="comment-visible block">
                        <div class="media-body flex flex-col items-end">user_id
                            <div class="comment-body py-2 px-5 text-gray-800 hover:text-gray-500 rounded-lg block mt-8 ml-2 mr-0"
                            style="background: rgb(255, 201, 201); width: 45%; min-width: 220px;">
                                <p class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</p>
                                <p class="comment-body-content" id="comment">${data.comments[i].comment}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="comment-body-content text-md" id="comment">${data.comments[i].created_at}</p>
                            </div>

                        </div>
                    </div>
                `;

                $("#comment-data").append(html);
            }
        },
        error: () => {
            alert("ajax Error");
        }
    });


    let event = document.getElementById('submit');

    event.addEventListener('click', function () {
        let chatArea = document.getElementById('scroll_b'),
            chatAreaHeight = chatArea.scrollHeight;
        chatArea.scrollTop = chatAreaHeight;
    })

    window.addEventListener('DOMContentLoaded', () => {
        const target = document.getElementById('scroll_b');
        target.scrollIntoView(false);
    });


    setTimeout("get_data()", 5000);
}
