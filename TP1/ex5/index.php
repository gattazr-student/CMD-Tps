<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>CMD - TP1 : Exercice 5</title>
        <style>
        .invisible{display:none;}
        </style>
    </head>
    <body>
        <h1>CMD - TP1 : Exercice 5</h1>
        <div id='aide'>
            <input type='button' value='Show Help' id='t-help'/>
            <div id='p-help' class='invisible'>
                <img src="https://i.imgflip.com/qxwan.jpg" alt='doge'/>
            </div>
        </div>
        <a href='..'>Retour</a>
        <script>
        function aideClicked(){
            divHelp = document.getElementById('p-help');
            divTitle = document.getElementById('t-help');
            if(divHelp.style.display == 'none'){
                divTitle.value = 'Hide Help';
            }
            else {
                divTitle.value = 'Show Help';
            }
            divHelp.classList.toggle("invisible");
        }
        document.getElementById('t-help').addEventListener("click", aideClicked, false);
        </script>
    </body>
</html>
