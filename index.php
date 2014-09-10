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

        var speed = 2000;

        var sounds = [];

        var star_num = 0;
        var max_stars = 5;

        var res = "./res/"
        var game = new Phaser.Game(width, height, Phaser.AUTO, '', { preload: preload, create: create, update: update });

        function preload() {
            game.load.image("sun", "res/sun.png");
            game.load.image("moon", "res/moon.png");
            game.load.image("black", "res/black.png");
            game.load.image("grass", "res/grass.png");
            game.load.image("star", "res/star.png");

            game.load.audio('star_die', ['res/stars_die.mp3','res/stars_die.ogg']);
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

            stars = game.add.group();

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
            game.add.tween(sun).to({y:height}, speed, Phaser.Easing.Linear.None, true);
            game.add.tween(moon).to({y:htop}, speed, Phaser.Easing.Linear.None, true);
            game.add.tween(sky).to( { alpha: 1 }, speed, Phaser.Easing.Linear.None, true);
            game.add.tween(stars).to( { alpha: 1 }, speed, Phaser.Easing.Linear.None, true);
            console.log(time);
        }

        function day(){
            time = "day";
            game.add.tween(moon).to({y:height}, speed, Phaser.Easing.Linear.None, true);
            game.add.tween(sun).to({y:htop}, speed, Phaser.Easing.Linear.None, true);
            game.add.tween(sky).to( { alpha: 0 }, speed, Phaser.Easing.Linear.None, true);
            game.add.tween(stars).to( { alpha: 0 }, speed, Phaser.Easing.Linear.None, true);
            console.log(time);
        }

        function stars_clouds(){
            var x = game.input.x;
            var y = game.input.y;

            if(time == "day"){
                console.log("cloud");
            }else{
                star_num += 1;
                if(star_num <= 10){
                    var star = stars.create(x, y, 'star');
                    star.name = 'star' + star_num;
                    star.scale.setTo(.4,.4);
                    star.anchor.y = .5;
                    star.anchor.x = .5;
                    star.rotation = Math.random();
                    console.log("star");
                }

                if(star_num == 10){
                    setTimeout(function(){
                        for(var i = 0;i<stars.children.length;i++){       
                            var star = stars.children[i];
                            game.add.tween(star.scale).to( { x: 0, y: 0 }, 1000, Phaser.Easing.Linear.None, true);
                        }
                        die = game.add.audio('star_die');
                        die.play();
                        setTimeout(function(){
                            for(var i = 0;i<stars.children.length;i++){
                                stars.children[i].kill();
                            }
                            star_num = 0;
                        },3000);
                    },3000);
                }
                
                    
            }
        }
    </script>
</head>
<body>
</body>
</html>
