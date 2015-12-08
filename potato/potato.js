/* CSE3026 : Web Application Development
 * Problem 10 - Mr. Potato Head
 */

"use strict";
document.observe("dom:loaded", function() {    
    // set up listeners on all checkboxes
    var checkboxes = $$("#controls input");
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
        checkboxes[i].observe("change", toggleAccessory);
    }
    
    /* Make the element with "potato" as id to be Droppables 
     * Also call 'partDrop' function when 'onDrop' event of the Droppables occur  
     */
    Droppables.add($("potato"), {onDrop: partDrop});
    /* Find and store all the images that is located inside a div with "parts" as id
     * Use Prototype's $$ function  
     */
    var partImgs = $$("#parts > img");
    /* Specify each image stored in the 'partImgs' variable to be Draggable
     * Also set option to the Draggable so that it reverts back to its original position after the drag
     */
    for (var i=0; i<partImgs.length; i++) {
        new Draggable(partImgs[i], {revert: true});
    }
});


function partDrop(drag, drop, event) {
	event.returnValue = false;
    if(drop.id != drag.parentNode.id && drop.id == "potato") {
        //shrink the dragged body part
        drag.shrink({duration: 0.1});
        //grow the hidden body part (that corresponds to the dragged body part) inside the body box 
        var partid = "potato_" + drag.getAttribute("alt");
        $(partid).grow();
        //check the corresonding checkbox for the body part dragged 
        var checkboxid = drag.getAttribute("alt") + "_checkbox";
        $(checkboxid).checked = true;
    }
}


// called when any checkbox is checked/unchecked
function toggleAccessory() {    
    /* For the checkbox that fired the event, manipulate the string of the checkbox's id 
     * and store the names of the body part (arms, ears, eyes, nose, mouth, ...) into 'part' variable
     */
    var part = this.id.split("_")[0];
    //When the checkbox that fired the event is checked
    if (this.checked) {
    	//make the corresponding hidden body part inside the body box to appear
        $("potato_"+part).appear();
        //make the corresponding body part at the bottom of the page to fade 
        $(part).fade();
    //When the checkbox that fired the event is unchecked
    } else {
    	//make the corresponding hidden body part inside the body box to fade
    	$("potato_"+part).fade();
    	//make the corresponding body part at the bottom of the page to appear 
        $(part).appear();
    }
}