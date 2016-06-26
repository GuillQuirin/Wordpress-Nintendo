<?php 
//Chargement du HEADER
get_header();

//echo '<img src="/wp-content/themes/esgi/img/404.png">';
?>
<style>

@import url(http://fonts.googleapis.com/css?family=Press+Start+2P);


/*---------- Main ---------- */
img {
    -webkit-user-drag: none;
    -moz-user-drag:none;
}

label {
    position: relative;
    font-family: 'Press Start 2P', cursive;
    text-transform: uppercase;
    font-size:4em;
    color:white;
    top:420px;
    left:115px;
    text-shadow:0px 4px 5px rgba(0,0,0,0.75), 0px 0px 2px rgba(0,0,0,1);
    opacity:0;
    
    -webkit-animation:fadeInTranslateY 0.6s linear;
    -webkit-animation-delay: 1.3s;
    -webkit-animation-fill-mode: forwards;
    
    -moz-animation:fadeInTranslateY 0.6s linear;
    -moz-animation-delay: 1.3s;
    -moz-animation-fill-mode: forwards;
}

.content {
    color:white;
    padding-bottom:60px;
    padding-top:10px;
}

.centeredContent {
    width:1054px;
    height:auto;
    margin-left:auto;
    margin-right:auto;
}


/*---------- Animation ----------*/
@-webkit-keyframes fadeInTranslateY {
    0%{ opacity:0;-webkit-transform: translateY(15px);}
    100%{ opacity:1;-webkit-transform: translateY(0px);}
}

@-moz-keyframes fadeInTranslateY {
    0%{ opacity:0;-moz-transform: translateY(15px);}
    100%{ opacity:1;-moz-transform: translateY(0px);}
}

@-webkit-keyframes linkAnimation {
    0%{ background-position: -720px 0px;}
    7%{ background-position: -1440px 0px;}
    14%{ background-position: -960px 0px;}
    21%{ background-position: -1200px 0px;}
    28%{ background-position: -720px 0px;}
    35%{ background-position: -1440px 0px;}
    42%{ background-position: -960px 0px;}
    49%{ background-position: -1200px 0px;}
    56%{ background-position: -720px 0px;}
    63%{ background-position: -1440px 0px;}
    70%{ background-position: -960px 0px;}
    77%{ background-position: -1200px 0px;}
    84%{ background-position: 0px 0px;}
    91%{ background-position: -240px 0px;}
    100%{ background-position: -480px 0px;}
}

@-moz-keyframes linkAnimation {
    0%{ background-position: -720px 0px;}
    7%{ background-position: -1440px 0px;}
    14%{ background-position: -960px 0px;}
    21%{ background-position: -1200px 0px;}
    28%{ background-position: -720px 0px;}
    35%{ background-position: -1440px 0px;}
    42%{ background-position: -960px 0px;}
    49%{ background-position: -1200px 0px;}
    56%{ background-position: -720px 0px;}
    63%{ background-position: -1440px 0px;}
    70%{ background-position: -960px 0px;}
    77%{ background-position: -1200px 0px;}
    84%{ background-position: 0px 0px;}
    91%{ background-position: -240px 0px;}
    100%{ background-position: -480px 0px;}
}

.link {
    position:relative;
    top:260px;
    width:240px;
    height:300px;
    margin-left:auto;
    margin-right:auto;
    background:url('http://www.joeybergeron.com/_/404/img/linkFrames.png')0 0;
    
    -webkit-animation: linkAnimation 1.3s linear;
    -webkit-animation-fill-mode: forwards;
    -webkit-animation-timing-function:step-start;
    
    -moz-animation: linkAnimation 1.3s linear;
    -moz-animation-fill-mode: forwards;
    -moz-animation-timing-function:step-start;
}

.map {
    width:800px;
    height:800px;
    margin-left:auto;
    margin-right:auto;
    background:url('http://www.joeybergeron.com/_/404/img/Hyrule.jpg');
}
</style>

    <div class="centeredContent">
        <div class="map">
            <div class="link"></div>
            <label>Dead Link</label>
        </div>
    </div>
<?php
//CHARGEMENT DU FOOTER
get_footer();