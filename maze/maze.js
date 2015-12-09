/* CSE3026 : Web Application Development
 * Lab 8 - Maze
 * 
 */
"use strict";

var loser = null;  // whether the user has hit a wall

window.onload = function() {
	$("start").onclick = startClick;
}

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
	var array = $$("div.boundary:not(.example)");
	for(var i=0; i<array.length; i++) {
		array[i].setStyle({ backgroundColor: "#FFAAAA"});
		array[i].addClassName("youlose");
	}
	$("status").innerHTML = "You Lose.. :(";
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
	var boundaries = $$("div.boundary");
	for (var i=0; i<boundaries.length; i++)
		boundaries[i].onmouseover = overBoundary;
	var outside = $$("body > :not(#maze)");
	for (var i=0; i<outside.length; i++)
		outside[i].onmouseover = overBoundary;
	$("end").onmouseover = overEnd;

	var array = $$("div.boundary:not(.example)");
	for(var i=0; i<array.length; i++) {
		array[i].setStyle({backgroundColor: "#EEEEEE" });
		array[i].removeClassName("youlose");
	}
	$("status").innerHTML = "New Start!!";
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
	if(!($$("div.boundary")[0].hasClassName("youlose"))) {
		$("status").innerHTML = "You Win!! :)";
		var array = $$("div.boundary:not(.example)");
		for(var i=0; i<array.length; i++) {
			array[i].setStyle({backgroundColor: "#AAAAFF" });
			array[i].removeClassName("youlose");
		}
	}
	
	var boundaries = $$("div.boundary");
	for (var i=0; i<boundaries.length; i++)
		boundaries[i].onmouseover = null;
	var outside = $$("body > :not(#maze)");
	for (var i=0; i<outside.length; i++)
		outside[i].onmouseover = null;
	$("end").onmouseover = null;
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {

}


