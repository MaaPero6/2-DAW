# Apuntes de HTML — DIWEB Tema 2

> Resumen original para estudio. Fuentes: curso HTML5 de Eniun (enlaces al final).

---

## 1. Estructura básica de un documento HTML

**Todo documento HTML** sigue esta estructura mínima:

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi página</title>
</head>
<body>
  <!-- Contenido visible -->
</body>
</html>
```

- **`<!DOCTYPE html>`** — Declara que el documento es HTML5.
- **`<html lang="es">`** — Raíz del documento; `lang` indica el idioma (ayuda a accesibilidad y SEO).
- **`<head>`** — Metainformación no visible: título, codificación, estilos, scripts.
- **`<body>`** — Todo lo que se ve en la página.

---

## 2. Elementos semánticos

**Semántico** = la etiqueta dice *qué es* el contenido, no solo cómo se ve. Ejemplo: `<header>` no es solo un contenedor, es "la cabecera de la página".

| Etiqueta | Para qué sirve |
|---|---|
| `<header>` | Cabecera de la página o de una sección |
| `<nav>` | Menú de navegación con enlaces |
| `<main>` | Contenido principal (solo uno por página) |
| `<section>` | Sección temática con su propio título |
| `<article>` | Contenido independiente y reutilizable (una noticia, un post) |
| `<aside>` | Contenido secundario (lateral, publicidad, enlaces relacionados) |
| `<footer>` | Pie de página o de una sección |

**Ventajas de usarlas:**
- **Accesibilidad**: los lectores de pantalla entienden la estructura.
- **SEO**: los buscadores valoran mejor el contenido.
- **Legibilidad**: el código se entiende mejor que con `<div>` por todas partes.

```html
<body>
  <header>
    <h1>Mi web</h1>
    <nav>
      <a href="index.html">Inicio</a>
      <a href="contacto.html">Contacto</a>
    </nav>
  </header>
  <main>
    <section>
      <h2>Noticias</h2>
      <article>
        <h3>Noticia 1</h3>
        <p>Texto de la noticia...</p>
      </article>
    </section>
    <aside>
      <p>Contenido lateral</p>
    </aside>
  </main>
  <footer>
    <p>&copy; 2026 Mi web</p>
  </footer>
</body>
```

---

## 3. Etiquetas de contenido

### 3.1. Contenedores

- **`<p>`** — Párrafo de texto.
- **`<div>`** — Contenedor genérico de bloque (sin significado; para agrupar y dar estilo con CSS).
- **`<hr>`** — Línea horizontal que separa contenido temáticamente.
- **`<pre>`** — Texto preformateado: respeta espacios y saltos de línea tal como se escriben.
- **`<blockquote>`** — Cita en bloque de otra fuente (se puede usar `cite` para la URL).
- **`<figure>` + `<figcaption>`** — Ilustración (imagen, gráfico...) con su pie de foto.

```html
<p>Esto es un párrafo.</p>
<hr>
<pre>
Línea 1
  Línea 2 con sangría
</pre>
<blockquote cite="https://ejemplo.com">
  Cita textual de otra fuente.
</blockquote>
<figure>
  <img src="logo.png" alt="Logotipo">
  <figcaption>Logotipo de la empresa</figcaption>
</figure>
```

### 3.2. `id` y `class`

- **`id`** — Identificador **único** en toda la página. Se usa para enlazar a una sección y para seleccionar el elemento en CSS/JS.
- **`class`** — Clase **repetible**: agrupa varios elementos que comparten estilo o comportamiento.

```html
<section id="noticias">...</section>
<p class="destacado">Texto</p>
<p class="destacado">Otro texto con el mismo estilo</p>
```

### 3.3. Etiquetas de texto

| Etiqueta | Significado |
|---|---|
| `<h1>` – `<h6>` | Títulos de nivel 1 a 6 (uno solo `<h1>` por página) |
| `<strong>` | Importancia fuerte (se muestra en negrita) |
| `<em>` | Énfasis (se muestra en cursiva) |
| `<mark>` | Texto resaltado (como con rotulador) |
| `<code>` | Fragmento de código |
| `<small>` | Texto secundario o letra pequeña |
| `<sub>` / `<sup>` | Subíndice / superíndice |
| `<br>` | Salto de línea (no usar para separar párrafos) |

---

## 4. Listas

- **`<ul>`** — Lista no ordenada (viñetas). Cada elemento va en `<li>`.
- **`<ol>`** — Lista ordenada (números). Atributo `type`: `1`, `a`, `A`, `i`, `I`.
- **`<dl>`** — Lista de definiciones: `<dt>` término, `<dd>` definición.

```html
<ul>
  <li>Pan</li>
  <li>Leche</li>
</ul>

<ol type="a">
  <li>Primero</li>
  <li>Segundo</li>
</ol>

<dl>
  <dt>HTML</dt>
  <dd>Lenguaje de marcado para páginas web.</dd>
</dl>
```

Las listas **se pueden anidar**: una `<ul>` dentro de un `<li>` de otra lista.

---

## 5. Enlaces

- **`<a>`** — Crea un hipervínculo. Atributo **`href`** = destino.

```html
<a href="https://www.ejemplo.com">Ir a ejemplo</a>
```

**Atributos útiles:**
- **`target="_blank"`** — Abre el enlace en una pestaña nueva.
- **`download`** — Descarga el recurso en lugar de abrirlo.
- **`href="mailto:correo@ejemplo.com"`** — Abre el programa de correo.
- **`href="tel:+34600111222"`** — Llama por teléfono (en móviles).

**Marcadores (enlaces internos):** enlazan a un `id` de la misma página.

```html
<a href="#contacto">Ir a contacto</a>
...
<section id="contacto">...</section>
```

---

## 6. Entidades HTML

**Entidad** = código que muestra un carácter especial que el navegador interpretaría como código o que no existe en el teclado.

| Entidad | Carácter |
|---|---|
| `&lt;` | < |
| `&gt;` | > |
| `&amp;` | & |
| `&quot;` | " |
| `&nbsp;` | espacio no separable |
| `&copy;` | © |
| `&#169;` | © (código decimal) |

```html
<p>Para escribir &lt;p&gt; en pantalla hay que usar entidades.</p>
<p>&copy; 2026 Mi web</p>
```

---

## 7. Imágenes y contenido incrustado

```html
<img src="foto.jpg" alt="Descripción de la foto" width="300" height="200">
```

- **`src`** — Ruta de la imagen.
- **`alt`** — Texto alternativo: se muestra si la imagen no carga y lo leen los lectores de pantalla. **Siempre hay que ponerlo.**
- **`width` / `height`** — Tamaño en píxeles.

**`<iframe>`** — Incrusta contenido externo (un vídeo de YouTube, un mapa...).

```html
<iframe src="https://www.youtube.com/embed/VIDEO_ID"></iframe>
```

---

## 8. Tablas

**Tablas** = datos ordenados en filas y columnas. Estructura:

```html
<table>
  <caption>Horario de clase</caption>
  <thead>
    <tr>
      <th>Día</th>
      <th>Hora</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Lunes</td>
      <td>15:45</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td>Total</td>
      <td>5 días</td>
    </tr>
  </tfoot>
</table>
```

| Etiqueta | Significado |
|---|---|
| `<table>` | Inicio y fin de la tabla |
| `<caption>` | Título de la tabla |
| `<thead>` / `<tbody>` / `<tfoot>` | Cabecera, cuerpo y pie de la tabla |
| `<tr>` | Fila |
| `<th>` | Celda de **encabezado** (negrita y centrada) |
| `<td>` | Celda de **datos** |

**Agrupar celdas:**
- **`colspan="2"`** — La celda ocupa 2 columnas (agrupación horizontal).
- **`rowspan="2"`** — La celda ocupa 2 filas (agrupación vertical).

```html
<tr>
  <td rowspan="2">Lunes</td>
  <td>15:45</td>
</tr>
<tr>
  <td>18:00</td>
</tr>
```

> ⚠️ **Importante:** el estilo de las tablas se hace con **CSS**, no con atributos HTML. Los atributos `border`, `align` y `bgcolor` están obsoletos en HTML5.

---

## 9. Formularios

### 9.1. Estructura básica

```html
<form action="/procesar" method="post">
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre" required>
  <button type="submit">Enviar</button>
</form>
```

**Atributos de `<form>`:**
- **`action`** — URL donde se envían los datos (un script del servidor).
- **`method`** — Cómo se envían:
  - **`GET`** — Los datos viajan en la URL (visibles). Para búsquedas. Es el valor por defecto.
  - **`POST`** — Los datos viajan en el cuerpo de la petición (no se ven en la URL). Para datos sensibles: contraseñas, datos personales.

### 9.2. Etiquetas de formulario

| Etiqueta | Para qué sirve |
|---|---|
| `<label>` | Etiqueta descriptiva de un campo. `for` = `id` del campo al que acompaña |
| `<input>` | Campo de entrada (su comportamiento lo define `type`) |
| `<button>` | Botón (`type="submit"`, `type="reset"` o `type="button"`) |
| `<select>` + `<option>` | Lista desplegable de opciones |
| `<optgroup>` | Agrupa opciones dentro de un `<select>` |
| `<datalist>` | Sugerencias autocompletadas para un `<input>` |
| `<textarea>` | Caja de texto multilínea (`rows` y `cols`) |
| `<fieldset>` + `<legend>` | Agrupa campos relacionados con un título |

**`<label for>` mejora la accesibilidad:** al hacer clic en el texto, el campo se activa.

```html
<label for="email">Correo:</label>
<input type="email" id="email" name="email">

<fieldset>
  <legend>Datos personales</legend>
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre">
</fieldset>

<label for="pais">País:</label>
<select id="pais" name="pais">
  <option value="es">España</option>
  <option value="pt" selected>Portugal</option>
</select>

<label for="mensaje">Mensaje:</label>
<textarea id="mensaje" rows="4" cols="40"></textarea>
```

### 9.3. Tipos de `<input>` más usados

| `type` | Uso |
|---|---|
| `text` | Texto libre |
| `password` | Contraseña (oculta los caracteres) |
| `email` | Correo (valida el formato automáticamente) |
| `number` | Número (con `min` y `max`) |
| `tel` | Teléfono |
| `url` | Dirección web |
| `date` / `time` / `month` / `week` | Fecha y hora (abren selectores) |
| `checkbox` | Casilla (varias opciones a la vez) |
| `radio` | Opción única (mismo `name` = mismo grupo) |
| `file` | Subir un archivo |
| `color` | Selector de color |
| `range` | Deslizador numérico |
| `search` | Campo de búsqueda |
| `submit` / `reset` / `button` | Enviar, restablecer, botón sin acción |

```html
<!-- Radio: mismo name para que solo se elija una -->
<input type="radio" id="si" name="respuesta" value="si">
<label for="si">Sí</label>
<input type="radio" id="no" name="respuesta" value="no">
<label for="no">No</label>

<!-- Checkbox: varias a la vez -->
<input type="checkbox" id="html" name="lenguaje" value="html">
<label for="html">HTML</label>
```

### 9.4. Validación sin JavaScript

HTML5 valida los campos automáticamente al pulsar el botón de envío:

| Atributo | Efecto |
|---|---|
| `required` | El campo es obligatorio |
| `placeholder` | Texto de ejemplo dentro del campo |
| `minlength` / `maxlength` | Longitud mínima / máxima del texto |
| `min` / `max` | Valor mínimo / máximo (números, fechas) |
| `pattern` | Expresión regular que el valor debe cumplir |
| `disabled` | Campo desactivado (no se envía) |
| `readonly` | Solo lectura (se envía pero no se edita) |

**`pattern` + expresiones regulares:** permite reglas propias.

```html
<!-- Código postal: exactamente 5 dígitos -->
<input type="text" pattern="[0-9]{5}" placeholder="04001">

<!-- Usuario: solo letras y números -->
<input type="text" pattern="[A-Za-z0-9]+">

<!-- Contraseña de 8 a 16 caracteres -->
<input type="password" minlength="8" maxlength="16" required>
```

Mini-chuleta de expresiones regulares: `[abc]` = uno de esos caracteres, `[0-9]` = dígito, `{5}` = exactamente 5 veces, `{1,3}` = entre 1 y 3, `+` = una o más veces, `\d` = dígito.

---

## 10. Práctica: ideas de los ejercicios resueltos

Los apuntes traen 5 ejercicios resueltos. Lo esencial de cada uno:

1. **Página con estructura semántica** — `header`, `main`, `section`, `footer`, lista ordenada con `type="a"`, enlace con `target="_blank"`, `mailto:` y entidad `&#169;`.
2. **Formulario de registro** — `fieldset` + `legend` por bloques (datos personales, contacto, cuenta, preferencias), `label` con `for`, `required` en los obligatorios, `radio` con el mismo `name`.
3. **Tabla de contenido de un libro** — `<caption>`, `<thead>`, `<tbody>`, `colspan` y `rowspan` para agrupar celdas.
4. **Imagen, vídeo y marcadores** — `<img>` con `alt`, `<iframe>` de YouTube, enlaces internos a `id`, metadatos `description` y `author`.
5. **Test de repaso** — Para comprobar que dominas las etiquetas antes de pasar a CSS.

---

## Fuentes

Apuntes del Tema 2 (DIWEB) — curso HTML5 de Eniun:

- [Etiquetas de contenido y texto](https://www.eniun.com/etiquetas-contenido-texto-html/)
- [Elementos semánticos](https://www.eniun.com/html5-estructura-basica-elementos-semanticos/)
- [Tablas](https://www.eniun.com/etiquetas-tablas-contenido-html5/)
- [Formularios](https://www.eniun.com/etiquetas-formularios-html5/)
- [Ejercicios resueltos](https://www.eniun.com/ejercicios-resueltos-html/)
