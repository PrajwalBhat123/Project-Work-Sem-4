let count = 0;
let g1 = 0;
let gamecount = 5;
let user = 1;
let usergoals = Array(5);
let cpugoals = Array(5);

console.log(count);

function goalkeeper() {
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
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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

}

function LeftTop(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}
function RightTop(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}
function CenterTop(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}
function LeftMiddle(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}

function RightMiddle(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}

function CenterMiddle(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}

function LeftBottom(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}

function RightBottom(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}
function CenterBottom(){
    if(gamecount == 0){
        gamecount = 5;
        alert('Defend your score');
    }
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
    gamecount--;
}

function test(test){
    
    console.log(test);
}