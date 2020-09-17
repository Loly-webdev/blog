/* ANIMATION TITLE */

function autoType(elementClass, typingSpeed) {
    let typed = $(elementClass);
    typed.css({
        "position": "relative",
        "display": "inline-block"
    });
    typed.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
    typed = typed.find(".text-js");
    const text = typed.text().trim().split('');
    const amntOfChars = text.length;
    let newString = "";
    typed.text("|");
    setTimeout(function () {
        typed.css("opacity", 1);
        typed.prev().removeAttr("style");
        typed.text("_");
        for (let i = 0; i < amntOfChars; i++) {
            (function (i, char) {
                setTimeout(function () {
                    newString += char;
                    typed.text(newString);
                }, i * typingSpeed);
            })(i + 1, text[i]);
        }
    }, 1500);
}

$(document).ready(function () {
    // Now to start autoTyping just call the autoType function with the
    // class of outer div
    // The second parameter is the speed between each letter is typed.
    autoType(".type-js", 200);
});
