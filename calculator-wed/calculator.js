"use strict"
window.onload = function () {
    var stack = [];
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;
            if(value=="AC") {
                displayVal = "0";
                stack = [];
                document.getElementById('expression').innerHTML = "0";
            } else if(/^\d$/.test(value)) {
                if(displayVal.charAt(0)=="0") {
                    displayVal = value;
                } else {
                    displayVal += value;
                }
            } else if(value==".") {
                if(!(/.\.?./.test(displayVal))) {
                    displayVal += value;
                }
            } else {
                stack.push(displayVal);
                var displayExp;
                displayExp = displayVal + value;
                if(document.getElementById('expression').innerHTML.charAt(0)=="0") {
                    document.getElementById('expression').innerHTML = displayExp;                    
                } else {
                    document.getElementById('expression').innerHTML += displayExp;    
                }
                displayVal = "0";
                if(/^[\/\*\^]&/.test(stack[stack.length-2])) {
                    highPriorityCalculator(stack, value);
                } else if(value=="!") {
                    stack.push(parseFloat(factorial(stack.pop())));
                } else if(value=="=") {
                    displayVal = calculator(stack);
                } else {
                    stack.push(parseFloat(displayVal));
                    stack.push(value);
                }
            }
            document.getElementById('result').innerHTML = displayVal;
        };
    }
};
function factorial (x) {
    if(x==1) {
        return 1;
    } else {
        return x*factorial(x-1);
    }
}
function highPriorityCalculator(s, val) {
    var opernand2 = s.pop();
    var operator = s.pop();
    var opernand1 = s.pop();

    var result;
    if(operator=="*") {
        result = opernand1 * opernand2;
    } else if(operator=="/") {
        result = opernand1 / opernand2;
    } else if(operator=="^") {
        result = Math.pow(opernand1, opernand2);
    }
    s.push(parseFloat(result));
    s.push(val);
}
function calculator(s) {
    var result = 0;
    var operator = "+";
    for (var i=0; i< s.length; i++) {
        if(i%2==0) { //at even times
            if(operator = "+") {
                result = parseFloat(s.pop()) + result;
            } else if(operator = "-") {
                result = parseFloat(s.pop()) - result;
            }
        } else { //at odd times
            operator = s.pop();
        }
    }
    return result;
}
