<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/leaflet.js"></script>
    <link rel="stylesheet" href="css/leaflet.css" />
    <script src="js/supercluster.min.js"></script>
    <script type="text/javascript" src="js/L.simpleGraticule.js"></script>
    <link rel="stylesheet" href="css/L.simpleGraticule.css" />
    <script src="js/leaflet.markercluster.js"></script>
    <script src="js/simpleheat.js"></script>
    <script src="js/HeatLayer.js"></script>
    <link rel="stylesheet" href="css/MarkerCluster.Default.css" />
    <style>
        #mapid{
            height: 800px;
        }
    </style>
</head>
<body>

<div id="mapid"></div>

<script>

    // map initialison
    var map = L.map('mapid', {
        crs: L.CRS.Simple,
        minZoom: -2,
        maxZoom:6,
    });

/// load markers
        $.ajax({
            url: "data",
            cache: false
        }).done(function( html ) {
            obj = JSON.parse(html);
            draw(obj);
        });
    // set map bounds
    var bounds = [[0,0], [1000 ,1000]];
    map.fitBounds(bounds);
    //set grid options
    var options = {interval: 20,
        showOriginLabel: false,
        redraw: 'move',
        zoomIntervals: [
            {start: -10, end: -2, interval: 500},
            {start: -2, end: -1, interval: 100},
            {start: 0, end: 1, interval: 50},
            {start: 2, end: 3, interval: 10},
            {start: 4, end: 20, interval: 1}
        ]};

    L.simpleGraticule(options).addTo(map);
    // custom marker

    var star = L.icon({
        iconUrl: 'img/Sun-PNG-LD.png',

        iconSize:     [50, 50], // size of the icon
        iconAnchor:   [25, 25], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, 50] // point from which the popup should open relative to the iconAnchor
    });

    // handle drawinf markers
    function draw(obj) {
            var i = 0;
//        var markers = L.markerClusterGroup({
//            disableClusteringAtZoom:6
//        });
        var heatpoints = [];
        console.log(Math.random());
        obj.forEach(function(el){
            heatpoints.push([ el['Y'], el['X'], Math.random() ]);
        });
        var heat = L.heatLayer(heatpoints, {radius: 10}).addTo(map);
//            obj.forEach(function(el){
//
//                markers.addLayer(L.marker(L.latLng([ el['Y'], el['X'] ]), {icon: star}).on('dblclick', onDblClick));
//                i++;
//            });
//        map.addLayer(markers);
        }

    function onDblClick(e){
        console.log(this.getLatLng())
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
