let count = 0;
let g1 = 0;
let gamecount = 5;
let user = 1;
let usergoals = Array(5);
let cpugoals = Array(5);

let sh1 = document.getElementById('shooter1');
let sh2 = document.getElementById('shooter2');
let sh3 = document.getElementById('shooter3');
console.log(count);

function selectshooter1(){
    sh1.style.backgroundColor = "blue";
    sh1.style.transition = "1s";
    setInterval(function(){
        sh1.style.backgroundColor = "red";
    },2000);
    sh2.style.transition = 0;
    sh3.style.transition = 0;
}

function selectshooter2(){
    sh2.style.backgroundColor = "blue";
    sh2.style.transition = "1s";
    setInterval(function(){
        sh2.style.backgroundColor = "red";
    },2000);
    sh1.style.transition = 0;
    sh3.style.transition = 0;
}

function selectshooter3(){
    sh3.style.backgroundColor = "blue";
    sh3.style.transition = "1s";
    setInterval(function(){
        sh3.style.backgroundColor = "red";
    },2000);
    sh2.style.transition = 0;
    sh1.style.transition = 0;
}

function keepCount(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
        if(confirm('Defend your score')){
            window.location.href = 'goaliegamepage.php';
        }else{
            window.location.href = 'goaliegamepage.php';
        }
    }
}

function goalkeeper() {
    gamecount--;
    let b=document.getElementById('b2');
    let g=Math.floor(Math.random()*7);
    g1=g;
    if(g==1)
        b.style.animation="gl0 1s";
    else if(g==2)
        b.style.animation="gl1 1s";
    else if(g==3)
        b.style.animation="gl2 1s";
    else if(g==4)
        b.style.animation="gc1 1s";
    else if(g==5)
        b.style.animation="gr0 1s";
    else if(g==6)
        b.style.animation="gr1 1s";
    else if(g==7)
        b.style.animation="gr2 1s";
}

function goal() 
{
    keepCount();
    document.getElementById('GoalDone1').innerHTML = ":((((((";
    document.getElementById('GoalDone2').innerHTML = ":((((((";
    let o=Math.floor(Math.random()*5);
    if(o==1){
        document.getElementbyId('b1').style.animation="Outside1 1s";
    }
    else if(o==2)
        document.getElementById('b1').style.animation="Outside2 1s";
    else if(o==3)
        document.getElementById('b1').style.animation="Outside3 1s";
    else if(o==4)
        document.getElementById('b1').style.animation="Outside4 1s";
    else if(o==5)
        document.getElementById('b1').style.animation="Outside5 1s";
    gamecount--;
}

function LeftTop(){
    keepCount();

    document.getElementById('b1').style.animation="left0 1s";
    goalkeeper();
    if(g1!=1)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}
function RightTop(){
    keepCount();
    
    document.getElementById('b1').style.animation="right0 1s";
    goalkeeper();
    if(g1!=5)
    {
        usergoals.push(1);    count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}
function CenterTop(){
    keepCount();

    document.getElementById('b1').style.animation="center0 1s";
    goalkeeper();
    if(g1!=4)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}
function LeftMiddle(){
    keepCount();

    document.getElementById('b1').style.animation="left2 1s";
    goalkeeper();
    if(g1!=2)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}

function RightMiddle(){
    keepCount();
    
    document.getElementById('b1').style.animation="right2 1s";
    goalkeeper();
    if(g1!=6)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}

function CenterMiddle(){
    keepCount();
    
    document.getElementById('b1').style.animation="center2 1s";
    goalkeeper();
    if(g1!=4)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}

function LeftBottom(){
    keepCount();

    document.getElementById('b1').style.animation="left1 1s";
    goalkeeper();
    if(g1!=3)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}

function RightBottom(){
    keepCount();   
    
    document.getElementById('b1').style.animation="right1 1s";
    goalkeeper();
    if(g1!=7)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}
function CenterBottom(){
    keepCount();
    
    document.getElementById('b1').style.animation="center1 1s";
    goalkeeper();
    if(g1!=4)
    {
        usergoals.push(1);
        count++;
        document.getElementById('Score').innerHTML=count;
        document.getElementById('GoalDone1').innerHTML = "GOAL!!!!!";
        document.getElementById('GoalDone2').innerHTML = "GOAL!!!!!";
    }
    else{
        usergoals.push(0);
        document.getElementById('GoalDone1').innerHTML = "Saved!!!!!";
        document.getElementById('GoalDone2').innerHTML = "Saved!!!!!";
    }
}

function test(test){
    
    console.log(test);
}