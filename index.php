<!doctype html>
<html>
<head>
    <script src="js/phaser.js"></script>
    <style>
    canvas, html, body {
            margin:0;
            margin-left: auto;
            margin-right: auto;
            display: block;
            background-color: black;

            height: 100%;
            vertical-align: middle;
        }
    </style>

    <script type="text/javascript">
        var height = 480;
        var width = 720;
        var htop = 100;
        var time = "day";

        var res = "./res/"
        var game = new Phaser.Game(width, height, Phaser.AUTO, '', { preload: preload, create: create, update: update });

        function preload() {
            game.load.image("sun", "res/sun.png");
            game.load.image("moon", "res/moon.png");
            game.load.image("black", "res/black.png");
            game.load.image("grass", "res/grass.png");
        }

        function create(){
            game.stage.backgroundColor = '#008aff';
            //night sky
            sky = game.add.sprite(0, 0, 'black');
            sky.scale.set(width,height); 
            sky.alpha=0;
            sky.inputEnabled = true;
            sky.events.onInputDown.add(stars_clouds,this);


            sun = game.add.sprite(550, 100, 'sun');
            sun.scale.setTo(.8,.8);        
            sun.inputEnabled = true;
            sun.events.onInputDown.add(night,this);

            moon = game.add.sprite(100, height, 'moon');
            moon.scale.setTo(.7,.7);        
            moon.inputEnabled = true;
            moon.events.onInputDown.add(day,this);

            grass= game.add.sprite(0, height - 45, 'grass');

            game.input.onDown.add(gofull, this);
        }

        function update(){

        }

        function gofull(){
            game.scale.fullScreenScaleMode = Phaser.ScaleManager.SHOW_ALL;
            game.scale.startFullScreen();
        }

        function night(){
            time = "night";
            game.add.tween(sun).to({y:height}, 1000, Phaser.Easing.Linear.None, true);
            game.add.tween(moon).to({y:htop}, 1000, Phaser.Easing.Linear.None, true);
            game.add.tween(sky).to( { alpha: 1 }, 1000, Phaser.Easing.Linear.None, true);
            console.log(time);
        }

        function day(){
            time = "day";
            game.add.tween(moon).to({y:height}, 1000, Phaser.Easing.Linear.None, true);
            game.add.tween(sun).to({y:htop}, 1000, Phaser.Easing.Linear.None, true);
            game.add.tween(sky).to( { alpha: 0 }, 1000, Phaser.Easing.Linear.None, true);
            console.log(time);
        }

        function stars_clouds(){
            if(time == "day"){
                console.log("cloud");
            }else{
                console.log("star");
            }
        }
    </script>
</head>
<body>
</body>
</html>
