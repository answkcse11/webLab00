"use strict"
var interval = 3000;
var numberOfBlocks = 9;
var numberOfTarget = 3;
var targetBlocks = [];
var selectedBlocks = [];
var timer;

document.observe('dom:loaded', function(){
	$("start").observe("click", stopToStart);
	$("stop").observe("click", stopGame);
});

function stopToStart(){
    stopGame();
    startToSetTarget();
}

function stopGame(){
	$("state").innerHTML = "Stop";
	$("answer").innerHTML = "0/0";
	targetBlocks = [];
	selectedBlocks = [];
	var i;
	var targets = $$("div.target");
	var selecteds = $$("div.selected");
	for(i=0; i<targets.length; i++)
		targets[i].removeClassName("target");
	for(i=0; i<selecteds.length; i++)
		selecteds[i].removeClassName("selected");
	clearTimeout(timer);
	timer = null;
}

function startToSetTarget(){
	$("state").innerHTML = "Ready!";
	targetBlocks = [];
	selectedBlocks = [];
	timer = null;
	var i, count=0;
	while(true) {
		if(count>=numberOfTarget) break;
		targetBlocks[count] = (Math.floor(Math.random()*10))%9;
		for(i=0; i<count; i++) {
			if(targetBlocks[i]==targetBlocks[count])
				break;
		}
		if(i>=count) count++;
	}
	setTargetToShow();
}

function setTargetToShow(){
	$("state").innerHTML = "Memorize!";
	var i;
	for(i=0; i<3; i++) {
		($$("div.block")[(targetBlocks[i])]).addClassName("target");
	}
	timer = setTimeout(showToSelect, interval);
}

function showToSelect(){
	$("state").innerHTML = "Select!";
	var i;
	for(i=0; i<targetBlocks.length; i++)
		($$("div.block")[(targetBlocks[i])]).removeClassName("target");
	var i, count=0;
	for (i=0; i<numberOfBlocks; i++) {
		$$("div.block")[i].observe("click", function(event){
			if(this.hasClassName("selected") || count>=numberOfTarget)
				return;
			else {
				this.addClassName("selected");
				selectedBlocks.push(parseInt(this.getAttribute("data-index")));
				count+=1;
			}
		});
	}
	timer = setTimeout(selectToResult, interval);
}

function selectToResult(){
	$("state").innerHTML = "Checking!";
	var i, anscount=0, totalcount;
	for(i=0; i<selectedBlocks.length; i++)
		($$("div.block")[(selectedBlocks[i])]).removeClassName("selected");
	for(i=0; i<3; i++) {
		if(selectedBlocks.indexOf(targetBlocks[i])!=-1)
			anscount++;
	}
	var anstotal = $("answer").firstChild();
	timer = setTimeout(startToSetTarget, interval);
}


