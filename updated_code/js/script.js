$(document).ready(() => {
    $(".chat-btn").click(() => {
        $(".chat-box").slideToggle("slow")
    })
    $(".chat-btn").click(() => {
        $(".chat-menu").slideToggle("slow")
    })
})

$('#submit').click(function () {
    var text = $('#input').val();
    $('#newDivs').append('<div>' + text + '</div>');
});