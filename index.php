<style>
    * {
        margin: 0 auto;
    }

    .active {
        background-color: rgb(250, 50, 80) !important;
    }

    .btn-box {
        width: 80%;
        min-height: 50px;
        overflow: hidden;
        margin: 15px 0 15px 15px;
    }

    .btn-box .filtr-bar-btn {
        padding: 15px;
        background-color: #fff;
        float: left;
        margin-right: 15px;
        border: 1px solid lightgray;
        cursor: pointer;
    }

    #form-container {
        width: calc(100% - 30px);
        padding: 15px;
        min-height: 600px;
        overflow: hidden;
        border: 1px solid red;
    }
</style>

<section>

    <div class="btn-box">
        <h3>Wybierz formularz</h3>
        <p class="filtr-bar-btn" data-status=1 onclick="paramLoad('status',1);filtrBtnCheck()">Formularz 1</p>
        <p class="filtr-bar-btn" data-status=2 onclick="paramLoad('status',2);filtrBtnCheck()">Formularz 2</p>
        <p class="filtr-bar-btn" data-status=3 onclick="paramLoad('status',3);filtrBtnCheck()">Formularz 3</p>
    </div>

    <div id="form_container">

    </div>

</section>

<script>
    function paramFetch(param) {
        var hash = location.href.split("?");
        var items = hash[1].split('&');
        for (var i = 0; i < items.length; i++) {
            var part = items[i].split("=");
            if (part[0] == param) {
                return part[1];
            }
        }
    }

    function paramLoad(paramName, paramValue) {
        const url = new URL(window.location.href);
        url.searchParams.set(paramName, paramValue);
        window.history.replaceState(null, null, url);
    }

    function dataLoad(elementId, filePath) {
        var hash = location.href.split("?");
        let xhttp;
        let path;
        let element = document.getElementById(elementId);
        let file = filePath;
        if (file) {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        element.innerHTML = this.responseText;
                    }
                    if (this.status == 400) {
                        element.innerHTML = "Error";
                    }
                }
            };

            path = `${file}?${hash[1]}`;

            xhttp.open("GET", path, true);
            xhttp.send();
            return;
        }

    }

    function filtrBtnCheck() {
        var btn = document.getElementsByClassName("filtr-bar-btn");
        for (let i = 0; i < btn.length; i++) {
            if (paramFetch("status") == btn[i].dataset.status) {
                btn[i].classList.add("active");
                dataLoad("form_container", 'formularz.php');
            } else {
                btn[i].classList.remove("active");
            }
        }
    }
</script>