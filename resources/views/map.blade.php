<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
    <script src="https://unpkg.com/supercluster@2.2.0/dist/supercluster.min.js"></script>
    <script type="text/javascript" src="js/L.Grid.js"></script>
    <link rel="stylesheet" href="css/L.Grid.css" />
    <style>
        #mapid{
            height: 800px;
        }
    </style>
</head>
<body>

<div id="mapid"></div>

<script>
    var map = L.map('mapid', {
        crs: L.CRS.Simple,
        zoom:3,
        minZoom:2,
        maxZoom:7,
        grid: {
                2: 1, 3: 1, 4: .5, 5: .5, 6: .1, 7: .1, strokeStyle: "rgba(60,90,120,0.85)", limit: [0, 15.36]
        }
    });
        $.ajax({
            url: "data",
            cache: false
        }).done(function( html ) {
            obj = JSON.parse(html);
            draw(obj);
        });
    var bounds = [[0,0], [1000,1000]];
    map.fitBounds(bounds);


    function draw(obj) {
            console.log("hi");
            var i = 0;
            obj.forEach(function(el){
                    if(i == 100) {

                        L.marker(L.latLng([ el['Y'], el['X'] ])).addTo(map);
                        i=0;
                    }
                i++;
            });
        }
//    var canvas= document.getElementById("myCanvas");
//    var stage = new createjs.Stage("myCanvas");
//    stage.x = canvas.height/2;
//    stage.y = canvas.width/2;
//    var obj = [];
//    var lines = [];
//    //img.src = 'http://www.pngall.com/wp-content/uploads/2016/07/Sun-PNG-HD.png';
//    $.ajax({
//        url: "data",
//        cache: false
//    }).done(function( html ) {
//        obj = JSON.parse(html);
//        draw(obj);
//    });
//
//    function draw(obj) {
//        console.log("hi");
//        var i = 0;
////        obj.forEach(function(el){
////                if(i == 10) {
////                    addCircle(0.5, el['X'], el['Y']);
////                    i=0;
////                }
////            i++;
////        });
//
//        addbox();
//        addboxgrid();
//        stage.update();
//    }
//    function removegrid(){
//
//        for(var i = 0; i<lines.length; i++) {
//            stage.removeChild(lines[i]);
//        }
//        lines = [];
//        stage.update();
//    }
//    function addboxgrid(){
//
//        for(var i = Math.round(-(stage.x -stage.regX*stage.scaleX)/stage.scaleX); i<(-(stage.x -stage.regX*stage.scaleX)+ canvas.width)/stage.scaleX ; i=i + 0.1) {
//            for(var j = Math.round(-(stage.y -stage.regY*stage.scaleX)/stage.scaleX); j<(-(stage.y -stage.regY*stage.scaleX-canvas.height)/stage.scaleX) ; j+=0.1) {
//                if(Math.abs(i.toFixed(1)%(64/stage.scaleX))==0.5 && Math.abs(j.toFixed(1)%(64/stage.scaleX))==0.5) {
//                    var border = new createjs.Shape();
//                    border.graphics.beginStroke("#000");
//                    border.graphics.setStrokeStyle(1 / stage.scaleX);
//                    border.graphics.drawRect(i, j, 64/stage.scaleX, 64/stage.scaleX);
//                    lines.push(border);
//                    stage.addChild(border);
//                }
//            }
//        }
////        for(i = Math.round(-(stage.y -stage.regY*stage.scaleX)/stage.scaleX); i<(-(stage.y -stage.regY*stage.scaleX-canvas.height)/stage.scaleX) ; i+=0.1) {
////
////            if(Math.abs(i.toFixed(1)%(64/stage.scaleX))==0.5) {
////                console.log(i);
////                line = new createjs.Shape();
////                line.graphics.setStrokeStyle(1 / stage.scaleX);
////                line.graphics.beginStroke("#000");
////                line.graphics.moveTo(-(stage.x -stage.regX*stage.scaleX)/stage.scaleX, i);
////                line.graphics.lineTo((-(stage.x -stage.regX*stage.scaleX)+ canvas.width)/stage.scaleX , i);
////                line.graphics.endStroke();
////                lines.push(line);
////                stage.addChild(line);
////            }
////        }
////        stage.update();
//    }
//    function addgrid(){
//
//        for(var i = Math.round(-(stage.x -stage.regX*stage.scaleX)/stage.scaleX); i<(-(stage.x -stage.regX*stage.scaleX)+ canvas.width)/stage.scaleX ; i=i + 0.1) {
//            console.log(i.toFixed(1));
//            if(Math.abs(i.toFixed(1)%(64/stage.scaleX))==0.5) {
//                console.log(i);
//                var line = new createjs.Shape();
//                line.graphics.setStrokeStyle(1 / stage.scaleX);
//                line.graphics.beginStroke("#000");
//                line.graphics.moveTo(i, -(stage.y -stage.regY*stage.scaleX)/stage.scaleX);
//                line.graphics.lineTo(i , -(stage.y -stage.regY*stage.scaleX-canvas.height)/stage.scaleX);
//                line.graphics.endStroke();
//                lines.push(line);
//                stage.addChild(line);
//            }
//        }
//        for(i = Math.round(-(stage.y -stage.regY*stage.scaleX)/stage.scaleX); i<(-(stage.y -stage.regY*stage.scaleX-canvas.height)/stage.scaleX) ; i+=0.1) {
//
//            if(Math.abs(i.toFixed(1)%(64/stage.scaleX))==0.5) {
//                console.log(i);
//                line = new createjs.Shape();
//                line.graphics.setStrokeStyle(1 / stage.scaleX);
//                line.graphics.beginStroke("#000");
//                line.graphics.moveTo(-(stage.x -stage.regX*stage.scaleX)/stage.scaleX, i);
//                line.graphics.lineTo((-(stage.x -stage.regX*stage.scaleX)+ canvas.width)/stage.scaleX , i);
//                line.graphics.endStroke();
//                lines.push(line);
//                stage.addChild(line);
//            }
//        }
//        stage.update();
//    }
//    function addbox(){
//        console.log(stage.x + ":" + stage.y);
//            var line = new createjs.Shape();
//            line.graphics.setStrokeStyle(1/stage.scaleX);
//            line.graphics.beginStroke("#000");
//            line.graphics.moveTo(50/stage.scaleX , 50/stage.scaleX);
//            line.graphics.lineTo(50/stage.scaleX, -50/stage.scaleX);
//            line.graphics.lineTo(-50/stage.scaleX, -50/stage.scaleX);
//            line.graphics.lineTo(-50/stage.scaleX, 50/stage.scaleX);
//            line.graphics.lineTo(50/stage.scaleX, 50/stage.scaleX);
//            line.graphics.endStroke();
//        //lines.push(line);
//            stage.addChild(line);
//        stage.update();
//    }
//    function addCircle(r,x,y){
//        var g=new createjs.Graphics().beginFill("#ff0000").drawCircle(0,0,r);
//        var s=new createjs.Shape(g);
//        s.x=x;
//        s.y=y;
//        stage.addChild(s);
//    }
//    canvas.addEventListener("mousewheel", MouseWheelHandler, false);
//    canvas.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
//
//    var zoom;
//
//    function MouseWheelHandler(e) {
//        e.preventDefault();
//        if(Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)))>0)
//            zoom=2;
//        else
//            zoom=0.5;
//
//        var local = stage.globalToLocal(stage.mouseX, stage.mouseY);
//        stage.regX=local.x;
//        stage.regY=local.y;
//        console.log(stage.scaleX);
//        stage.x=stage.mouseX;
//        stage.y=stage.mouseY;
//        stage.scaleX=stage.scaleY*=zoom;
//        removegrid();
//        addboxgrid();
//
//        stage.update();
//    }
//    stage.enableMouseOver(10);
//    stage.addEventListener("stagemousemove", function(e) {
//        console.log("mouse:" +(stage.mouseX) + ":" + (stage.mouseY));
//        console.log("stage:" +(stage.x) + ":" + (stage.y));
//        console.log("reg:" +(stage.regX) + ":" + (stage.regY));
//        console.log("realcoords:" +(stage.x - stage.mouseX-stage.regX*stage.scaleX) + ":" + (stage.y -stage.mouseY-stage.regY*stage.scaleX));
//        console.log("cornercoords:" +(stage.x -stage.regX*stage.scaleX) + ":" + (stage.y -stage.regY*stage.scaleX));
//
//    });
//    stage.addEventListener("stagemousedown", function(e) {
//        var offset={x:stage.x-e.stageX,y:stage.y-e.stageY};
//        stage.addEventListener("stagemousemove",function(ev) {
//            var local = stage.globalToLocal(stage.mouseX, stage.mouseY);
//            stage.x = ev.stageX+offset.x;
//            stage.y = ev.stageY+offset.y;
////            removegrid();
////            addboxgrid();
//            stage.update();
//        });
//        stage.addEventListener("stagemouseup", function(){
//            stage.removeAllEventListeners("stagemousemove");
//            stage.addEventListener("stagemousemove", function(e) {
//
//                console.log("mouse:" +(stage.mouseX) + ":" + (stage.mouseY));
//                console.log("stage:" +(stage.x) + ":" + (stage.y));
//                console.log("reg:" +(stage.regX) + ":" + (stage.regY));
//                console.log("realcoords:" + -(stage.x - stage.mouseX-stage.regX*stage.scaleX)/stage.scaleX + ":" + -(stage.y -stage.mouseY-stage.regY*stage.scaleX)/stage.scaleX);
//                console.log("cornercoords:" + -(stage.x -stage.regX*stage.scaleX)/stage.scaleX + ":" + -(stage.y -stage.regY*stage.scaleX)/stage.scaleX);
//                console.log("topcornergrid:" + -(stage.x -stage.regX*stage.scaleX)/stage.scaleX + ":" + -(stage.y -stage.regY*stage.scaleX)/stage.scaleX);
//                console.log("bottomcornergrid:" + (-(stage.x -stage.regX*stage.scaleX)+ canvas.width)/stage.scaleX + ":" + -(stage.y -stage.regY*stage.scaleX-canvas.height)/stage.scaleX);
//                console.log("lengthgrid:" + (-(stage.y -stage.regY*stage.scaleX) - (-(stage.y -stage.regY*stage.scaleX) + canvas.height)));
//                console.log(1%128/stage.scaleX);
//
//            });
//        });
//    });
</script>

</body>
</html>
