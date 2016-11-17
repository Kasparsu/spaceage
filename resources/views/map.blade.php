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
    var obj = [];
    var lines = [];
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
                if(i == 10) {
                    addCircle(0.5, el['X'], el['Y']);
                    i=0;
                }
            i++;
        });
        addgrid();
        stage.update();
    }
    function removegrid(){

        for(var i = 0; i<lines.length; i++) {
            stage.removeChild(lines[i]);
        }
        lines = [];
        stage.update();
    }

    function addgrid(){
        console.log(stage.x);
        for(var i = -stage.x; i<-stage.x + canvas.width; i+=1) {

                if(i%100 ==0) {
                    var line = new createjs.Shape();
                    line.graphics.setStrokeStyle(1 / stage.scaleX);
                    line.graphics.beginStroke("#ff0000");
                    line.graphics.moveTo(i / stage.scaleX + stage.regX, (-stage.y) / stage.scaleX + stage.regY);
                    line.graphics.lineTo(i / stage.scaleX + stage.regX, (-stage.y + canvas.height) / stage.scaleX + stage.regY);
//                    line.graphics.moveTo(i , -stage.y);
//                    line.graphics.lineTo(i , -stage.y + canvas.height);
                    line.graphics.endStroke();
                    lines.push(line);
                    stage.addChild(line);
                }
        }
        stage.update();
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
            zoom=2;
        else
            zoom=0.5;

        var local = stage.globalToLocal(stage.mouseX, stage.mouseY);
        stage.regX=local.x;
        stage.regY=local.y;
        console.log(stage.regX);
        stage.x=stage.mouseX;
        stage.y=stage.mouseY;
        stage.scaleX=stage.scaleY*=zoom;
        removegrid();
        addgrid();


        stage.update();
    }


    stage.addEventListener("stagemousedown", function(e) {
        var offset={x:stage.x-e.stageX,y:stage.y-e.stageY};
        stage.addEventListener("stagemousemove",function(ev) {
            stage.x = ev.stageX+offset.x;
            stage.y = ev.stageY+offset.y;
            console.log(stage.x + ":" + stage.y);
            removegrid();
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
