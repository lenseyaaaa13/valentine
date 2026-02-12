<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Valentine 💜</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Great+Vibes&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#6a0dad,#8a2be2,#b266ff);
    padding:20px;
    overflow:hidden;
}

/* Flying hearts */
.heart{
    position:fixed;
    bottom:-50px;
    color:#ffffffaa;
    font-size:20px;
    animation:floatUp linear forwards;
    pointer-events:none;
}

@keyframes floatUp{
    from{
        transform:translateY(0) scale(0.5);
        opacity:0;
    }
    20%{
        opacity:1;
    }
    to{
        transform:translateY(-120vh) scale(1.4);
        opacity:0;
    }
}

.card{
    background:white;
    width:100%;
    max-width:500px;
    border-radius:20px;
    padding:30px;
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
    text-align:center;
    position:relative;
    z-index:2;
}

.title{
    font-family:'Great Vibes',cursive;
    font-size:42px;
    color:#8a2be2;
    margin-bottom:10px;
}

.text{
    font-size:20px;
    margin-bottom:25px;
}

.buttons{
    display:flex;
    flex-direction:column;
    gap:15px;
    align-items:center;
}

.primary-btn{
    background:#8a2be2;
    color:white;
    border:none;
    padding:14px 30px;
    border-radius:30px;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 6px 20px rgba(138,43,226,0.4);
}

#noBtn{
    background:#f1f1f1;
    color:#666;
    border:2px solid #ddd;
    padding:12px 25px;
    border-radius:30px;
    font-size:16px;
    cursor:pointer;
}

input{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:2px solid #ddd;
    font-size:16px;
    margin-bottom:15px;
    text-align:center;
}

.hidden{
    display:none;
}

.code{
    font-size:28px;
    color:#8a2be2;
    margin-top:15px;
    font-weight:bold;
}

.note{
    margin-top:10px;
    font-size:16px;
    color:#555;
}

.progress{
    margin-bottom:10px;
    color:#888;
}

</style>
</head>
<body>

<div class="card">

<!-- Valentine -->
<div id="valentine">

<div class="title">Hi Wabby 💜</div>

<div class="text" id="loveQuestion">
Will you be my Valentine?
</div>

<div class="buttons">
<button id="yesBtn" class="primary-btn">Yes 💜</button>
<button id="noBtn">No 😢</button>
</div>

</div>

<!-- Quiz -->
<div id="quiz" class="hidden">

<div class="title">Questions Timeeee💜</div>

<div class="progress" id="progress"></div>

<div class="text" id="quizQuestion"></div>

<input id="quizInput">

<button id="submitBtn" class="primary-btn">Submit 💜</button>

<div class="text hidden" id="scoreText"></div>

<div class="code hidden" id="codeText"></div>

<div class="note hidden" id="noteText">
Message your wabby the code for a surprise gift 💜
</div>

<button id="retryBtn" class="primary-btn hidden">Retry 💜</button>

</div>

</div>

<script>

/* Flying hearts */
function createHeart(){

    const heart=document.createElement("div");

    heart.className="heart";
    heart.innerHTML="💜";

    heart.style.left=Math.random()*100+"vw";
    heart.style.fontSize=(Math.random()*20+15)+"px";
    heart.style.animationDuration=(Math.random()*4+4)+"s";

    document.body.appendChild(heart);

    setTimeout(()=>heart.remove(),8000);

}

setInterval(createHeart,400);


/* Valentine logic */

const yesBtn=document.getElementById("yesBtn");
const noBtn=document.getElementById("noBtn");
const loveQuestion=document.getElementById("loveQuestion");

let yesSize=1;
let noIndex=0;

const noMessages=[
"Are you sure? 🥺",
"Really sure? 😢",
"Please think again... 💔",
"I'll be sad... 😭",
"Last chance... 🥺"
];

noBtn.onclick=function(){

    if(noIndex<noMessages.length){
        loveQuestion.innerText=noMessages[noIndex];
        noIndex++;
    }

    yesSize+=0.5;

    yesBtn.style.transform=`scale(${yesSize})`;

};

yesBtn.onclick=function(){

    document.getElementById("valentine").classList.add("hidden");
    document.getElementById("quiz").classList.remove("hidden");

    resetQuiz();
    loadQuestion();

};


/* Quiz logic */

const questions=[

{question:"Where did we meet?",answers:["roblox"]},
{question:"What experience did we meet?",answers:["elyu"]},
{question:"When did we meet?",answers:["2025-10-03"],type:"date"},
{question:"Where did we first chat after roblox?",answers:["reddit"]},
{question:"What is my middle name?",answers:["granados"]}

];

const finalCode="W46bY";

let current=0;
let score=0;

const quizQuestion=document.getElementById("quizQuestion");
const quizInput=document.getElementById("quizInput");
const progress=document.getElementById("progress");
const scoreText=document.getElementById("scoreText");
const codeText=document.getElementById("codeText");
const retryBtn=document.getElementById("retryBtn");
const noteText=document.getElementById("noteText");
const submitBtn=document.getElementById("submitBtn");


function normalize(text){

    return text.toLowerCase().trim().replace(/[^\w]/g,"");

}


function resetQuiz(){

    current=0;
    score=0;

    quizQuestion.style.display="block";
    quizInput.style.display="block";
    progress.style.display="block";
    submitBtn.style.display="inline-block";

    scoreText.style.display="none";
    codeText.style.display="none";
    noteText.style.display="none";
    retryBtn.style.display="none";

}


function loadQuestion(){

    let q=questions[current];

    quizQuestion.innerText=q.question;
    progress.innerText=`Question ${current+1} of ${questions.length}`;
    quizInput.value="";

    quizInput.type=q.type==="date"?"date":"text";

}


submitBtn.onclick=function(){

    let userAnswer=normalize(quizInput.value);

    if(userAnswer===""){
        alert("Answer first 💜");
        return;
    }

    let correct=questions[current].answers.some(
        ans=>normalize(ans)===userAnswer
    );

    if(correct) score++;

    current++;

    if(current<questions.length){

        loadQuestion();

    }else{

        showResult();

    }

};


function showResult(){

    quizQuestion.style.display="none";
    quizInput.style.display="none";
    progress.style.display="none";
    submitBtn.style.display="none";

    scoreText.style.display="block";
    scoreText.innerText=`Your score: ${score} / ${questions.length}`;

    codeText.style.display="block";

    if(score===questions.length){

        codeText.innerText=`Code: ${finalCode} 💜`;
        noteText.style.display="block";

    }else{

        codeText.innerText="Code locked 🔒 Try again!";
        retryBtn.style.display="inline-block"; /* FORCE SHOW */

    }

}


/* Retry always visible after fail */
retryBtn.onclick=function(){

    resetQuiz();
    loadQuestion();

};

</script>


</body>
</html>
