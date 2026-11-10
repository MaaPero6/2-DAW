# Diseño de interfaces Web - Tema 2: HTML

## 📌 Resumen Ejecutivo y Objetivos

HTML (*HyperText Markup Language*) es el lenguaje de marcado con el que se describe la estructura y el significado de los documentos publicados en la Web. No es un lenguaje de programación: es texto plano formado por etiquetas que delimitan elementos, y es el navegador quien lo interpreta y construye el árbol del DOM. Su transporte se apoya en el modelo cliente/servidor: el cliente formula una petición HTTP y el servidor devuelve el documento, que el primero procesa aplicando hojas de estilo y scripts. De esta separación se deriva la división de responsabilidades del diseño de interfaces: HTML aporta estructura y significado, CSS la presentación y JavaScript el comportamiento.

El tema recorre la estructura del documento, los elementos semánticos, las etiquetas de contenido y texto, los enlaces y marcadores, las listas, las tablas, los formularios con validación nativa y el contenido incrustado. El criterio rector es elegir el elemento que describe correctamente el contenido, para que el documento sea legible, indexable y accesible.

**Objetivos de aprendizaje**

- Escribir la estructura mínima y válida de un documento HTML5.
- Organizar la página con elementos semánticos y elegir etiquetas de texto por su significado.
- Construir enlaces, listas, tablas y formularios bien estructurados.
- Incrustar multimedia y validar datos con atributos y expresiones regulares.

## 📖 Desarrollo Teórico Detallado

### 1. Estructura de un documento HTML

Todo documento comienza con `<!DOCTYPE html>`, que activa el modo estándar. El elemento raíz es `html`, que declara el idioma con `lang` —por ejemplo `lang="es"`—, información que aprovechan lectores de pantalla y buscadores. Dentro se distinguen `head`, con metainformación no visible, y `body`, con el contenido representable.

En `head` se declara el juego de caracteres con `<meta charset="UTF-8">`, se define el título con `title`, se describe la página con `<meta name="description" content="...">`, se enlazan hojas externas con `link` y se incluyen hojas internas con `style` y scripts con `script`. El elemento `style` debe situarse dentro de `head`; si varias hojas definen el mismo selector, prevalece el valor leído en último lugar. Los comentarios se escriben con `<!-- ... -->`.

| Zona | Elementos habituales | Función |
|---|---|---|
| Declaración | `<!DOCTYPE html>` | Activa el modo estándar |
| Raíz | `html lang="es"` | Delimita el documento e indica el idioma |
| Cabecera | `head`, `meta`, `title`, `link`, `style`, `script` | Metainformación, estilos y scripts |
| Cuerpo | `body` y etiquetas de contenido | Contenido visible |

### 2. Elementos semánticos

Una etiqueta semántica describe su significado; `div` y `span` no dicen nada sobre lo que contienen. Antes de HTML5 las divisiones se hacían con `div` y clases; hoy se emplean `header`, `nav`, `section`, `aside` y `footer`. La ventaja es triple: mejor SEO, código más legible y mayor accesibilidad, porque las tecnologías de asistencia identifican regiones.

| Elemento | Descripción |
|---|---|
| `header` | Cabecera de la página o de un elemento |
| `nav` | Sección que agrupa un menú de navegación |
| `main` | Contenido principal; solo uno por documento |
| `section` | Sección temática de la web |
| `article` | Bloque independiente y reutilizable: noticia, entrada, comentario |
| `aside` | Contenido lateral o complementario |
| `footer` | Pie de página o de un elemento |
| `address` | Información de contacto |
| `h1`–`h6` | Encabezados de seis niveles; `h1` es el de mayor jerarquía |

Las restricciones son concretas: `body`, `h1` y `main` solo aparecen una vez por documento; el resto puede repetirse. Los encabezados deben mantener una jerarquía coherente, sin saltos por motivos estéticos.

### 3. Etiquetas de contenido y de texto

Las etiquetas de contenido agrupan bloques; las de texto dan significado a fragmentos dentro de un bloque. Destacan `p` para párrafos, `hr` para un cambio temático, `pre` para contenido preformateado, `blockquote` para citas extensas, `figure` con `figcaption` para una unidad independiente con leyenda y `div` como contenedor genérico. HTML comprime espacios múltiples, tabuladores y saltos de línea a un solo espacio; solo `pre` los conserva. Para forzar espacios puede usarse `&nbsp;`, aunque lo recomendable es controlar el espaciado con CSS mediante `margin` y `padding`.

| Elemento | Descripción |
|---|---|
| `p` | Párrafo |
| `hr` | Cambio temático entre párrafos |
| `pre` | Texto preformateado que conserva espacios y saltos |
| `blockquote` | Contenido citado de otra fuente |
| `figure` / `figcaption` | Bloque independiente y su leyenda |
| `div` | Contenedor genérico de bloque |

Las etiquetas de texto describen función, no apariencia. `em` marca énfasis y `strong` importancia; `small` recoge notas legales; `s` señala contenido inexacto; `cite` identifica el título de una obra; `q` es una cita textual breve; `dfn` marca el término definido; `abbr` despliega en `title` el desarrollo de una abreviatura; `time` aporta una fecha legible por máquina; `code`, `var`, `samp` y `kbd` distinguen código, variables, salidas y entradas de teclado; `sub` y `sup` escriben subíndices y superíndices; `mark` resalta texto; `span` agrupa texto en línea sin significado propio. `br` inserta un salto de línea y `wbr` sugiere un punto de corte. `i`, `b` y `u` son estilísticas y solo deben usarse si no existe alternativa semántica.

Dos atributos globales completan este nivel: `id` identifica un elemento de forma única en el documento, y `class` asigna una o varias clases que pueden compartir muchos elementos. El primero sirve para marcadores, etiquetas de formulario y selección puntual; el segundo, para aplicar estilos a grupos.

### 4. Enlaces, marcadores y caracteres especiales

El elemento `a` crea hiperenlaces. Su atributo `href` admite una URL absoluta o relativa, un esquema `mailto:` para abrir el cliente de correo, un esquema `tel:` para iniciar una llamada y una referencia `#nombre` para saltar a un marcador. El atributo `download` indica que el destino debe descargarse y permite sugerir un nombre de archivo. El texto visible —el *anchor text*— debe describir el destino, ya que es lo que leen los usuarios y los lectores de pantalla.

| Valor de `target` | Comportamiento |
|---|---|
| `_self` | Abre en la misma pestaña; valor predeterminado |
| `_blank` | Abre en una pestaña o ventana nueva |
| `_parent` | Abre en el marco padre, si se usan marcos |
| `_top` | Abre en la ventana principal, reemplazando los marcos |

Los marcadores o anclas permiten navegar dentro de páginas extensas. El destino se define con `id` y se enlaza con `href="#identificador"`; desde otra página la sintaxis es `pagina.html#identificador`. Es habitual colocar al inicio un índice de contenidos y un enlace final de vuelta al principio.

```html
<nav>
  <a href="#tablas">Tablas</a> |
  <a href="#formularios">Formularios</a>
</nav>

<h2 id="tablas">Tablas</h2>
<p>Contenido del apartado de tablas.</p>

<h2 id="formularios">Formularios</h2>
<p>Contenido del apartado de formularios.</p>
```

Ciertos caracteres no pueden escribirse literalmente porque el navegador los confundiría con marcas. Se representan con entidades con nombre (`&amp;`, `&lt;`, `&gt;`, `&quot;`, `&copy;`, `&euro;`) o con referencias numéricas (`&#169;`, `&#xA9;`). La entidad es más legible; el código numérico sirve cuando no existe un nombre normalizado.

### 5. Listas

HTML ofrece tres familias: listas ordenadas (`ol`), cuando el orden es significativo; no ordenadas (`ul`), cuando no lo es; y de definiciones (`dl`), que relacionan términos (`dt`) con definiciones (`dd`). Todas las listas de elementos usan `li`. Los atributos `type`, `start` y `reversed` cambian numeración, valor inicial y sentido, pero su uso está desaconsejado frente a las propiedades CSS `list-style-type` y similares.

```html
<ol type="A" start="3">
  <li>Analizar los requisitos</li>
  <li>Diseñar la interfaz</li>
</ol>

<ul>
  <li>HTML</li>
  <li>CSS</li>
</ul>

<dl>
  <dt>DOM</dt>
  <dd>Modelo de objetos del documento.</dd>
</dl>
```

Un menú se construye con `nav`, una lista `ul` y enlaces `a` en cada `li`; la horizontalidad se resuelve con CSS.

### 6. Tablas

Una tabla se declara con `table`. Las filas se delimitan con `tr` y las celdas con `td`; las celdas de encabezado usan `th`. `caption` aporta el título, y `thead`, `tbody` y `tfoot` agrupan filas de cabecera, cuerpo y pie. `colgroup` y `col` permiten aplicar características a columnas completas. Para combinar celdas se usan `rowspan`, que agrupa verticalmente, y `colspan`, que agrupa horizontalmente.

| Elemento | Función |
|---|---|
| `table` | Define la tabla |
| `caption` | Título de la tabla |
| `thead` / `tbody` / `tfoot` | Agrupan filas de cabecera, cuerpo y pie |
| `tr` | Fila de celdas |
| `th` | Celda de encabezado |
| `td` | Celda de datos |
| `colgroup` / `col` | Agrupación y definición de columnas |

Los atributos `border`, `align` y `bgcolor` están obsoletos: bordes, alineación y fondos se controlan con CSS. Una tabla de datos debe incluir `caption` y encabezados `th`, estructura que permite al lector de pantalla anunciar qué columna corresponde a cada valor. Las tablas no sirven para maquetar.

```html
<table>
  <caption>Horario de la asignatura</caption>
  <thead>
    <tr>
      <th scope="col">Hora</th>
      <th scope="col">Lunes</th>
      <th scope="col">Martes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">08:00</th>
      <td rowspan="2">HTML</td>
      <td>CSS</td>
    </tr>
    <tr>
      <th scope="row">09:00</th>
      <td colspan="2">Proyecto integrador</td>
    </tr>
  </tbody>
</table>
```

### 7. Formularios

El formulario se delimita con `form`. Su atributo `action` indica la URL que procesará los datos y `method` el método HTTP. Con `GET` los datos se añaden a la URL como parámetros de consulta, adecuado para búsquedas y enlaces reproducibles; con `POST` viajan en el cuerpo de la petición, opción preferible para información sensible o voluminosa. Si se omite `method`, el valor predeterminado es `GET`.

| Etiqueta | Función |
|---|---|
| `form` | Contenedor del formulario |
| `fieldset` / `legend` | Agrupan campos y titulan el grupo |
| `label` | Etiqueta asociada a un control mediante `for` |
| `input` | Control de entrada de datos |
| `button` | Botón con contenido HTML en su interior |
| `select` / `option` / `optgroup` | Lista desplegable, opciones y grupos |
| `datalist` | Sugerencias para un campo de texto |
| `textarea` | Área de texto de varias líneas |

La asociación entre `label` y control se establece haciendo coincidir el `for` de la etiqueta con el `id` del campo; al pulsar sobre el texto se activa el control, lo que beneficia a usuarios de ratón, pantalla táctil y lectores de pantalla. `fieldset` con `legend` agrupa campos relacionados.

El elemento `input` adopta su comportamiento del atributo `type`: `text`, `password`, `email`, `number`, `tel`, `url`, `date`, `color`, `range`, `file`, `checkbox`, `radio`, `submit`, `reset`, `button` e `image`, entre otros. Los tipos específicos aportan validación y teclados adecuados en móviles. Los atributos `required`, `placeholder`, `minlength`, `maxlength`, `min`, `max`, `step`, `pattern`, `readonly`, `disabled`, `autofocus` y `size` completan el control. `button` admite contenido HTML —texto, iconos, imágenes—, por lo que permite más personalización que `input`.

```html
<form action="/procesar-reserva" method="post">
  <fieldset>
    <legend>Datos de la reserva</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre"
           pattern="[A-Za-zÁÉÍÓÚáéíóúñ ]{1,40}" required autofocus>

    <label for="cp">Código postal:</label>
    <input type="text" id="cp" name="cp" pattern="[0-9]{5}" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad" min="18" max="99" required>

    <label for="turno">Turno:</label>
    <select id="turno" name="turno">
      <optgroup label="Mañana">
        <option value="9-11">09:00–11:00</option>
        <option value="11-13">11:00–13:00</option>
      </optgroup>
      <optgroup label="Tarde">
        <option value="16-18">16:00–18:00</option>
      </optgroup>
    </select>

    <label>
      <input type="checkbox" name="terminos" required> Acepto las condiciones
    </label>
  </fieldset>
  <button type="submit">Reservar</button>
</form>
```

### 8. Contenido incrustado y multimedia

El contenido incrustado muestra recursos externos —mapas, vídeos, audio, documentos, gráficos— dentro de la página. `img` inserta imágenes con `src`, `alt`, `title`, `width` y `height`. `iframe` crea un contexto de navegación anidado y es la vía habitual para insertar un mapa o un vídeo de YouTube. `embed` y `object` integran recursos externos; `video` y `audio` reproducen multimedia nativa, con `source` para formatos alternativos y `track` para subtítulos; `canvas` es un lienzo de mapa de bits y `svg` define gráficos vectoriales que no pierden calidad.

| Elemento | Función |
|---|---|
| `img` | Imagen |
| `iframe` | Documento HTML embebido |
| `embed` / `object` | Aplicación o recurso externo |
| `video` / `audio` | Vídeo y sonido |
| `source` | Recursos alternativos para multimedia |
| `track` | Pistas de texto y subtítulos |
| `canvas` | Lienzo de mapa de bits para gráficos |
| `svg` | Imagen vectorial embebida |

En vídeo se emplean MP4 (`video/mp4`), WebM (`video/webm`) y Ogg (`video/ogg`); el navegador escoge el primer formato que reconoce. Conviene declarar `width` y `height` para evitar parpadeos durante la carga y añadir `controls` para reproducción, pausa y volumen. La reproducción automática solo es fiable con `autoplay muted`, y el texto entre las etiquetas de `video` se muestra solo en navegadores que no soportan el elemento. En imágenes, `alt` describe la imagen si no puede cargarse y la hace accesible.

### 9. Accesibilidad, validación y expresiones regulares

La accesibilidad se construye con decisiones sistemáticas: `alt` descriptivo, `label` asociada a cada control, `fieldset` y `legend`, `caption` y `th` en las tablas, `lang` y encabezados jerárquicos. Los atributos ARIA, como `aria-describedby`, enlazan un control con el texto que lo explica cuando la relación no puede expresarse con HTML nativo. También deben cuidarse el contraste, el foco visible y la reducción de animaciones.

HTML5 incorpora validación declarativa: `required`, `type`, `min`, `max`, `minlength`, `maxlength` y `pattern` comprueban los datos sin JavaScript. `pattern` acepta una expresión regular que el navegador aplica al valor completo, construida con clases (`[abc]`, `[^abc]`, `[a-g]`), anclas (`^`, `$`), caracteres específicos (`\d`, `\w`, `\s` y negaciones) y cuantificadores (`*`, `+`, `?`, `{5}`, `{2,}`, `{1,3}`).

| Patrón | Uso |
|---|---|
| `[0-9]+` | Solo dígitos |
| `[A-Za-z]{3}\d{3}` | Tres letras seguidas de tres dígitos |
| `[0-9]{5}` | Código postal de cinco dígitos |
| `\d{4}-\d{2}-\d{2}` | Fecha con formato AAAA-MM-DD |
| `[A-Za-z0-9]+` | Nombre de usuario alfanumérico |

La validación del navegador mejora la experiencia, pero no sustituye la comprobación en servidor: cualquier dato puede enviarse fuera del formulario. El código debe validarse con el validador del W3C.

## 💡 Ejemplos Prácticos y Aplicaciones

### Ejemplo 1: página completa con estructura semántica

El documento reúne estructura básica, elementos semánticos, una figura con leyenda y un enlace de contacto. Es un punto de partida válido para cualquier práctica de maquetación.

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Noticia de ejemplo sobre el parque tecnológico">
  <title>Inauguración del parque tecnológico</title>
</head>
<body>
  <header>
    <h1>Inauguración del parque tecnológico</h1>
    <p><time datetime="2025-05-02">2 de mayo de 2025</time></p>
    <nav>
      <ul>
        <li><a href="#noticia">Noticia</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <main id="noticia">
    <article>
      <h2>Abre sus puertas el nuevo parque</h2>
      <p>El recinto acoge más de treinta empresas emergentes.</p>
      <figure>
        <img src="parque.jpg" alt="Vista aérea del parque tecnológico"
             width="600" height="400">
        <figcaption>Imagen de la inauguración.</figcaption>
      </figure>
    </article>
    <aside>
      <h2>Dato curioso</h2>
      <p>El terreno fue una estación de tren abandonada.</p>
    </aside>
  </main>

  <footer id="contacto">
    <address>
      Escríbenos a <a href="mailto:info@ejemplo.com">info@ejemplo.com</a>
    </address>
    <p><small>&copy; 2025 Ejemplo</small></p>
  </footer>
</body>
</html>
```

La página cumple las reglas esenciales: un único `h1` y un único `main`, encabezados jerárquicos, `alt` significativo y leyenda en la figura. El `aside` complementa la noticia sin formar parte de ella.

### Ejemplo 2: tabla con agrupación de celdas

El ejemplo combina `thead`, `tbody` y `tfoot` con celdas combinadas: la primera fila de cabecera usa `rowspan` para las columnas que se mantienen y `colspan` para el bloque de horarios.

```html
<table>
  <caption>Salidas de la estación central</caption>
  <thead>
    <tr>
      <th scope="col" rowspan="2">Línea</th>
      <th scope="col" rowspan="2">Destino</th>
      <th scope="colgroup" colspan="2">Horario</th>
    </tr>
    <tr>
      <th scope="col">Mañana</th>
      <th scope="col">Tarde</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td rowspan="2">R-1</td>
      <td>Sevilla</td>
      <td>09:10</td>
      <td>15:05</td>
    </tr>
    <tr>
      <td>Córdoba</td>
      <td>10:25</td>
      <td>16:15</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4">Horarios sujetos a cambios.</td>
    </tr>
  </tfoot>
</table>
```

### Ejemplo 3: formulario con agrupación y validación

El formulario agrupa los campos en dos conjuntos, asocia cada etiqueta con su control y valida correo, longitud y aceptación de condiciones sin escribir JavaScript.

```html
<form action="/registro" method="post">
  <fieldset>
    <legend>Datos personales</legend>
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario"
           minlength="4" maxlength="16" required>

    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>
  </fieldset>

  <fieldset>
    <legend>Preferencias</legend>
    <label for="color">Color favorito:</label>
    <select id="color" name="color">
      <option value="rojo">Rojo</option>
      <option value="azul" selected>Azul</option>
      <option value="verde">Verde</option>
    </select>

    <label>
      <input type="checkbox" name="terminos" required> Acepto los términos
    </label>
  </fieldset>

  <button type="submit">Registrarse</button>
</form>
```

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Conceptos clave

1. **HTML5 y semántica**: HTML describe estructura y significado; CSS aporta presentación y JavaScript comportamiento.
2. **Estructura mínima**: `<!DOCTYPE html>`, `html lang`, `head` con `charset`, `title` y metadatos, y `body` con el contenido.
3. **Semántica**: `header`, `nav`, `main`, `section`, `article`, `aside`, `footer`, `address`; un solo `h1` y un solo `main`.
4. **Contenedores genéricos**: `div` agrupa en bloque y `span` en línea; no aportan significado.
5. **Etiquetas de texto**: `em` (énfasis), `strong` (importancia), `cite`, `q`, `dfn`, `abbr`, `time`, `code`, `mark`, `small`, `s`.
6. **Enlaces**: `href` admite URL, `mailto:`, `tel:` y `#marcador`; `target` fija el destino y `download` fuerza la descarga.
7. **Marcadores**: destino con `id`, enlace con `href="#id"`; desde otra página, `pagina.html#id`.
8. **Listas**: `ol`, `ul`, `li` y `dl` con `dt`/`dd`; la numeración se controla con CSS.
9. **Tablas**: `table`, `caption`, `thead`, `tbody`, `tfoot`, `tr`, `th`, `td`; `rowspan` y `colspan` combinan celdas; `border`, `align` y `bgcolor` son obsoletos.
10. **Formularios**: `action` y `method`, `label for`/`id`, `fieldset`/`legend`, `input`, `select`, `textarea`, `datalist`.
11. **Validación nativa**: `required`, `type`, `min`, `max`, `minlength`, `maxlength` y `pattern`.
12. **Contenido incrustado**: `img` con `alt`, `iframe`, `video`/`audio` con `source` y `track`, `canvas` y `svg`.

### Preguntas de autoevaluación

**1. ¿Qué diferencia existe entre `div` y `span`?**
`div` es un contenedor de bloque y `span` uno en línea; ninguno aporta significado. Se emplean cuando no existe un elemento semántico adecuado, por ejemplo para aplicar estilos.

**2. ¿Por qué es preferible `header` a `div class="header"`?**
Porque `header` describe el papel del bloque y permite que navegadores y lectores de pantalla lo identifiquen como cabecera.

**3. ¿Cuántos elementos `h1` y `main` puede haber en un documento?**
Uno de cada. `body`, `h1` y `main` son únicos; el resto puede repetirse.

**4. ¿Qué ocurre con los espacios y saltos de línea en HTML?**
Se comprimen a un espacio simple, salvo dentro de `pre`, que conserva el formato original. Para espacios adicionales puede usarse `&nbsp;`, aunque es preferible controlar el espaciado con CSS.

**5. ¿Cómo se enlaza a un apartado concreto de la misma página?**
Se asigna un `id` al destino —`<h2 id="tablas">`— y se enlaza con `<a href="#tablas">`. Desde otra página: `pagina.html#tablas`.

**6. ¿Qué diferencia hay entre `GET` y `POST`?**
Con `GET` los datos se añaden a la URL como parámetros visibles; con `POST` viajan en el cuerpo de la petición y no aparecen en la URL. `GET` es el método predeterminado y sirve para búsquedas; `POST` es preferible para datos sensibles.

**7. ¿Para qué sirve el atributo `for` de `label`?**
Para asociar la etiqueta con un control cuyo `id` coincide con ese valor; al pulsar sobre el texto se activa el campo, lo que mejora usabilidad y accesibilidad.

**8. ¿Qué hacen `rowspan` y `colspan`?**
`rowspan` combina una celda verticalmente, ocupando varias filas; `colspan`, horizontalmente, ocupando varias columnas. Se aplican sobre `td` o `th`.

**9. ¿Por qué no deben usarse `border`, `align` y `bgcolor` en una tabla?**
Porque son atributos de presentación obsoletos en HTML5. Bordes, alineación y fondos deben definirse con CSS, lo que separa estructura y estilo y facilita el mantenimiento.

**10. ¿Qué función cumple `pattern` y qué limitación tiene?**
Define una expresión regular que el navegador aplica antes del envío. No sustituye la validación en servidor, porque puede eludirse, y solo comprueba el formato.
