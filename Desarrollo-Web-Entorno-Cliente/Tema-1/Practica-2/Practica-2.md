# Práctica 2 - Ejercicios 1.2

Capacidades y mecanismos de ejecución de código de los navegadores Web.

## Ejercicio 1

Añade un segundo botón al ejemplo de los apuntes que, además de cambiar el párrafo, cambie también el texto del `<h1>` con `getElementById()` e `innerHTML`. El primer botón se mantiene tal cual.

![Código del ejercicio 1](capturas/ej1.png)

Al pulsar el botón del título, el encabezado cambia y el párrafo sigue como estaba:

![Resultado del ejercicio 1](capturas/ej1-resultado.png)

## Ejercicio 2

Página que captura el evento clic de un botón y emite una traza informativa por `console.log()` en las herramientas de desarrollo.

![Código del ejercicio 2](capturas/ej2.png)

Salida por consola al pulsar el botón:

![Resultado del ejercicio 2](capturas/ej2-resultado.png)

## Ejercicio 3

Modifica el ejercicio anterior sustituyendo la escritura en el párrafo por un cuadro de aviso emergente con `alert()`. El botón que escribía en el párrafo se deja como estaba.

![Código del ejercicio 3](capturas/ej3.png)

Salida por consola:

![Resultado del ejercicio 3](capturas/ej3-resultado.png)

## Ejercicio 4

Web con tres botones (Ruso, Español, Inglés) que cambian el texto de un `<p>` y le aplican un color de fuente distinto con `.style.color`.

![Código del ejercicio 4](capturas/ej4.png)

Salida por consola tras pulsar «Ruso»:

![Resultado del ejercicio 4](capturas/ej4-resultado.png)

## Ejercicio 5

Adapta el ejercicio anterior para que los saludos se impriman únicamente por consola, sin escribir en el párrafo.

![Código del ejercicio 5](capturas/ej5.png)

Salida por consola:

![Resultado del ejercicio 5](capturas/ej5-resultado.png)

## Ejercicio 6

Transforma el código para generar los textos directamente en el flujo de la página con `document.write()`.

![Código del ejercicio 6](capturas/ej6.png)

Salida por consola tras pulsar «Español»:

![Resultado del ejercicio 6](capturas/ej6-resultado.png)

Como advierte la teoría, `document.write()` ejecutado **después** de la carga borra el documento entero y deja solo lo escrito en esa llamada: por eso en la captura únicamente aparece el saludo y han desaparecido el título y los botones.

## Ejercicio 7

Interfaz con un `<h1>`, un `<p id="estado">Sistema en espera</p>` y tres botones: **Consola** (traza con la hora del sistema), **Estilo** (fondo verde y texto «Sistema Activo») y **Alerta** (aviso modal de proceso concluido).

![Código del ejercicio 7](capturas/ej7.png)

Salida por consola del botón 1:

![Consola del ejercicio 7](capturas/ej7-consola.png)

Salida por consola del botón 2:

![Resultado del ejercicio 7](capturas/ej7-resultado.png)

Salida por consola del botón 3:

![Alerta del ejercicio 7](capturas/ej7-alerta.png)

## Ejercicio 8

Test interactivo de siete preguntas con botones «Verdadero» y «Falso». Al hacer clic, el script evalúa el acierto y modifica `.style.color` a `green` si acierta o a `red` si falla.

![Código del ejercicio 8](capturas/ej8.png)

Acierto (se responde «Falso» a la primera pregunta):

![Acierto del ejercicio 8](capturas/ej8-acierto.png)

Fallo (se responde «Verdadero» a la misma pregunta):

![Fallo del ejercicio 8](capturas/ej8-fallo.png)

## Ejercicio 9

Secuencia cíclica de cuatro imágenes fotograma a fotograma. Al hacer clic sobre la imagen, el script comprueba cuál se está visualizando y reasigna el atributo `.src` con la siguiente, volviendo a la primera al llegar al final.

![Código del ejercicio 9](capturas/ej9.png)

Las cuatro imágenes de la secuencia son `foto1.png`, `foto2.png`, `foto3.png` y `foto4.png`.

Salida por consola tras dos clics:

![Resultado del ejercicio 9](capturas/ej9-resultado.png)