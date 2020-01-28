var list = ["tetris"]; // Games

var numOfRows = list.length/5;

var divCounter = 0;

for (var i = 0; i < list.length; i++) {
    var box = document.createElement("div");
    var overlayDiv = document.createElement("div");
    var link = document.createElement('a');
    var image = document.createElement('img');

    link.href = list[i].replace(/ /g, '') + '.html';
    var imageLst = list[i].replace(/\s/g, "");
    image.setAttribute("src", "images/" + imageLst + ".jpg");
    image.alt = list[i];

    overlayDiv.setAttribute('class', "overlay");
    overlayDiv.innerHTML = list[i].toUpperCase();

    link.appendChild(image);
    link.appendChild(overlayDiv);

    box.setAttribute('class', 'box');
    box.setAttribute('style', "display:block");
    box.appendChild(link);

    if (i % 5 == 1) {
        divCounter++;
    }
    var div = divCounter.toString()
    document.getElementById(div).appendChild(box);
}