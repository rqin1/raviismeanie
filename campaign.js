function moveToPoint2(){
    $("playerOne").velocity({
        left:"500px",
    },{
        duration: 3000,
        easing: "linear"
    });
}
$("movePoint").on('click',function(){
    moveToPoint2();
});