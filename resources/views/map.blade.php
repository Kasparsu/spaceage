<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
</head>
<body>

<canvas id="myCanvas" width="1000px" height="1000px" style="border:1px solid #d3d3d3;">
        Your browser does not support the HTML5 canvas tag.</canvas>

<script>
    var canvas= document.getElementById("myCanvas");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    var stage = new createjs.Stage("myCanvas");
    var stage2 = new createjs.Stage("myCanvas");
    var obj = [];
    //img.src = 'http://www.pngall.com/wp-content/uploads/2016/07/Sun-PNG-HD.png';
    $.ajax({
        url: "data",
        cache: false
    }).done(function( html ) {
        obj = JSON.parse(html);
        draw(obj);
    });

    function draw(obj) {
        console.log("hi");
        var i = 0;
        obj.forEach(function(el){
                addCircle(1, el[0] * 1000, el[1] * 1000);
        });
        addgrid();
        stage.update();
    }
    function addgrid(){

        for(var i = 0; i<canvas.width; i=i+(canvas.width/20)) {

            console.log(i);
            var line = new createjs.Shape();
            line.graphics.setStrokeStyle(1);
            line.graphics.beginStroke("#ff0000");
            line.graphics.moveTo(i, 0);
            line.graphics.lineTo(i, canvas.height);
            line.graphics.endStroke();
            stage2.addChild(line);
        }
        stage2.update();
    }
    function addCircle(r,x,y){
        var g=new createjs.Graphics().beginFill("#ff0000").drawCircle(0,0,r);
        var s=new createjs.Shape(g);
        s.x=x;
        s.y=y;
        stage.addChild(s);
    }
    canvas.addEventListener("mousewheel", MouseWheelHandler, false);
    canvas.addEventListener("DOMMouseScroll", MouseWheelHandler, false);

    var zoom;

    function MouseWheelHandler(e) {
        e.preventDefault();
        if(Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)))>0)
            zoom=1.1;
        else
            zoom=1/1.1;

        var local = stage.globalToLocal(stage.mouseX, stage.mouseY);
        stage.regX=local.x;
        stage.regY=local.y;
        stage.x=stage.mouseX;
        stage.y=stage.mouseY;
        stage.scaleX=stage.scaleY*=zoom;


        stage.update();
    }


    stage.addEventListener("stagemousedown", function(e) {
        var offset={x:stage.x-e.stageX,y:stage.y-e.stageY};
        stage.addEventListener("stagemousemove",function(ev) {
            stage.x = ev.stageX+offset.x;
            stage.y = ev.stageY+offset.y;
            addgrid();
            stage.update();
        });
        stage.addEventListener("stagemouseup", function(){
            stage.removeAllEventListeners("stagemousemove");
        });
    });
</script>

</body>
</html>
