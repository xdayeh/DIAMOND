<style>
    #game {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        display: none;
        background: #111;
        cursor: none;
    }
    button {
        width: 100%;
        padding: 10px;
        font-family: 'Noto Sans', sans-serif;
        font-weight: bolder;
        font-size: 150%;
        outline: 0 none;
        border: none;
        border-radius: 4px;
        transition: background 0.2s;
        cursor: pointer;
    }
    button:active {
        box-shadow: inset 0 5px 10px -5px rgba(0,0,0,0.6);
    }
    .hide {
        display: none;
    }
    #play {
        color: #161b22;
        background-color: #36899c;
        border-color: #143943;
    }
    #play:hover {
        color: #FFF;
    }
    #restart {
        background: #0084ff;
        color: white;
    }
    #restart:hover {
        background: #0058aa;
    }
    #acheive{
        color: #00a800;
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
<div class="text-center text-white">
<div id="page1">
    <h1>Diamond DND game</h1>
    <p>Use the mouse to move. Avoid large diamonds and eat smaller diamonds!</p>
    <p>High score: <span id="highscore">0</span></p>
    <button id="play">Play</button>
</div>
<div id="page2" class="hide">
    <!-- Page 2 die -->
    <h1>You died!</h1>
    <p>Score: <span id="score">0</span></p>
    <p id="acheive" class="hide">New high score!</p>
    <button id="restart">Retry</button>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.0.0/p5.min.js"></script>
<script>
    function circCircCol(x1, y1, diam1, x2, y2, diam2) {
        var dx = x1 - x2;
        var dy = y1 - y2;
        var dist2 = dx * dx + dy * dy;
        var sum = (diam1 + diam2) / 2;
        return dist2 <= sum * sum;
    };
    var size = 20;
    var max = size+40;
    var started = false;

    if(!localStorage.getItem("highscore")){
        localStorage.setItem("highscore", 0);
    }

    var highscore = parseInt(localStorage.getItem("highscore"));
    document.getElementById("highscore").innerHTML = highscore;

    //score = size-20

    var colors = [
        [3, 173, 252],
        [0, 184, 15],
        [255, 234, 0],
        [255, 119, 0],
        [255, 0, 0],
        [250, 27, 220],
        [0, 255, 179],
        [174, 255, 0],
        [255, 77, 0]
    ];

    function setup(){
        createCanvas(windowWidth, windowHeight).id("game");
        background("#111");
        document.getElementById("game").addEventListener("touchstart", function(e){
            e.preventDefault();
        });
        document.getElementById("game").addEventListener("touchmove", function(e){
            e.preventDefault();
        })
    }
    var Cell = function(x, y, size, type){
        this.x = x;
        this.y = y;
        this.size = round(size);
        this.type = type;
        if(this.x <= 0 && this.y <= 0){
            this.theta = random(0, PI/2);
        }else if(this.x <= 0 && this.y >= windowHeight){
            this.theta = random(-PI/2, 0);
        }else if(this.x >= windowWidth && this.y >= windowHeight){
            this.theta = random(PI, 3*PI/2);
        }else{
            this.theta = random(PI/2, PI);
        }
        this.speed = random(1, 3);
    };
    Cell.prototype.draw = function(){
        fill(this.type[0], this.type[1], this.type[2], 0.3*255);
        ellipse(this.x, this.y, this.size+5, this.size+5);
        fill(this.type[0], this.type[1], this.type[2]);
        ellipse(this.x, this.y, this.size, this.size);
        this.x += this.speed * cos(this.theta);
        this.y += this.speed * sin(this.theta);
    };
    var cells = [];

    // you
    var Player = function(x, y){
        this.x = x;
        this.y = y;
        this.size = size;
    };
    Player.prototype.draw = function(){
        fill(255, 0.3*255);
        ellipse(this.x, this.y, this.size+5, this.size+5);
        fill(255);
        ellipse(this.x, this.y, this.size, this.size);
        var self = this;
        cells.forEach(function(c, i){
            if(circCircCol(self.x, self.y, self.size, c.x, c.y, c.size)){
                if(c.size <= self.size){
                    self.size ++;
                    cells.splice(i, 1);
                }else{
                    started = false;
                    document.getElementById("score").innerHTML = (self.size - 20).toLocaleString();
                    if(self.size - 20 > highscore) {
                        highscore = self.size - 20;
                        localStorage.setItem("highscore", highscore);
                        document.getElementById("acheive").style.display = "block";
                    }
                    document.getElementById("page2").style.display = "block";
                    document.getElementById("game").style.display = "none";
                }
            }
        });
    };
    var p = new Player(20, 20);

    function draw(){
        if(started){
            cursor("none");
            // weird why this doesn't work on chrome
            background("#111");
            fill("#111");
            rect(0, 0, windowWidth, windowHeight);
            max = p.size+40;
            if(frameCount % 10 == 0){
                cells.push(new Cell(random([0, windowWidth]), random([0, windowHeight]), round(random(10, max)), random(colors)));
            }
            noStroke();
            p.x = mouseX;
            p.y = mouseY;
            p.draw();
            cells.forEach(function(c, i){
                c.draw();
                if(c.x <= -max || c.x >= windowWidth+max || c.y <= -max || c.y >= windowHeight+max){
                    cells.splice(i, 1);
                }
            });
        }
    }

    function windowResized() {
        resizeCanvas(windowWidth, windowHeight);
    }

    document.getElementById("play").addEventListener("click", function(){
        document.getElementById("page1").style.display = "none";
        document.getElementById("game").style.display = "block";
        started = true;
    });

    document.getElementById("restart").addEventListener("click", function(){
        location.reload();
    });
</script>
