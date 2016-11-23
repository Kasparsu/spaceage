
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>CSS 3D Solar System</title>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/solar.css">

</head>

<body>
<body class="opening hide-UI view-2D zoom-large data-close controls-close">
<div id="navbar">
    <a id="toggle-data" href="#data"><i class="icon-data"></i>Data</a>
    <a id="toggle-controls" href="#controls"><i class="icon-controls"></i>Controls</a>
</div>
<div id="data">
    <a class="sun" title="sun" href="#sunspeed">Sun</a>
    <a class="mercury" title="mercury" href="#mercuryspeed">Mercury</a>
    <a class="venus" title="venus" href="#venusspeed">Venus</a>
    <a class="earth active" title="earth" href="#earthspeed">Earth</a>
    <a class="mars" title="mars" href="#marsspeed">Mars</a>
    <a class="jupiter" title="jupiter" href="#jupiterspeed">Jupiter</a>
    <a class="saturn" title="saturn" href="#saturnspeed">Saturn</a>
    <a class="uranus" title="uranus" href="#uranusspeed">Uranus</a>
    <a class="neptune" title="neptune" href="#neptunespeed">Neptune</a>
</div>
<div id="controls">
    <label class="set-view">
        <input type="checkbox">
    </label>
    <label class="set-zoom">
        <input type="checkbox">
    </label>
</div>
<div id="universe" class="scale-stretched">
    <div id="galaxy">
        <div id="solar-system" class="earth">
            <div id="mercury" class="orbit" style="width: 32em; height: 32em; margin-top: -16em; margin-left: -16em;">

                <div class="pos">
                    <div class="planet">
                        <dl class="infos">
                            <dt>Mercury</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="venus" class="orbit">
                <div class="pos">
                    <div class="planet">
                        <dl class="infos">
                            <dt>Venus</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="earth" class="orbit">
                <div class="pos">
                    <div class="orbit">
                        <div class="pos">
                            <div class="moon"></div>
                        </div>
                    </div>
                    <div class="planet">
                        <dl class="infos">
                            <dt>Earth</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="mars" class="orbit">
                <div class="pos">
                    <div class="planet">
                        <dl class="infos">
                            <dt>Mars</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="jupiter" class="orbit">
                <div class="pos">
                    <div class="planet">
                        <dl class="infos">
                            <dt>Jupiter</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="saturn" class="orbit">
                <div class="pos">
                    <div class="planet">
                        <div class="ring"></div>
                        <dl class="infos">
                            <dt>Saturn</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="uranus" class="orbit">
                <div class="pos">
                    <div class="planet">
                        <dl class="infos">
                            <dt>Uranus</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="neptune" class="orbit" style="width: 210em; height: 210em; margin-top: -105em; margin-left: -105em; animation-duration: 10s; z-index: 2; animation-delay: 0s;">
                <div class="pos" style="animation-duration: 10s;  left: 50%; top: 0%; animation-delay: -5s;">
                    <div class="planet" style="font-size: 4.9em; animation-duration: 10s; animation-delay: -5s; background-image: url(img/sun.png);">

                        <dl class="infos">
                            <dt>Neptune</dt>
                            <dd><span></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="sun">
                <dl class="infos">
                    <dt>Sun</dt>
                    <dd><span></span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>

</body>


<script src="js/solar.js"></script>
<script>
    $("div#neptune.orbit").css('animation-delay','-5s');
</script>

</body>
</html>

