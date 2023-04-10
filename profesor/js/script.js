let editor;
var inputs = $("#input");
var myData;
var language;
window.onload = function () {
    language = 'php';
    var div = document.getElementById("dom-target");
    myData = div.textContent;

    editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
        mode: "xml",
        theme: 'dracula',
        lineNumbers: true,
        autoCloseTags: true
    });
    editor.setSize("600", "600");
}

function onChangeLanguage() {
    var x = document.getElementById("language").value;
    if (x === 'java') {
        language = 'java';
        editor.setOption("mode", "text/x-java");
    } else {
        language = 'php';
        editor.setOption("mode", "php");
    }

}

$("#run").click(function () {
    if (language === 'php') {
        $.ajax({
            url: "server.php",
            method: "POST",
            data: {
                code: editor.getValue(),
                input: myData
            },
            success: function (response) {
                const redLines = [];
                const greenLines = [];
                const xhr = new XMLHttpRequest();
                xhr.open('GET', './files/coverage/code.php.html');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        parser = new DOMParser();
                        var doc = parser.parseFromString(xhr.responseText, "text/html");
                        const collectionGreen = doc.getElementsByClassName("covered-by-large-tests popin");
                        const collectionRed = doc.getElementsByClassName("danger d-flex");
                        for (let i = 0; i < collectionGreen.length; i++) {
                            var subString = collectionGreen.item(i).innerHTML.split("<a")[1].split("</a>")[0].split(">")[1];
                            greenLines.push(parseInt(subString))
                        }
                        for (let i = 0; i < collectionRed.length; i++) {
                            var subString = collectionRed.item(i).innerHTML.split("<a")[1].split("</a>")[0].split(">")[1];
                            redLines.push(parseInt(subString))
                        }
                        for (let i = 0; i < redLines.length; i++) {
                            range = { start: { line: redLines[i] - 1, ch: 0 }, end: { line: redLines[i], ch: 0 }, style: "background-color: #ea4c3f;" },
                                editor.markText(range.start, range.end, { css: range.style });
                        }
                        for (let i = 0; i < greenLines.length; i++) {
                            range = { start: { line: greenLines[i] - 1, ch: 0 }, end: { line: greenLines[i], ch: 0 }, style: "background-color: green;" },
                                editor.markText(range.start, range.end, { css: range.style });
                        }
                    } else {
                        console.error('Error loading file: ' + xhr.statusText);
                    }
                };
                xhr.onerror = function () {
                    console.error('Network error while loading file');
                };
                xhr.send();

                $(".code_output").text(response);
            },
        })
    } else {
        $.ajax({
            url: "server_java.php",
            method: "POST",
            data: {
                code: editor.getValue(),
                input: myData
            },
            success: function (response) {
                const redLines = []
                const greenLines = []
                const xhr1 = new XMLHttpRequest();
                console.log(editor.getValue());

                xhr1.open('GET', './files/java/reports/default/MiClase.java.html');
                xhr1.onload = function () {
                        if (xhr1.status === 200) {
                            console.log("hombre que pasho");
                        parser = new DOMParser();
                        var doc = parser.parseFromString(xhr1.responseText, "text/html");
                        const collectionGreen = doc.getElementsByClassName("fc");
                        const collectionRed = doc.getElementsByClassName("nc");
                        for (let i = 0; i < collectionGreen.length; i++) {
                            greenLines.push(parseInt(collectionGreen[i].id.split("L")[1]))
                        }
                        for (let i = 0; i < collectionRed.length; i++) {
                            redLines.push(parseInt(collectionRed[i].id.split("L")[1]))
                        }
                        for (let i = 0; i < redLines.length; i++) {
                            range = { start: { line: redLines[i] - 1, ch: 0 }, end: { line: redLines[i], ch: 0 }, style: "background-color: #ea4c3f;" },
                                editor.markText(range.start, range.end, { css: range.style });
                        }
                        for (let i = 0; i < greenLines.length; i++) {
                            range = { start: { line: greenLines[i] - 1, ch: 0 }, end: { line: greenLines[i], ch: 0 }, style: "background-color: green;" },
                                editor.markText(range.start, range.end, { css: range.style });
                        }
                    } else {
                        console.error('Error loading file: ' + xhr1.statusText);
                    }
                };
                xhr1.onerror = function () {
                    console.error('Network error while loading file');
                };
                xhr1.send();

                //Now we get information about tests
                const xhr2 = new XMLHttpRequest();
                xhr2.open('GET', './files/java/reports/TEST-junit-jupiter.xml');
                xhr2.onload = function () {
                    if (xhr2.status === 200) {
                        parser = new DOMParser();
                        xmlDoc = parser.parseFromString(xhr2.responseText, "text/xml");
                        const collectionGreen = xmlDoc.getElementsByTagName("testcase");
                        const mensajesOutput = [];
                        for (let i = 0; i < collectionGreen.length; i++) {
                            const testcase = collectionGreen[i].getAttribute("name");
                            const failure = collectionGreen[i].getElementsByTagName("failure")[0];
                            if (failure) {
                                const msg = failure.getAttribute("message");
                                mensajesOutput.push(`${testcase + ' ' + msg}`);
                            } else{
                                mensajesOutput.push(`${testcase + ' ' + 'OK'}`);
                            }
                            console.log(mensajesOutput);
                        }

                        const stringList = document.getElementById('string-list');
                        stringList.innerHTML = '';
                        mensajesOutput.forEach((str) => {
                            const li = document.createElement('li');
                            li.textContent = str;
                            stringList.appendChild(li);
                        });
                    } else {
                        console.error('Error loading file: ' + xhr2.statusText);
                    }
                };
                xhr2.onerror = function () {
                    console.error('Network error while loading file');
                };
                xhr2.send();

                // $(".code_output").text(response);

            },
        })
    }

})