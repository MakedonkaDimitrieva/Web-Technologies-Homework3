
function search() {
    var input = document.getElementById("search");
    var toSearch = input.value.toUpperCase();
    var table = document.getElementById("table");
    var rows = table.getElementsByTagName("tr");
    for(var j=1;j<rows.length;j++) {
        var td1 = rows[j].getElementsByTagName("td")[1];
        var td2 = rows[j].getElementsByTagName("td")[2];
        if(td1 || td2) {
            if((td1.innerHTML.toUpperCase().indexOf(toSearch) > -1) || (td2.innerHTML.toUpperCase().indexOf(toSearch) > -1)) {
                rows[j].style.display = "";
            } else {
                rows[j].style.display = "none";
            }
        }
    }
}

function increasing() {
    var table = document.getElementById("table");
    var flag = true;
    var move = false;
    while(flag) {
        flag = false;
        var rows = table.getElementsByTagName("tr");
        for(var j=1;j<rows.length-1;j++) {
            move = false;
            var first = rows[j].getElementsByTagName("td")[6];
            var second = rows[j+1].getElementsByTagName("td")[6];
            console.log(first, second);
            if(first.innerHTML > second.innerHTML) {
                move = true;
                break;
            }
        }
        if(move) {
            rows[j].parentNode.insertBefore(rows[j+1], rows[j]);
            flag = true;
        }
    }
}

function decreasing() {
    var table = document.getElementById("table");
    var flag = true;
    var move = false;
    while(flag) {
        flag = false;
        var rows = table.getElementsByTagName("tr");
        for(var j=1;j<rows.length-1;j++) {
            move = false;
            var first = rows[j].getElementsByTagName("td")[6];
            var second = rows[j+1].getElementsByTagName("td")[6];
            console.log(first, second);
            if(first.innerHTML < second.innerHTML) {
                move = true;
                break;
            }
        }
        if(move) {
            rows[j].parentNode.insertBefore(rows[j+1], rows[j]);
            flag = true;
        }
    }
}