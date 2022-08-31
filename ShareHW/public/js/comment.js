$(function() {
    get_data();

});

function get_data() {
    $.ajax({
        url: "chat/result/ajax/",
        dataType: "json",
        success: data => {
            $("#comment-data")
                .find(".comment-visible")
                .remove();

            for (let i = 0; i < data.comments.length; i++) {
                let ymd = data.comments[i].created_at.toLocaleString().slice(0,10);
                let hms = data.comments[i].created_at.toLocaleString().slice(11, 19);
                let comment = data.comments[i].comment
                                            .replace(/&/g, '&lt;')
                                            .replace(/</g, '&lt;')
                                            .replace(/>/g, '&gt;')
                                            .replace(/"/g, '&quot;')
                                            .replace(/'/g, "&#x27;");
                let html = `
                    <div id="scroll_b" class="comment-visible rounded-lg" style="margin-bottom: .5rem; background: #99ff99; width: 45%;">
                        <div class="media-body comment-body py-2 px-5 text-gray-800 hover:text-gray-500">
                            <div class="flex items-center">
                                <span class="comment-body-user font-bold text-sm" id="name">${data.comments[i].name}</span>
                                <span class="comment-body-time text-xs ml-2 text-right text-gray-500" id="created_at">${ymd + '  ' + hms}</span>
                            </div>
                            <span class="comment-body-content text-md" id="comment">${comment}</span>
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

    setTimeout("get_data()", 5000);

}
