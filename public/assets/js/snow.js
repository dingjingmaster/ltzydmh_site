function snow() {
    //1、定义一片雪花模板
    var flake = $("<div>").css({
        "position": "absolute",
        "color": "#87CEFF"
    }).html("❄");
    var documentWidth = $(document).width();
    var documentHieght = $(document).height();
    var millisec = 666;
    setInterval(function() {
        var startLeft = Math.random() * documentWidth;
        var endLeft = Math.random() * documentWidth;
        var flakeSize = 16 + 16 * Math.random();
        var durationTime = 6666 + 9999 * Math.random();
        var startOpacity = 0.6 + 0.1 * Math.random();
        var endOpacity = 0.1 + 0.2 * Math.random();
        flake.clone().appendTo($("body")).css({
            "padding": 6,
            "left": startLeft,
            "opacity": startOpacity,
            "font-size": flakeSize,
            "top": "-25px"
        }).animate({
            //"right": end
            "padding": 6,
            "left": endLeft - 10,
            "opacity": endOpacity,
            "top": documentHieght - 50
        },
            durationTime,
            function() {
                $(this).remove();
            }
        );
    }, millisec);
}